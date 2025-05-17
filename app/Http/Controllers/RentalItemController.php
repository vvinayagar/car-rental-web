<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalModel;
use App\Models\Category;
use App\Models\SelectedCategory;
use App\Models\Brand;
use App\Models\ShopLocation;

use Auth;

class RentalItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = RentalModel::all();
        return view("rental.index", ['rentals' => $rentals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $shops = ShopLocation::all();

        if (Auth::user()->hasRole('branch')) {
            $shops = ShopLocation::where('id', Auth::user()->profile->shop_location_id)->get();

        }

        return view('rental.create', ['categories' => $categories, 'brands' => $brands, 'shops' => $shops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "spec" => "required",
            "count" => "required",
            "thumbnail" => 'required',
            "images" => 'required'
        ]);

        $rental = new RentalModel();

        $rental->name = $request->name;
        $rental->spec = $request->spec;
        $rental->count = $request->count;
        $rental->brand_id = $request->brand;
        $rental->shop_id = $request->shop;
        $rental->save();

        foreach ($request->categories as $category) {
            $selectedCategory = new SelectedCategory();
            $selectedCategory->user_id = Auth::user()->id;
            $selectedCategory->category_id = $category;

            $selectedCategory->rental_model_id =  $rental->id;
        }



        // $name = $request->file('thumbnail')->getClientOriginalName();
        // $path = $request->file('thumbnail')->store('public/files');

        $imageName = time().'.'.$request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);

        $images = array();
        $n = 0;
        foreach ($request->file('images') as $image) {
            // $nm = $image->getClientOriginalName();
            // $pt = $image->store('public/files');
            $imgName = $n . time().'.'.$image->extension();
            $image->move(public_path('images'), $imgName);

            array_push($images, $imgName);
            $n ++;
        }

        $rental->images = json_encode($images);

        $rental->thumbnail = $imageName ;

        $rental->save();

        return redirect()->route('rental.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rental = RentalModel::find($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('rental.view', compact('rental', 'categories', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rental = RentalModel::find($id);
        $categories = Category::all();
        
        $brands = Brand::all();
$shops = ShopLocation::all();
        
        if (Auth::user()->hasRole('branch')) {
            $shops = ShopLocation::where('id', Auth::user()->profile->shop_location_id)->get();

        }
        return view('rental.edit', ['rental' => $rental, 'categories' => $categories , 'brands' => $brands,'shops'=> $shops]);
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
        $validate = $request->validate([
            "name" => "required",
            "spec" => "required",
            "count" => "required",

        ]);

        $rental = RentalModel::find($id);

        $rental->name = $request->name;
        $rental->spec = $request->spec;
        $rental->count = $request->count;
        $rental->brand_id = $request->brand;
        $rental->save();

        $sels = SelectedCategory::where('rental_model_id', $rental->id)->get();

        foreach ($sels as $sel) {
            $sels->delete();
        }

        foreach ($request->categories as $category) {
            $selectedCategory = new SelectedCategory();
            $selectedCategory->user_id = Auth::user()->id;
            $selectedCategory->category_id = $category;

            $selectedCategory->rental_model_id =  $rental->id;
        }

        // $name = $request->file('thumbnail')->getClientOriginalName();
        // $path = $request->file('thumbnail')->store('public/files');

        if (isset($request->thumbnail) && $request->hasFile('thumbnail')) {
            $imageName = time().'.'.$request->thumbnail->extension();

            $request->thumbnail->move(public_path('images'), $imageName);
            $rental->thumbnail = $imageName ;
        }
        if ( isset($request->images) && $request->hasFile('images')) {
            $images = array();
            $n = 0;
            foreach ($request->file('images') as $image) {
                // $nm = $image->getClientOriginalName();
                // $pt = $image->store('public/files');
                $imgName = $n . time().'.'.$image->extension();
                $image->move(public_path('images'), $imgName);

                array_push($images, $imgName);
                $n ++;
            }

            $rental->images = json_encode($images);
        }

        $rental->save();

        return redirect()->route('rental.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rental = RentalModel::find($id);

        foreach ($rental->plans as $plan) {
            $plan->delete();
        }

        $rental->delete();
        return redirect()->route('rental.index');
    }
}
