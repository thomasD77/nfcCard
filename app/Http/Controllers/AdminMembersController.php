<?php

namespace App\Http\Controllers;

use App\Exports\MemberCredentialCardExport;
use App\Exports\MemberListExport;
use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\Order;
use App\Models\Package;
use App\Models\Photo;
use App\Models\URL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelQRCode\Facades\QRCode;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;
use Image;

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
        $QRcode = \App\Models\QRCODE::first();

        return view('admin.members.index', compact( 'QRcode'));
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

        $package = Package::where('value', 1)->first();

        if(! isset($package)){
            $package = 'No package selected';
        }else{
            $package = $package->package;
        }

        return view('admin.members.edit', compact('member', 'package'));
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
        if($request->firstname != null){
            $member->firstname = $request->firstname;
        }

        if($request->lastname != null){
            $member->lastname = $request->lastname;
        }

        if($request->email != null){
            $member->email = $request->email;
        }

        if($request->company != null){
            $member->company = $request->company;
        }

        if($request->age != null){
            $member->age = $request->age;
        }

        if($request->jobTitle != null){
            $member->jobTitle = $request->jobTitle;
        }

        if($request->shortDescription != null){
            $member->shortDescription = $request->shortDescription;
        }

        if($request->website != null){
            $member->website = $request->website;
        }

        if($request->notes != null){
            $member->notes = $request->notes;
        }

        //Contact information
        if($request->mobileWork != null){
            $member->mobileWork = $request->mobileWork;
        }

        if($request->mobile != null){
            $member->mobile = $request->mobile;
        }
        if($request->addressLine1 != null){
            $member->addressLine1 = $request->addressLine1;
        }

        if($request->addressLine2 != null){
            $member->addressLine2 = $request->addressLine2;
        }

        if($request->city != null){
            $member->city = $request->city;
        }

        if($request->country != null){
            $member->country = $request->country;
        }

        if($request->postalCode != null){
            $member->postalCode = $request->postalCode;
        }

        //Socials
        if($request->facebook != null){
            $member->facebook = $request->facebook;
        }

        if($request->instagram != null){
            $member->instagram = $request->instagram;
        }

        if($request->twitter != null){
            $member->twitter = $request->twitter;
        }

        if($request->youTube != null){
            $member->youTube = $request->youTube;
        }

        if($request->tikTok != null){
            $member->tikTok = $request->tikTok;
        }

        if($request->linkedIn != null){
            $member->linkedIn = $request->linkedIn;
        }

        if($request->whatsApp != null){
            $member->whatsApp = $request->whatsApp;
        }

        if($request->facebookMessenger != null){
            $member->facebookMessenger = $request->facebookMessenger;
        }


//        if($file = $request->file('avatar_id')){
//
//            $name = time(). $file->getClientOriginalName();
//            $file->move('card/avatars', $name);
//
//            $path = 'card/avatars/' . $name;
//            $image = Image::make($path);
//            $image->resize(500,500);
//            $image->save('card/avatars/' . $name);
//            $member->avatar = $name;
//        }

        if($file = $request->file('avatar_id')){

            $name = time(). $file->getClientOriginalName();
            $file->move('card/avatars', $name);

            $path = 'card/avatars/' . $name;
            $image = Image::make($path);
            $image->orientate();
            $image->resize(200,null, function ($constraint){
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $image->save('card/avatars/' . $name);
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
            $user->name = 'user-' . $i;
            $user->email = 'info@user-' . $i;
            $user->password = bcrypt('info@user-' . $i);
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();


            $url = URL::first()->url;
            $member = new Member();

            $member->user_id = $user->id;
            $member->firstname = 'MEMBER' . "#" . $i;
            $member->memberURL = $url . '/member/' . $i;
            $member->memberCustomURL = $url . '/member/custom/' . $i;
            $member->membervCard = $url . '/vCard/' . $i;
            $member->memberQRcode = $url . '/QRcode/' . $i;
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

    public function generateCredentialMemberList()
    {
        \Brian2694\Toastr\Facades\Toastr::success('List Successfully Generated');
        return Excel::download(new MemberCredentialCardExport(), 'MemberCardList.xlsx');
    }

    public function searchMember(Request $request)
    {
        $member_value = $request->member;

        $members = Member::where(function($q) use($member_value) {
            $q->where('firstname', 'LIKE', '%' . $member_value . '%')
                ->Orwhere('lastname', 'LIKE', '%' . $member_value . '%')
                ->where('archived', 0);
        })->paginate(25);

        $member = Member::first();
        $member_url = substr_replace($member->memberURL, "" ,-9) ;
        $active_user_role = Auth::user()->roles->first()->name;
        $active_user = Auth::user()->id;


        return view('admin.members.search', compact('members', 'member', 'member_url', 'active_user_role', 'active_user'));

    }

    public function membersList()
    {

        $urls = listUrl::with(['package', 'material', 'member'])->paginate(25);
        $packages = Package::pluck('package', 'id');
        $materials = Material::pluck('name', 'id');

        return view ('admin.members.list', compact('urls', 'packages', 'materials'));
    }

    public function updateMembersList(Request $request)
    {
        $url = listUrl::findOrFail($request->url_id);
        $url->material_id = $request->material_id;
        $url->package_id = $request->package_id;
        $url->update();


        $member = Member::where('card_id', $request->url_id)->first();
        if($member)
        {
            $member->package_id = $url->package_id;
            $member->material_id = $url->material_id;
            $member->update();
        }

        \Brian2694\Toastr\Facades\Toastr::success('Edit Card Successfully');
        return redirect('/admin/members/list/gen');
    }

}
