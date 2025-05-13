<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use App\Models\RentalModel;
use App\Models\Rent;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::all();
        return view('rent.index', compact('rents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Users::all();
        $plans = Plan::all();
        $rentals = RentalModel::all();
        return view('rent.create', compact('users', 'plans', 'rentals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rent = new Rent();
        $rent->user_id = $request->username;
        $rent->plan_id = $request->plan;
        $rent->rental_model_id = $request->rental;
        $rent->details = $request->details;
        $rent->status = 'paid';
        
        $plan = Plan::find($rent->plan_id);
        $NewDate=Date('y:m:d', strtotime('+' . $plan->days .' days'));

        $rent->expiry = $NewDate;
        $rent->payment_method = 'manual';

        $rent->save();

        return redirect()->route('rent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
