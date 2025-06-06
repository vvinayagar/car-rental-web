<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\RentalModel;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $plans = Plan::all();//Retrieves all pricing plans
        return view('plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rentals = RentalModel::all();//Loads all cars (rental models)
        return view('plan.create', compact('rentals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//adding new plan 
    {
        /*$request->validate([
            'name' => 'required|string|max:100',
            'days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'rental' => 'required|exists:rental_models,id',
            ]); */

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->days = $request->days;
        $plan->price = $request->price;

        $plan->rental_model_id = $request->rental;

        $plan->save();

        return redirect()->route('plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
         $rentals = RentalModel::all();//Shows details of a specific plan
        return view('plan.view', compact('rentals' ,'plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
         $rentals = RentalModel::all();
        return view('plan.edit', compact('rentals','plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)//Updates existing plan info
    {
        $plan->name = $request->name;
        $plan->days = $request->days;
        $plan->price = $request->price;

        $plan->rental_model_id = $request->rental;

        $plan->save();

        return redirect()->route('plan.index')->with('success', 'Plan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {

        $plan->delete();

        return redirect()->route('plan.index');
    }
}
