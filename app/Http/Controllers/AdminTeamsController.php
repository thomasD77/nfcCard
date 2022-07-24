<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Contact;
use App\Models\Member;
use App\Models\Team;
use App\Models\TeamAddress;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ambassadors = Team::with('teamAddress')->where('archived', '=', 0)->pluck('name', 'id');
        $count = Team::where('archived', 0)->count();
        $types = Type::pluck('name','id');
        return view('admin.teams.index', compact('ambassadors', 'count', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        //
        $team = new Team();
        $teamAddress = new TeamAddress();

        $team->name = $request->name;
        $team->VAT = $request->VAT;
        $team->description = $request->description;
        $team->phone = $request->phone;

        if($request->ambassador){
            $ambassador = Team::where('id', $request->ambassador)->first();
            $team->ambassador = $ambassador->name;
        }

        if($request->type_id){
            $team->type_id = $request->type_id;
        }

        $team->save();

        $teamAddress->team_id = $team->id;
        $teamAddress->street = $request->street;
        $teamAddress->number = $request->number;
        $teamAddress->zip = $request->zip;
        $teamAddress->city = $request->city;
        $teamAddress->country = $request->country;

        $teamAddress->save();


        \Brian2694\Toastr\Facades\Toastr::success('Team Successfully Created');
        return redirect('/admin/teams');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        //
        $team = Team::where('id', $id)->first();

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

        if($request->type_id){
            $team->type_id = $request->type_id;
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
        return redirect('/admin/teams');
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

    public function archive()
    {
        $teams = Team::where('archived', 1)
            ->latest()
            ->paginate(25);

        $count = Team::where('archived', 1)->count();

        return view('admin.teams.archive', compact('teams', 'count'));
    }

    public function getUsers(Team $team)
    {
        $users = User::where('team_id', $team->id)
            ->where('archived', 0)
            ->get();

        $count = User::where('team_id', $team->id)
            ->where('archived', 0)
            ->count();

        return view('admin.teams.users', compact('users', 'team', 'count'));
    }

    public function getContacts(Team $team)
    {
        $team = $team;

        $users = User::where('team_id', $team->id)->pluck('id');
        $members = Member::whereIn('user_id', $users)->pluck('id');
        $count = \App\Models\Contact::with(['member'])
            ->where('archived', 0)
            ->whereIn('member_id', $members)
           ->count();

        return view('admin.teams.contacts', compact('team', 'count'));
    }
}
