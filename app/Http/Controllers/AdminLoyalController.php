<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoyalRequest;
use App\Models\Loyal;
use Illuminate\Http\Request;

class AdminLoyalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.loyals.index');
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
    public function store(LoyalRequest $request)
    {
        //
        $loyal = new Loyal();
        $loyal->name = $request->name;

        $loyal->save();

        \Brian2694\Toastr\Facades\Toastr::success('Loyalty Successfully Saved');

        return redirect('admin/loyals');
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
    public function update(LoyalRequest $request, $id)
    {
        //
        $loyal = Loyal::findOrFail($id);
        $loyal->name = $request->name;

        $loyal->update();

        return redirect('admin/loyals');
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
        $loyals = Loyal::where('archived', 0)
            ->paginate(10);

        return view('admin.loyals.archive', compact('loyals'));
    }
}
