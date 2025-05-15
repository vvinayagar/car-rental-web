<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\RentalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CheckoutController extends Controller
{
    public function details()
    {
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $isPaymentSuccessful = rand(0, 1); // 0 = fail, 1 = success

        $status = $isPaymentSuccessful ? 'paid' : 'failed';
        $transactionId = Str::uuid();

        // Calculate total
        $total = collect($cart)->sum(fn($item) =>  Plan::find($item['plan'] )->price * $item['quantity'] * $item['days']);

        $shop = 0;
        foreach ($cart as $productId => $item) {
            $shop = $item['shop'];
        }

        // Create purchase
        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'transaction_id' => $transactionId,
            'amount' => $total,
            'address' => $request->address,
            'status' => $status,
            'approval_status' => 'pending',
            'quantity' => 1,
            'payment_type' => 'demo',
            'payment_name'=> 'demo',
            'shop' => $shop
        ]);


        // Add items if paid
        if ($isPaymentSuccessful) {
            foreach ($cart as $productId => $item) {

                $rental = RentalModel::find($productId);
                $plan = Plan::find($item['plan']);
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'rental_model_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $plan->price * $item['quantity'] * $item['days'],
                    'status' => 'on-progress',
                    'plan_id'=> $plan->id ,
                    'days' => $item['days'],
                    'start_date'=> $item['start_date'],
                    'end_date' => $item['end_date'],

                ]);
            }

            session()->forget('cart'); // Clear cart on success
            return redirect()->route('home')->with('success', 'Payment successful. Order placed!');
        } else {
            return redirect()->route('home')->with('error', 'Payment failed. Please try again.');
        }
    }
}
