<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use Illuminate\Http\Request;

class TransmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transmissions  = Transmission::all();

        return view("Transmission.index", compact("transmissions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Transmission.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transmission = Transmission::create($request->all());
        return redirect()->route("transmission.index")->with("success","Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Transmission $transmission)
    {

        return view("Transmission.view", compact("transmission"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transmission $transmission)
    {
        return view("Transmission.edit", compact("transmission"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transmission $transmission)
    {
        $transmission->name = $request->name;
        return redirect()->route("transmission.index")->with("success", "Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transmission $transmission)
    {
        $transmission->delete();
        return redirect()->route("transmission.index")->with("success","Deleted");
    }
}
