<?php

namespace App\Http\Controllers;


use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $servicecategories = ServiceCategory::where('archived', 0)
            ->pluck('name', 'id');

        return view('admin.services.create',compact('servicecategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        //
        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->servicecategory_id = $request->servicecategory_id;
        $service->description = $request->description;
        $service['slug'] = Str::slug($request->name, '-');

        $service->save();

        \Brian2694\Toastr\Facades\Toastr::success('Service Successfully Saved');

        return redirect('admin/services');
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
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
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
        $service = Service::findOrFail($id);
        $servicecategories = ServiceCategory::where('archived', 0)
            ->pluck('name', 'id');

        return view('admin.services.edit', compact('service', 'servicecategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        //
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->servicecategory_id = $request->servicecategory_id;
        $service->update();

        \Brian2694\Toastr\Facades\Toastr::success('Service Successfully Updated');

        return redirect('/admin/services');
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
        $services = Service::where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('admin.services.archive', compact('services'));
    }

    public function layout()
    {
        $services = Service::all();
        return view('admin.services.layout', compact('services'));
    }
}
