<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
  $brand = 0;
  $filter = 0;
        $shops = ShopLocation::all();
        $rentals = RentalModel::all();
        $filter = 0;
        if ($request->query()) {
            // At least one parameter exists in the URL
            // You can access specific ones like:
            $filter = $request->query('filter'); // null if not set
             $brand = $request->query('brand'); // null if not set
    
             if($filter == 0){
                $filter= null;
             }

              if($brand == 0){
                $brand= null;
             }

if($filter != null &&  $brand != null){

    $rentals = RentalModel::where(['brand_id' => $brand, 'shop_id' => $filter])->get();
}
else{
$rentals = RentalModel::query()
    ->when($brand, fn($q) => $q->where('brand_id', $brand))
    ->when($filter, fn($q) => $q->orWhere('shop_id', $filter))
    ->get();
}


        
        }
$brands = Brand::all();
        return view('home', compact('rentals', 'shops', 'filter', 'brands', 'brand', 'filter'));
    }
}
