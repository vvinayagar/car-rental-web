<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalModel;
use App\Models\ShopLocation;
use App\Models\ShopLocationd;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $shops = ShopLocation::all();
        $rentals = RentalModel::all();
        $filter = 0;
        if ($request->query()) {
            // At least one parameter exists in the URL
            // You can access specific ones like:
            $filter = $request->query('filter'); // null if not set

            $rentals= RentalModel::where('shop_id', $filter)->get();
        }


        return view('home', compact('rentals', 'shops', 'filter'));
    }
}
