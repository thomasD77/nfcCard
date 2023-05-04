<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\AccountSettings;
use App\Models\Avatar;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\listUrl;
use App\Models\Location;
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
use Illuminate\Support\Facades\File;

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
        $count = User::where('archived', '=', 0)->count() - 2;
        return view('admin.users.index', compact('count'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrfail($id);
        $role = Auth()->user()->roles()->first()->name;

        $roles = Role::where('id', '!=', 1 )->pluck('name', 'id')
            ->all();

        $urls = listUrl::pluck('memberURL', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles', 'role', 'urls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request)
    {
        $user = User::where('email', $request->email)
            //->where('id', '!=', Auth::user()->id)
            ->get();
        if ($user->isNotEmpty() && Auth::user()->roles->first()->name != 'superAdmin') {
            Session::flash('user_username', 'This Username is already taken. Please try again.');
            return redirect()->back();
        }
        $user = $user[0];
        /** wegschrijven van de avatar **/
        /*if ($file = $request->file('avatar_id')) {
            $name = $file->getClientOriginalName();
            if($request->changeAvatarName !== "0") {
                $exp = explode('.', $name);
                $exp[0] .= "_" . $request->changeAvatarName;
                $name = implode('.', $exp);
            }
            $avatar = Avatar::create(['file' => $name]);

            if($user->avatar_id) {
                $deleteAvatar = Avatar::find($user->avatar_id);
                if($deleteAvatar) {
                    $deleteFile = $deleteAvatar->file;
                    if (substr($deleteFile, 0, 1) === "/") {
                        $deleteFile = substr($deleteFile, 1);
                    }
                    File::delete($deleteFile);
                }
            }
            $user->avatar_id = $avatar->id;
            $user->update();
        }*/

        /** wegschrijven van de user gegevens **/
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if (!$request->business) {
            $user->business = 0;
        } else {
            $user->business = 1;
        }

        if (!$request->is_company) {
            $user->is_company = 0;
        } else {
            $user->is_company = 1;
        }

        $listurl = listUrl::where('member_id', $user->member->id)->first();
        $listurl->trial_date = $request->trial_date;
        $listurl->update();

        $user->update();
        if ($request->roles) {
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
        $user->email = $user->email . "-" . now();
        $user->update();

        $user->delete();

        return redirect('/admin/users');

    }

    public function keep(Request $request, User $user)
    {
        //
        $user->reset_message = $request->reset_message;
        $user->update();

        $member = Member::where('user_id', $user->id)->first();

        $url = listUrl::where('id', $member->card_id)->first();
        $url->member_id = null;
        $url->role_id = null;
        $url->reservation = null;
        $url->trial_date = null;
        $url->update();

        $member->card_id = 0;
        $member->update();

        return redirect('/admin/users');
    }

    public function keepBulk(Request $request)
    {
        $urls = listUrl::where('print', 1 )->select('member_id','id')->get();

        if(!$urls->isEmpty()){
            foreach ($urls as $url){
                $url->member_id = null;
                $url->print = 0;
                $url->update();
            }

            $url_ids = [];
            foreach ($urls as $url){
                $url_ids [] = $url->id;
            }

            $members = Member::whereIn('card_id', $url_ids)->get();
            $member_ids = Member::whereIn('card_id', $url_ids)->pluck('id');

            if($members){
                foreach ($members as $member){
                    $member->card_id = 0;
                    $member->trial_date = null;
                    $member->update();
                }
            }

            $users = User::whereIn('member_id', $member_ids)->get();

            foreach ($users as $user){
                $user->reset_message = $request->reset_message;
                $user->update();
            }
        }

        return redirect('/admin/card-credentials');
    }

    public function updateURL(Request $request, User $user)
    {
        if($request->url){

            $ex_member = Member::where('card_id', $request->url)->first();

            if($ex_member){

                Session::flash('ex_member', $ex_member->user->name . " " . 'has already this CARD ID');
                return redirect()->back();
            }

            $member = Member::where('user_id', $user->id)->first();
            $member->card_id = $request->url;
            $member->update();

            return redirect('/admin/users');
        }
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

    public function archive(Request $request)
    {
        if ($request->team) {
            $team = Team::where('id', $request->team)->first();
            $count = User::where('archived', '=', 1)->where('team_id', $team->id)->count();
        } else {
            $team = null;
            $count = User::where('archived', '=', 1)->count();
        }


        return view('admin.users.archive', compact('team', 'count'));
    }

    public function searchUser(Request $request)
    {
        if (!$request->user) {
            return redirect()->back();
        }

        $user_value = $request->user;

        $users = User::where(function ($q) use ($user_value) {
            $q->where('name', 'LIKE', '%' . $user_value . '%')
                ->Orwhere('username', 'LIKE', '%' . $user_value . '%')
                ->where('archived', 0)
                ->where('id', '!=', 1)
                ->where('id', '!=', 2);
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

        if ($request->ambassador) {
            $ambassador = Team::where('id', $request->ambassador)->first();
            $team->ambassador = $ambassador->name;
        } else {
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

    public function contactDetail(Contact $contact)
    {
        return view('admin.contacts-list.detail', compact('contact'));
    }

    public function filterEvents()
    {
        $user = User::find(auth::id());
        return view('admin.users.filter-events');
    }

    public function eventDetail(Location $location)
    {
        return view('admin.users.event-detail', compact('location'));
    }

}
