<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == "admin") {
            $purchases = Purchase::where("status", 'paid')->get();
            return view('purchase.index', compact('purchases'));
        }
        else if(Auth::user()->role == 'branch') {
$user = User::where('id', Auth::user()->id)->first();

            $purchases = Purchase::where(["status"=> 'paid', 'shop' => Auth::user()->profile->shop_location_id])->get();
            return view('purchase.index', compact('purchases'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Purchase $purchase)
    {
        return view('Purchase.View', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index')->with('success', 'Info Removed');
    }

    public function approve(Request $request, Purchase $purchase)
    {
$purchase->approval_status = 'approved';
$purchase->approved_user = auth()->user()->email;
$purchase->save();
return redirect()->route('purchase.index')->with('success','Approved');
    }

    public function reject(Request $request, Purchase $purchase)
    {
        $purchase->approval_status = 'rejected';
$purchase->approved_user = auth()->user()->email;

        $purchase->save();
        return redirect()->route('purchase.index')->with('failed', 'Rejected');
    }
}
