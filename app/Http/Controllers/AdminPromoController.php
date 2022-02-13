<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromoRequest;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.promos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.promos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request)
    {
        //
        if($request->date_from > $request->date_to)
        {
            Session::flash('promo_date', 'You cant book in the past. Please select new date');
            return redirect()->back();
        }
        $promo = new Promo();
        $promo->name = $request->name;
        $promo->date_from = $request->date_from;
        $promo->date_to = $request->date_to;
        $promo->discount = $request->discount;
        $promo->description = $request->description;

        $promo->save();

        \Brian2694\Toastr\Facades\Toastr::success('Promo Successfully Saved');

        return redirect('admin/promos');
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
        $promo = Promo::findOrFail($id);
        return view('admin.promos.show', compact('promo'));
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
        $promo = Promo::findOrFail($id);
        return view('admin.promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromoRequest $request, $id)
    {
        //
        if($request->date_from > $request->date_to)
        {
            Session::flash('promo_date', 'You cant book in the past. Please select new date');
            return redirect()->back();
        }
        $promo = Promo::findOrFail($id);
        $promo->name = $request->name;
        $promo->date_from = $request->date_from;
        $promo->date_to = $request->date_to;
        $promo->discount = $request->discount;
        $promo->description = $request->description;

        $promo->update();

        \Brian2694\Toastr\Facades\Toastr::success('Promo Successfully Updated');

        return redirect('admin/promos');
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
        $promos = Promo::where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('admin.promos.archive', compact('promos'));
    }
}
