<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Rent;
use App\Models\RentalModel;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RentalModel $rental)
    {
        $purchaseItems = PurchaseItem::where("rental_model_id", $rental->id)->get();//Gets all purchases for this car
        $availableCountPerDate = [];
        $totalAvailable = $rental->count;

        // From DB
        foreach ($purchaseItems as $item) {
            $start = \Carbon\Carbon::parse($item->start_date);
            $end = \Carbon\Carbon::parse($item->end_date);

            while ($start->lte($end)) {
                $key = $start->format('Y-m-d');
                $availableCountPerDate[$key] = ($availableCountPerDate[$key] ?? 0) + $item->quantity;
                $start->addDay();
            }//Loops through all booked items (past purchases) and counts how many were booked each day
        }

        // 🔁 From Session Cart
        $cart = session('cart', []);
        foreach ($cart as $cartItem) {
            if ((int) ($cartItem['product_id'] ?? 0) === $rental->id) {
                $start = \Carbon\Carbon::parse($cartItem['start_date']);
                $end = \Carbon\Carbon::parse($cartItem['end_date']);
                $qty = (int) ($cartItem['quantity'] ?? 1);

                while ($start->lte($end)) {
                    $key = $start->format('Y-m-d');
                    $availableCountPerDate[$key] = ($availableCountPerDate[$key] ?? 0) + $qty;
                    $start->addDay();
                }
            }
        }//Adds any car booking from the cart to the same day count. Prevents double-booking.

        // Fully blocked = quantity used up //If bookings (including cart) use up all available cars, that date is blocked
        $blockedDates = [];
        foreach ($availableCountPerDate as $date => $used) {
            if ($used >= $totalAvailable) {
                $blockedDates[] = $date;
            }
        }

        $blockedDatesJson = json_encode($blockedDates);
        $availableJson = json_encode($availableCountPerDate);

        $plans = Plan::all();//Sends rental info, availability, and blocked dates to the view
        return view("cart.index", compact("rental", "plans", "blockedDates", "blockedDatesJson", "availableCountPerDate", "availableJson"));

    }

    public function add(Request $request, RentalModel $rental)
    {

        $productId = $rental->id;
        $quantity = $request->input('quantity', 1);//get product and quantity

         $cart = session()->get('cart', []);

        $diffBranch = false;

        //Check if cart has cars from another branch
        foreach ($cart as $productId => $value) {
            if($rental->shop->id != $value["shop"]){//Prevents users from booking cars from multiple branches in the same order
            $diffBranch = true;
            }
        }
        if ($diffBranch) {
            return redirect()->back()->with('error', 'Please add same branch cars or remove the cars!');
        }

        if (isset($cart[$productId])) {
            $totalAfter = $cart[$productId]['quantity']  + $quantity;
            if ($totalAfter > 2) {//A user can book max 2 cars per rental period
                return redirect()->back()->with('error', 'Maximum car can book per rental period is 2!');
            }

            $cart[$productId]['quantity'] += $quantity;
        } else {

            $start = Carbon::parse($request->startDate);
            $end = Carbon::parse($request->endDate);

            $diff = $start->diffInDays($end);


            $diff = $diff + 1;
            // dd($diff);
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $request->input('name'),
                'plan' => $request->plan,
                'rental' => $rental,
                'quantity' => $quantity,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'days' => $diff,
                'shop'=> $rental->shop->id,

            ];//Stores all details (car, date, days, shop
        }

        session()->put('cart', $cart);//Laravel uses session to keep the cart data temporarily

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove($id)//removes the car from session cart
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }


    public function view(){
        return view('cart.view');//shows the cart items
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail()
    {
        return view('cart.detail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity); // minimum 1 //Updates the quantity of a car in the cart (min is 1)
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully.');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
