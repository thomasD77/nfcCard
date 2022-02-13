<?php

namespace App\Http\Controllers;

use App\Models\CompanyCredential;
use App\Models\Content;
use App\Models\HomePage;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class HomePageController extends Controller
{
    public $homeCount = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $credential = HomePage::query()
            ->latest()
            ->first();

        $photos = Photo::query()
            ->where('home_page_id', $credential->id)
            ->get();

        $contents = Content::all();

        return view('admin.pages.home', compact('credential', 'photos', 'contents'));
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
        //Get page data
        $creditential = HomePage::findOrFail($id);

        //Update all input records
        for ($i = 1; $i <= $this->homeCount; $i++ )
        {
            $input = 'input_' . $i;
            $creditential->$input = $request->$input;
            $creditential->update();
        }

        //Update all text records
        for ($i = 1; $i <= $this->homeCount; $i++ )
        {
            $text = 'text_' . $i;
            $creditential->$text = $request->$text;
            $creditential->update();
        }

        //Create all photos
        for ($i = 1; $i <= $this->homeCount; $i++ )
        {
            $photo = Photo::query()
                ->where('id', $i)
                ->where('home_page_id', $creditential->id)
                ->first();

            if($photo == null)
            {
                if ($file = $request->file('photo_' . $i))
                {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('images/content', $name);

                    $width = 'pictWidth' . $i;
                    $height = 'pictHeight' . $i;

                    //Script for customize size
                    if ($request->$width && $request->$height != null)
                    {
                        $path = 'images/content/' . $name;
                        $image = Image::make($path);
                        $image->resize($request->$width , $request->$height);
                        $image->save('images/content/' . $name);
                        Photo::create([
                            'file' => $name,
                            'home_page_id' => $creditential->id,
                            'WxH' => $request->$width . 'x' . $request->$height,
                        ]);
                    }
                    //Script for original size
                    else
                    {
                        Photo::create([
                            'file' => $name,
                            'home_page_id' => $creditential->id,
                        ]);
                    }
                }
            }
        }

        //Update all photos
        for ($i = 1; $i <= $this->homeCount; $i++)
        {
            //Find picture to update
            $ex__pic = 'ex__pic' . $i;
            if($request->$ex__pic == $i)
            {
                $photo = Photo::findOrFail($i);

                if ($file = $request->file('photo_' . $i))
                {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('images/content', $name);
                    $photo->file = $name;
                }

                //Script for customize size
                $width = 'pictWidth' . $i;
                $height = 'pictHeight' . $i;
                if ($request->$width && $request->$height != null)
                {
                    $path = 'images/content/' . $photo->file;
                    $image = Image::make($path);
                    $image->resize($request->$width , $request->$height);
                    $image->save('images/content/' . $photo->file);
                    $photo->WxH = $request->$width . 'x' . $request->$height;
                }

                //Set status for picture
                $is_active = 'is_active' . $i;
                if($request->$is_active != null)
                {
                    $photo->is_active = 1;
                }
                else
                {
                    $photo->is_active = 'null';
                }

                $photo->home_page_id = $creditential->id;
                $photo->update();
            }
        }

        Session::flash('flash_message', 'Your Home Page Builder is Updated');

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
