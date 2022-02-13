<?php

namespace App\Http\Controllers;

use App\Http\Requests\SourceRequest;
use App\Models\source;
use Illuminate\Http\Request;

class AdminSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.sources.index');
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
    public function store(SourceRequest $request)
    {
        //
        $source = new Source();
        $source->name = $request->name;

        $source->save();

        \Brian2694\Toastr\Facades\Toastr::success('Source Successfully Saved');

        return redirect('admin/sources');
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
    public function update(SourceRequest $request, $id)
    {
        //
        $source = Source::findOrFail($id);
        $source->name = $request->name;

        $source->update();

        return redirect('admin/sources');
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
        $sources = Source::where('archived', 0)
            ->paginate(10);

        return view('admin.sources.archive', compact('sources'));
    }
}
