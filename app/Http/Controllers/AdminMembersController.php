<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class AdminMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.members.create');
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
        $member = new Member();

        //General
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->email = $request->email;
        $member->company = $request->company;
        $member->age = $request->age;
        $member->jobTitle = $request->jobTitle;
        $member->shortDescription = $request->shortDescription;
        $member->website = $request->website;
        $member->notes = $request->notes;

        //Contact information
        $member->mobileWork = $request->mobileWork;
        $member->mobile = $request->mobile;
        $member->addressLine1 = $request->addressLine1;
        $member->addressLine2 = $request->addressLine2;
        $member->city = $request->city;
        $member->country = $request->country;
        $member->postalCode = $request->postalCode;

        //Socials
        $member->facebook = $request->facebook;
        $member->instagram = $request->instagram;
        $member->twitter = $request->twitter;
        $member->youTube = $request->youTube;
        $member->tikTok = $request->tikTok;
        $member->linkedIn = $request->linkedIn;
        $member->whatsApp = $request->whatsApp;
        $member->facebookMessenger = $request->facebookMessenger;

        $member->save();

        \Brian2694\Toastr\Facades\Toastr::success('Member Successfully Saved');

        return redirect('/admin/members');
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
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
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
       $members = Member::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('admin.members.archive', compact('members'));
    }
}
