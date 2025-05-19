<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Models\ShopLocation;
use App\Rules\UserExist;
use App\Models\User;
use App\Models\Profile;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); //Gets all users from the database.
        $userlist = array();
        //Loops through users, get user info (name, email, role), and passes it to the view.
        foreach ($users as $user) {
            $privilege = Privilege::where("user_id", $user->id)->first();

            $customUser = array();
            $customUser["id"] = $user->id;
            $customUser["name"] = $user->name;
            $customUser["email"] = $user->email;

                $customUser["privilege"] = $user->role;

            array_push($userlist, $customUser);
        }

        return view("adminusermanage.index", ['users' => $userlist]);//Displays all users on the index page.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = ShopLocation::all();
        return view("adminusermanage.create", ["shops"=> $shops]);//Fetches all shop locations and passes them to the form view.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'phone' => 'required',
            'email' => new UserExist,//custom rule UserExist to check if the user already exists.
        ]);

        $validator = new Validator();
        //check user exist

        // $exist = User::where("email", $request->email)->first();
        // if ($exist != null) {
        //     ///$validator->errors()->add('field', 'Something is wrong with this field!');
        //     return view("admin.adminusermanage.create")->withErrors("user", "User Email Exist");
        // }

        //Create new user
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();//Creates and saves a new User with encrypted password.

        $user->role = $request->privilege;
        $user->save();

        $user->assignRole($request->privilege);
        $user->save();//Assigns a role (e.g. "admin", "branch/staff", user/customer

        $profile = new Profile();
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->user_id = $user->id;
        $profile->shop_location_id = $request->shop;
        $profile->save();//Creates the user’s profile (phone, address, shop location)



        $user->assignRole($request->privilege);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $profile = $user->profile;//Profile::where("user_id", $id)->first();//Gets the user's profile (via Eloquent relationship)

        if(!isset($profile))
        {
            $profile = new Profile();
            $profile->phone = "000000";
            $profile->address = "-----";
            $profile->user_id =$user->id;
             $profile->shop_location_id =0;
             $profile->save();
        }//Then returns the view with user, profile, and shops.
  $shops = ShopLocation::all();
        return view(
            "adminusermanage.view",
            ["user" => $user, "profile" => $profile, 'shops' => $shops]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)//Loads user, profile, and shop list.If no profile exists, creates a basic one
    {
        $profile = $user->profile;// Profile::where("user_id", $id)->first();
        $shops = ShopLocation::all();
         if(!isset($profile))
        {
            $profile = new Profile();
            $profile->phone = "000000";
            $profile->address = "-----";
            $profile->user_id =$user->id;
             $profile->save();
        }

        return view(
            "adminusermanage.edit",
            ["user" => $user, "profile" => $profile, "shops"=> $shops]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([//Validates basic input
            'name' => 'required',
            'email' => 'required'
        ]);


        if (isset($request->password) && trim($request->password) != "") {
            $user->password = Hash::make($request->password);
        }//Updates password only if provided

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        $user->role = $request->privilege;
        $user->save();
        $user->syncRoles([$request->privilege]); //Syncs user role (removes old, adds new)
        $user->assignRole($request->privilege);
        $user->save();

        $profile = $user->profile;
        if (!isset($profile)) {
            $profile = new Profile();
        }

        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->user_id = $user->id;
        $profile->shop_location_id = $request->shop;

        $profile->save();//Updates user profile

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $profile = $user->profile;//Profile::where("user_id", $id)->first();//Deletes the user and their profile
        try {
            $user->delete();
            $profile->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }


        return redirect()->route('user.index');
    }
}
