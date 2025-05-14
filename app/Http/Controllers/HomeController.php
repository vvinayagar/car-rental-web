<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalModel;
use App\Models\ShopLocation;

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
    public function index()
    {

        $shops = ShopLocation::all();
        $rentals = RentalModel::all();

        return view('home', compact('rentals', 'shops'));
    }
}
