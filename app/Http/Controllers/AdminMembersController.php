<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use LaravelQRCode\Facades\QRCode;
use Spatie\Browsershot\Browsershot;

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
        $member = Member::first();
        $member_url = substr_replace($member->memberURL, "" ,-9) ;

        return view('admin.members.index', compact('member_url', 'member'));
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
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
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
        $member = Member::findOrFail($id);

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


        /** wegschrijven van de avatar **/
        if($file = $request->file('avatar_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('card/avatars', $name);
            $member->avatar = $name;
        }

        $member->update();

        \Brian2694\Toastr\Facades\Toastr::success('Member Successfully Updated');
        return redirect('/admin/members');
    }

    public function archive()
    {
       $members = Member::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('admin.members.archive', compact('members'));
    }


    //This function will generate MEMBERS & USERS
    public function generate(Request $request)
    {
        $member_number = $request->member_number;
        $member_count = Member::max('id');

        $last_member = Member::max('id') + 1;
        $new_amount = $member_number + $member_count;

        for ($i = $last_member; $i <= $new_amount; $i++ )
        {
            $user = new User();
            $user->name = 'INNOVA-USER-' . $i;
            $user->email = 'INNOVA@USER-' . $i;
            $user->password = bcrypt('INNOVA-USER-' . $i);
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();

            $member = new Member();
            $member->user_id = $user->id;
            $member->save();

            $user->member_id = $member->id;
            $user->update();

            DB::table('user_role')->insert([                                                                          // superAdmin for Innova account
                'user_id' => $user->id,
                'role_id' => '3',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);
        }

        \Brian2694\Toastr\Facades\Toastr::success('Members Successfully Generated');
        return redirect('/admin/members');
    }

}
