<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(BillingRequest $request)
    {
        //
        $billing = new Billing();

        if(isset($request->client_id))
        {
            $billing->user_id = $request->client_id;
        }else
        {
            $billing->user_id = Auth::user()->id;
        }

        $billing->company = $request->company;
        $billing->firstname = $request->firstname;
        $billing->lastname = $request->lastname;
        $billing->streetAddress1 =  $request->streetAddress1;
        $billing->streetAddress2 = $request->streetAddress2;
        $billing->city = $request->city;
        $billing->postalCode = $request->postalCode;
        $billing->VAT = $request->VAT;

        $billing->save();

        if(isset($request->client_id))
        {
            $user = User::findOrFail($request->client_id);
            $user->billing_id = $billing->id;
            $user->save();
        }else
        {
            $user = Auth::user();
            $user->billing_id = $billing->id;
            $user->save();
        }

        Session::flash('flash_message', 'Address Successfully Updated');

        return redirect('/admin/');
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
    public function update(BillingRequest $request, $id)
    {
        //
        $billing = Billing::findOrFail($id);

        $billing->company = $request->company;
        $billing->firstname = $request->firstname;
        $billing->lastname = $request->lastname;
        $billing->streetAddress1 =  $request->streetAddress1;
        $billing->streetAddress2 = $request->streetAddress2;
        $billing->city = $request->city;
        $billing->postalCode = $request->postalCode;
        $billing->VAT = $request->VAT;

        $billing->update();

        Session::flash('flash_message', 'Address Successfully Updated');

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
}
