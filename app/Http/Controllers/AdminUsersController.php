<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\AccountSettings;
use App\Models\Avatar;
use App\Models\Role;
use App\Models\ServiceCategory;
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
        $roles = Role::pluck('name', 'id')
            ->all();
        $seo = AccountSettings::first()->SEO;
        return view('admin.users.edit', compact('user', 'roles', 'seo'));
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
        $user->update();

        /** wegschrijven van de role in tussentabel **/
        $user->roles()->sync($request->roles, true);

        Session::flash('flash_message', 'User Successfully Updated');

        return redirect('/admin/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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


}
