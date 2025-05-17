<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ShopLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        $user = $profile;
        $shops = ShopLocation::where('id', Auth::user()->profile->shop_location_id)->get();
        return view('profile.edit', compact('user', 'shops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        // $validatedData = $profile->validate([
        //     'name' => 'required',
        //     'email' => 'required'
        // ]);

        if (isset($request->password) && trim($request->password) != "") {
         
         if(!isset($request->password_confirmation) || $request->password != $request->password_confirmation){
 return redirect()->route('profile.edit', ['profile' => $profile])->with('failed', 'Password not matched!');
         }else{
 $profile->password = Hash::make($request->password);
         }
           
        }

        $profile->email = $profile->email;
        $profile->name = $request->name;
        $profile->save();


        $pprofile = $profile->profile;
        if (!isset($pprofile)) {
            $pprofile = new Profile();
             $pprofile->shop_location_id = 1;
        }

        $pprofile->address = $request->address;
        $pprofile->phone = $request->phone;
        $pprofile->user_id = $profile->id;

       if(!Auth::user()->role == "user"){
        $pprofile->shop_location_id = $request->shop;

        }


        $pprofile->save();


        return redirect()->route('profile.edit', ['profile' => $profile])->with('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
