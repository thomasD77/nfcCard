<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class AdminCompanyCredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $credential = CompanyCredential::latest()->first();
        $photos = Photo::all();

        return view('admin.forms.company_footer', compact('credential', 'photos'));
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

    public function store(Request $request)
    {
        //
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

        $creditential = CompanyCredential::findOrFail($id);
        $creditential->firstname = $request->company_firstname;
        $creditential->lastname = $request->company_lastname;
        $creditential->companyName = $request->company_name;
        $creditential->address = $request->company_address;
        $creditential->zip = $request->company_zip;
        $creditential->city = $request->company_city;
        $creditential->country = $request->company_country;
        $creditential->phone = $request->company_phone;
        $creditential->email = $request->company_email;
        $creditential->mobile = $request->company_mobile;
        $creditential->tagline = $request->company_tagline;
        $creditential->url = $request->company_url;
        $creditential->remarks = $request->company_remarks;
        $creditential->facebook = $request->company_facebook;
        $creditential->instagram = $request->company_instagram;
        $creditential->twitter = $request->company_twitter;
        $creditential->linkedin = $request->company_linkedin;
        $creditential->VAT = $request->company_VAT;
        $creditential->update();


        if($file = $request->file('company_logo')){

            $photos = Photo::where('credential_id', $creditential->id)->get();
            foreach ($photos as $photo){
                $photo->delete();
            }

            $name = time(). $file->getClientOriginalName();
            $file->move('images/form_credentials', $name);
            $path =  'images/form_credentials/' . $name;
            $image = Image::make($path);
            $image->resize(250,250);
            $image->save('images/form_credentials/' . $name);
            Photo::create(['file'=>$name, 'credential_id'=>$creditential->id]);
        }

        Session::flash('flash_message', 'Credentials Successfully Updated');

        return redirect('/admin');
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
}
