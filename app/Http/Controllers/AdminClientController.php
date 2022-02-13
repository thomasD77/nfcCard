<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Loyal;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $loyals = Loyal::where('archived', 0)
            ->pluck('name', 'id');

        $sources = Source::where('archived', 0)
            ->pluck('name', 'id');

        return view('admin.clients.create',compact('loyals', 'sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        //
        $client = new User();
        $client->name = $request->name;
        $client->username = $request->username;
        $client->email = $request->email;
        $client->remarks = $request->remarks;
        $client->loyal_id = $request->loyal_id;
        $client->source_id = $request->source_id;
        $client->password = "";

        $client->save();

        DB::table('user_role')->insert([                                                                          //Set Client ID in user_role migration
            'user_id' => $client->id,
            'role_id' => '3',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);

        \Brian2694\Toastr\Facades\Toastr::success('Client Successfully Saved');

        return redirect('/admin/clients');
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
        $loyals = Loyal::pluck('name', 'id')
            ->all();
        $sources = Source::pluck('name', 'id')
            ->all();

        $client = User::findOrFail($id);
        return view('admin.clients.show', compact('client', 'loyals', 'sources'));
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
        $client = User::findOrFail($id);

        $loyals = Loyal::where('archived', 0)
            ->pluck('name', 'id');

        $sources = Source::where('archived', 0)
            ->pluck('name', 'id');

        return view('admin.clients.edit',compact('loyals', 'sources', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CLientRequest $request, $id)
    {
        //
        $client = User::findOrFail($id);
        $client->name = $request->name;
        $client->username = $request->username;
        $client->email = $request->email;
        $client->remarks = $request->remarks;
        $client->loyal_id = $request->loyal_id;
        $client->source_id = $request->source_id;

        $client->update();

        \Brian2694\Toastr\Facades\Toastr::success('Client Successfully Updated');

        return redirect('/admin/clients');
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
        $name = ['client'];

        $clients = User::whereHas('roles', function($q) use($name) {
            $q->whereIn('name', $name);})
            ->where('archived', 1)
            ->latest()
            ->paginate(10);

        return view('admin.clients.archive', compact('clients'));
    }
}
