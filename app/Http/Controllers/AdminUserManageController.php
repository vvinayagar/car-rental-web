<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Rules\UserExist;
use App\Models\User;
use App\Models\Profile;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
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
        $users = User::all();
        $userlist = array();
        foreach ($users as $user) {
            $privilege = Privilege::where("user_id", $user->id)->first();

            $customUser = array();
            $customUser["id"] = $user->id;
            $customUser["name"] = $user->name;
            $customUser["email"] = $user->email;
            if (isset($privilege)) {
                $customUser["privilege"] = $privilege->name;
            } else {
                $privilege = new Privilege();
                $privilege->user_id =  $user->id;
                $privilege->name = 'user';
                $privilege->save();

                $customUser["privilege"] = $privilege->name;
            }
            array_push($userlist, $customUser);
        }

        return view("adminusermanage.index", ['users' => $userlist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("adminusermanage.create");
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
            'email' => new UserExist,
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
        $user->save();

        $profile = new Profile();
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->user_id = $user->id;

        $profile->save();

        $privilege = new Privilege();
        $privilege->user_id = $user->id;
        $privilege->name = $request->privilege;
        $privilege->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where("id", $id)->first();
        $privilege = Privilege::where("user_id", $id)->first();
        $profile = Profile::where("user_id", $id)->first();

        if(!isset($profile))
        {
            $profile = new Profile();
            $profile->phone = "000000";
            $profile->address = "-----";
            $profile->user_id =$user->id;
             $profile->save();
        }

        return view(
            "adminusermanage.view",
            ["user" => $user, "profile" => $profile, "privilege" => $privilege]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where("id", $id)->first();
        $profile = Profile::where("user_id", $id)->first();
        $privilege = Privilege::where("user_id", $id)->first();

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
            ["user" => $user, "profile" => $profile, "privilege" => $privilege]
        );
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
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::find($id);
        if (isset($request->password) && trim($request->password) != "") {
            $user->password = Hash::make($request->password);
        }

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        $profile = Profile::where("user_id", $id)->first();
        if (!isset($profile)) {
            $profile = new Profile();
        }
        
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->user_id = $user->id;
        
        $profile->save();

        $privilege = Privilege::where("user_id", $id)->first();
        if (!isset($privilege)) {
            $privilege = new Privilege();
            $privilege->user_id = $id;
        }
        $privilege->name = $request->privilege;
      
        $privilege->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $privilege = Privilege::where("user_id", $id)->first();
        $profile = Profile::where("user_id", $id)->first();
        try {
            $user->delete();
            $privilege->delete();
            $profile->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
      

        return redirect()->route('user.index');
    }
}
