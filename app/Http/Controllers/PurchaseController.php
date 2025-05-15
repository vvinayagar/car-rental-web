<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::where("status", 'paid')->get();
        return view('purchase.index', compact('purchases'));
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
        //
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
        //
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
