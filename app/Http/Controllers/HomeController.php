<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Purchase;
use App\Models\Transmission;
use App\Models\Type;
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
        $brand = null;
        $filter = null;
        $type = null;
        $transmission = null;
        $shops = ShopLocation::all();
        $rentals = RentalModel::all();
        $transmissions = Transmission::all();
        $types = Type::all();
        $filter = 0;
        if ($request->query()) {
            // At least one parameter exists in the URL
            // You can access specific ones like:
            $brand = $request->query('brand') ?? null;
            $filter = $request->query('filter') ?? null; // shop_id
            $type = $request->query('type') ?? null;
            $transmission = $request->query('transmission') ?? null;

            if ($filter == 0) {
                $filter = null;
            }

            if ($brand == 0) {
                $brand = null;
            }

            if ($type == 0) {
                $type = null;
            }

            if ($transmission == 0) {
                $transmission = null;
            }

            $rentals = RentalModel::query()
                ->when($brand, fn($q) => $q->where('brand_id', $brand))
                ->when($filter, fn($q) => $q->where('shop_id', $filter))
                ->when($type, fn($q) => $q->where('type_id', $type))
                ->when($transmission, fn($q) => $q->where('transmission_id', $transmission))
                ->get();


            // if($filter != null &&  $brand != null){

            //     $rentals = RentalModel::where(['brand_id' => $brand, 'shop_id' => $filter])->get();
// }
// else{
// $rentals = RentalModel::query()
//     ->when($brand, fn($q) => $q->where('brand_id', $brand))
//     ->when($filter, fn($q) => $q->orWhere('shop_id', $filter))
//     ->get();
// }



        }
        $brands = Brand::all();
        return view('home', compact(
            'rentals',
            'shops',
            'filter',
            'brands',
            'brand',
            'filter',
            'transmissions',
            'types',
            'type',
            'transmission'
        ));
    }

    public function dashboard(){

        $approved = count(Purchase::where("approval_status", 'approved')->get());
        $rejected= count(Purchase::where("approval_status", 'rejected')->get());

        $waiting = count(Purchase::where("approval_status", 'pending')->get());


return view('dashboard', compact('approved', 'rejected', 'waiting'));

        
    }
}
