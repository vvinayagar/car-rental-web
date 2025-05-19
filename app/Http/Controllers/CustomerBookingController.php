<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::where('user_id', Auth::user()->id)->get();//Gets all Purchase records that belong to the currently logged-in user
        return view('customer_purchase.index', compact('purchases'));//Sends them to the view to display a booking list
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
    public function show(Purchase $customer_purchase)
    {
        return view('customer_purchase.view', ['purchase' => $customer_purchase]);//Shows details of one booking and Opens the view file
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $customer_purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $customer_purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $customer_purchase)//Deletes the booking from the database
    {
        $customer_purchase->delete();
        return redirect('customer_purchase.index')->with('success','Deleted');
    }
}
