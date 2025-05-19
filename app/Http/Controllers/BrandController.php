<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();//Gets all car brands from the database
        return view('brand.index', ['brands' => $brands]);//Sends them to the brand/index.blade.php view to display
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');//form to create new brand
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name; //Creates a new Brand object and sets its name


        $images = array();
        $n = 0;
        foreach ($request->file('images') as $image) { //Loops through uploaded images.
            $imgName = $n . time().'.'.$image->extension();//Gives each a unique name (based on time and loop counter)
            $image->move(public_path('images'), $imgName);//Saves them in the public/images folder

            array_push($images, $imgName);//Collects all image names in an array
            $n ++;
        }

        $brand->images = json_encode($images);//Saves the image filenames as a JSON array in the database

        $brand->save();

        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brand.view', ['brand' => $brand]);//Shows details of a single brand
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));//Sends brand data to brand/edit.blade.php for editing
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
        $brand->name = $request->name;
        $brand->save();//Updates the brand name and saves it

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brand.index');
    }
}
