<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        //
        $location = new Location();
        $location->name = $request->name;
        $location->streetAddress = $request->streetAddress;
        $location->city = $request->city;
        $location->postalCode = $request->postalCode;
        $location->mobile = $request->mobile;
        $location->email = $request->email;
        $location->VAT = $request->VAT;
        $location->google_calendar_id = $request->google_calendar_id;
        $location->save();

        \Brian2694\Toastr\Facades\Toastr::success('Location Successfully Saved');

        return redirect('/admin/location');
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
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        //
        $location = Location::findOrFail($id);
        $location->name = $request->name;
        $location->streetAddress = $request->streetAddress;
        $location->city = $request->city;
        $location->postalCode = $request->postalCode;
        $location->mobile = $request->mobile;
        $location->email = $request->email;
        $location->VAT = $request->VAT;
        $location->google_calendar_id = $request->google_calendar_id;
        $location->update();

        \Brian2694\Toastr\Facades\Toastr::success('Location Successfully Updated');

        return redirect('/admin/location');
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
        $locations = Location::where('archived', 1)
            ->latest()
            ->paginate(10);

        return view('admin.locations.archive', compact('locations'));
    }
}
