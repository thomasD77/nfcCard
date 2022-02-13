<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.testimonials.index');
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
        if ($_POST['g-recaptcha-response'] != "") {
            $secret = '6LeMQE4cAAAAAGZDfvcmDyD7C_cw1Bzd8FfZ7N-T';

            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);

            if ($responseData->success) {

                $data = [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'city' => $request->city,
                    'experience' => $request->experience,
                    'GDPR' => $request->GDPR,
                ];

                Testimonial::create($data);
                Session::flash('contactform_message');
            }
        }

        return redirect()->back();
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.show', compact('testimonial'));
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

    public function form()
    {
        //
        $testimonials = Testimonial::paginate(10);
        return view('admin.testimonials.form', compact('testimonials'));
    }

    public function archive()
    {
        $testimonials = Testimonial::where('archived', 0)
            ->paginate(10);

        return view('admin.testimonials.archive', compact('testimonials'));
    }
}
