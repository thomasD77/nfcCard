<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAddressesController extends Controller
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
    public function store(Request $request)
    {
        //

        $address = new Address();

        $address->company = $request->company;
        $address->streetAddress1 =  $request->streetAddress1;
        $address->streetAddress2 = $request->streetAddress2;
        $address->city = $request->city;
        $address->postalCode = $request->postalCode;
        $address->VAT = $request->VAT;

        $address->save();


        $client = Client::findOrFail($request->client);
        $client->address_id = $address->id;
        $client->save();

        return view('admin.dashboard');

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
        $address = Address::findOrFail($id);

        $address->company = $request->company;
        $address->streetAddress1 =  $request->streetAddress1;
        $address->streetAddress2 = $request->streetAddress2;
        $address->city = $request->city;
        $address->postalCode = $request->postalCode;
        $address->VAT = $request->VAT;

        $address->update();

        return view('admin.dashboard');
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
