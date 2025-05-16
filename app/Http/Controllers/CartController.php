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
        $purchaseItems =PurchaseItem::where("rental_model_id", $rental->id)->get();

        $blockedDates = [];


        foreach ($purchaseItems as $item) {
            $start = \Carbon\Carbon::parse($item->start_date)->startOfDay();
            $end = \Carbon\Carbon::parse($item->end_date)->startOfDay();

            // Loop through the date range
            while ($start->lte($end)) {
                $blockedDates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        // Optional: remove duplicates
        $blockedDates = array_unique($blockedDates);
        $blockedDatesJson = json_encode(array_values($blockedDates));
        $plans = Plan::all();
        return view("cart.index", compact("rental", "plans", "blockedDates", "blockedDatesJson"));
    }

    public function add(Request $request, RentalModel $rental)
    {

        $productId = $rental->id;
        $quantity = $request->input('quantity', 1);

         $cart = session()->get('cart', []);

        $diffBranch = false;

        foreach ($cart as $productId => $value) {
if($rental->shop->id != $value["shop"]){
$diffBranch = true;
}
        }
        if ($diffBranch) {
            return redirect()->back()->with('error', 'Please add same branch cars or remove the cars!');
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {

            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);

            $diff = $start->diffInDays($end);
            $diff = $diff + 1;
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

            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }


    public function view(){
        return view('cart.view');
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
            $cart[$id]['quantity'] = max(1, $quantity); // minimum 1
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
