<?php

namespace App\Http\Controllers;

use App\Models\ShopLocation;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = ShopLocation::all();
        return view("shop.index", ["shops" => $shops]);//Returns a view: shop.index, passing the list as shops
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("shop.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**$request->validate([
    'name' => 'required|string|max:255',
    'address1' => 'required|string|max:255',
    'address2' => 'nullable|string|max:255',
    'city' => 'required|string|max:100',
    'state' => 'required|string|max:100',
    'country' => 'required|string|max:100',
]); */
        $shop = new ShopLocation();
        $shop->name = $request->name;
        $shop->address1 = $request->address1;
        $shop->address2 = $request->address2;
        $shop->city = $request->city;
        $shop->state = $request->state;
        $shop->country = $request->country;
        $shop->save();
        return redirect()->route("shop.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(ShopLocation $shop)
    {
        return view("shop.view", ["shop" => $shop]);//Displays a single shop’s data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopLocation $shop)
    {
        return view("shop.edit", ["shop" => $shop]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShopLocation $shop)
    {
        $shop->name = $request->name;
        $shop->address1 = $request->address1;
        $shop->address2 = $request->address2;
        $shop->city = $request->city;
        $shop->state = $request->state;
        $shop->country = $request->country;
        $shop->save();
        return redirect()->route("shop.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopLocation $shop)
    {
        $shop->delete();
        return redirect()->route("shop.index");
    }
}
