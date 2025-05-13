<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalModel;
use App\Models\Plan;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Rent;
use App\Models\Privilege;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaptopRental;

class RentalController extends Controller
{
    public function rentals(Request $request)
    {
        $rentals = RentalModel::all();
        $nowDate = Carbon::now();

        $rents = Rent::all();
        $rls = array();
        foreach ($rentals as $rental){
            if($rental->count > count(Rent::where('rental_model_id',$rental->id)->where('expiry' , ">",$nowDate)->get())){
                array_push($rls, $rental);
            }
        }

        return response()
            ->json($rls);
    }

    public function plans(Request $request)
    {
        $plans = Plan::where(['rental_model_id' => $request->id])->get();
        return response()->json($plans);
    }


    public function payment(Request $request)
    {
        $rent = new Rent();
        $user = Auth::user();

        $rent->user_id = $user->id;
        $rent->plan_id = $request->plan_id;
        $rent->rental_model_id = $request->rental_model_id;
        
        $rent->payment_method = $request->payment_method;
        $rent->details = $request->payment_details;
        $rent->status = "paid";

        $plan = Plan::find($request->plan_id);

        $NewDate=Date('y:m:d', strtotime('+' . $plan->days .' days'));

        $rent->expiry = $NewDate;

        $rent->save();

        //Rental Success
        $rentalModel = RentalModel::find($request->rental_model_id);

        Mail::to($user)->send(new LaptopRental($plan, $rent, $rentalModel, $user));

        $privileges = Privilege::where('name', 'admin')->get();

        foreach ($privileges as $privilege) {
            $admin = User::find($privilege->user_id);
            Mail::to($admin)->send(new LaptopRental($plan, $rent, $rentalModel, $user));
        }
        return response()->json(['message' => 'Saved']);

    }


    public function rentalDetails(Request $request)
    {
        $user = Auth::user();

        $rents = Rent::where('user_id', $user->id)->get();

        $rentDetails = array();

        foreach ($rents as $rent)
        {
            $plan = Plan::find($rent->plan_id);
            $rental = RentalModel::find($rent->rental_model_id);
            $rentDetail = array();
            $rentDetail['id'] = $rent->id;
            $rentDetail['plan_name'] = $plan->name;
            $rentDetail['rental_model_name'] = $rental->name;
            $rentDetail['rental_model_spec'] = $rental->spec;
            $rentDetail['rental_model_thumbnail'] = $rental->thumbnail;
            $rentDetail['amount'] = $plan->price;
            $rentDetail['days'] = $plan->days;
            $rentDetail['expiry'] = $rent->expiry;
           
            $nowDate = Carbon::now();

            if($rent->expiry < $nowDate)
            {
                $rentDetail['expired'] =true;
            }
            else{
                $rentDetail['expired'] =false;
            }

            array_push($rentDetails, $rentDetail);
        }

        return response()->json($rentDetails);
    }

    public function userDetails(Request $request)
    {
        $userDetails = array();
        $user = Auth::user();

        $userDetails['firstname'] = $user->name;
        $userDetails['email'] = $user->email;

        $profile = Profile::where('user_id' , '=', $user->id)->first();
        if(isset($profile))
        {
            $userDetails['address'] = $profile->address;
            $userDetails['phone'] = $profile->phone;
        }
        else {
            $userDetails['address'] = "";
            $userDetails['phone'] = "";
        }
        return response()->json($userDetails);
    }

    public function userUpdates(Request $request)
    {
        $userDetails = array();
        $user = Auth::user();
        $profile = Profile::where('user_id' ,$user->id)->first();
        if(!isset($profile))
        {
            $profile = new Profile();
        }

        $user->name = $request->firstname;
        $user->email = $request->email;

        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->user_id = $user->id;

        $user->save();
        $profile->save();

        $userDetails['firstname'] = $user->name;
        $userDetails['email'] = $user->email;

        if(isset($profile))
        {
            $userDetails['address'] = $profile->address;
            $userDetails['phone'] = $profile->phone;
        }
        else {
            $userDetails['address'] = "";
            $userDetails['phone'] = "";
        }
        return response()->json($userDetails);
    }
}
