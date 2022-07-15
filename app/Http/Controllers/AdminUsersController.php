<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\AccountSettings;
use App\Models\Avatar;
use App\Models\Member;
use App\Models\Role;
use App\Models\ServiceCategory;
use App\Models\Team;
use App\Models\TeamAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrfail($id);
        $role = $user->roles()->first();

        $roles = Role::pluck('name', 'id')
            ->all();

        return view('admin.users.edit', compact('user', 'roles', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::where('username', $request->username)
            ->where('id', '!=', Auth::user()->id)
            ->get();

        if($user->isNotEmpty() && Auth::user()->roles->first()->name != 'superAdmin')
        {
            Session::flash('user_username', 'This Username is already taken. Please try again.');
            return redirect()->back();
        }

        /** wegschrijven van de avatar **/
        if($file = $request->file('avatar_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('media/avatars', $name);
            $avatar = Avatar::create(['file'=>$name]);

            $user = User::findOrFail($id);
            $user->avatar_id = $avatar->id;
            $user->update();
        }

        /** wegschrijven van de user gegevens **/
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;


        if(!$request->business){
            $user->business = 0;
        }else {
            $user->business = 1;
        }

        $user->update();

        if($request->roles) {
            /** wegschrijven van de role in tussentabel **/
            $user->roles()->sync($request->roles, true);
        }


        Session::flash('flash_message', 'User Successfully Updated');

        return redirect('/admin');
    }


    public function delete($id)
    {
        //
        $member = Member::where('user_id', $id);
        $member->delete();

        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/users');

    }

    public function updatePassword(Request $request, $id)
    {
        //
        $secret = User::findOrFail($id)->password;

        if (Hash::check($request->currentPassword, $secret)) {                                  // Check if Current Password is same like input Password
            if ($request->newPassword == $request->confirmPassword) {                           // Check if the new input Passwords are the same
                $user = User::findOrFail($id);

                $request->validate([
                    'newPassword' => [
                        'required',
                        Password::min(8)
                            ->mixedCase()
                            ->letters()
                            ->numbers()
                            ->symbols()
                    ],
                ]);

                $newHashPassword = Hash::make($request->newPassword);
                $user->password = $newHashPassword;
                $user->update();

                Session::flash('flash_message', 'Password Successfully Updated');
                return redirect('/admin/');

            } else {
                Session::flash('user_password', 'The New Password is not duplicated correct, please try again.');
                return redirect()->back();
            }
        }

        Session::flash('user_message', 'The Current Password is not correct, please try again.');
        return redirect()->back();
    }

    public function archive()
    {
        $name = ['superAdmin', 'admin', 'employee'];

        $users = User::whereHas('roles', function($q) use($name) {
            $q->whereIn('name', $name);})
            ->where('archived', 1)
            ->latest()
            ->paginate(10);

        return view('admin.users.archive', compact('users'));
    }

    public function searchUser(Request $request)
    {
        if(!$request->user) {
            return redirect()->back();
        }

        $user_value = $request->user;

        $users = User::where(function($q) use($user_value) {
            $q->where('name', 'LIKE', '%' . $user_value . '%')
                ->Orwhere('username', 'LIKE', '%' . $user_value . '%')
                ->where('archived', 0)
                ->where('id', '!=' ,1)
                ->where('id', '!=' ,2);
        })->paginate(25);


        return view('admin.users.search', compact('users'));

    }

    public function updateTeam(TeamRequest $request, User $user)
    {
        $team = Team::where('id', $user->team->id)->first();

        $team->name = $request->name;
        $team->VAT = $request->VAT;
        $team->description = $request->description;
        $team->phone = $request->phone;

        if($request->ambassador){
            $ambassador = Team::where('id', $request->ambassador)->first();
            $team->ambassador = $ambassador->name;
        }else{
            $team->ambassador = null;
        }

        $team->update();

        $teamAddress = TeamAddress::where('team_id', $team->id)->first();
        $teamAddress->street = $request->street;
        $teamAddress->number = $request->number;
        $teamAddress->zip = $request->zip;
        $teamAddress->city = $request->city;
        $teamAddress->country = $request->country;

        $teamAddress->update();


        \Brian2694\Toastr\Facades\Toastr::success('Team Successfully Updated');
        return redirect('/admin');
    }


}
