<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\TeamAddress;
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
        return view('admin.teams.index', compact('ambassadors'));
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
    public function update(Request $request, $id)
    {
        //
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

        return view('admin.members.archive', compact('teams'));
    }
}
