<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\AccountSettings;
use App\Models\Photo;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $postcategories = PostCategory::where('archived', 0)
        ->pluck('name', 'id');

        $account = AccountSettings::first()->SEO;

        return view('admin.posts.create',compact('postcategories', 'account'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->postcategory_id = $request->postcategory_id;
        $post->user_id = Auth::user()->id;
        $post->book = $request->datePost;
        $post['slug'] = Str::slug($request->title, '-');

        //SEO fields
        $post->seo_description = $request->seo_description;
        $post->seo_alternativeTitle = $request->seo_alternativeTitle;
        $post->seo_keywords = $request->seo_keywords;
        $post->seo_url = env('APP_URL') . "/" . "post" . "/" . Str::slug($request->title, '-');
        $post->seo_wordCount = strlen($request->body . $request->title);

        $post->save();


        if($files = $request->file('photos')){

            if(count($files) > 5 ){
                Session::flash('photo_upload', 'You can only upload 5 files. Please try again.');
                return redirect()->back();
            }

            foreach ($files as $file){

            $name = time(). $file->getClientOriginalName();
            $file->move('images/posts', $name);

            if($request->default == 'default'){
                $path =  'images/posts/' . $name;
                $image = Image::make($path);
                $image->resize(850,500);
                $image->save('images/posts/' . $name);
                $photos = array();
                $photos[] = Photo::create(['file'=>$name, 'post_id'=>$post->id]);

            }elseif($request->pictWidth != null && $request->pictHeight != null ){
                $path =  'images/posts/' . $name;
                $image = Image::make($path);
                $image->resize($request->pictWidth,$request->pictHeight);
                $image->save('images/posts/' . $name);
                $photos = array();
                $photos[] = Photo::create(['file'=>$name, 'post_id'=>$post->id]);

            }elseif ($request->default != 'default' && $request->pictWidth == null && $request->pictHeight == null ){
                Session::flash('post_crop', 'You need to fill in one of the size requirements. Please try again.');
                return redirect()->back();
            }
            }
        }


        Toastr::success('Post Successfully Saved');

        return redirect('admin/posts');
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
        $post = Post::findOrfail($id);
        return view('admin.posts.show', compact('post'));
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
        $post = Post::findOrFail($id);

        $account = AccountSettings::first()->SEO;

        $postcategories = PostCategory::where('archived', 0)
            ->pluck('name', 'id');

        return view('admin.posts.edit', compact('post', 'postcategories', 'account'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->postcategory_id = $request->postcategory_id;
        $post->book = $request->datePost;
        $post['slug'] = Str::slug($request->title, '-');

        //SEO fields
        $post->seo_description = $request->seo_description;
        $post->seo_alternativeTitle = $request->seo_alternativeTitle;
        $post->seo_keywords = $request->seo_keywords;
        $post->seo_url = env('APP_URL') . "/" . "post" . "/" . Str::slug($request->title, '-');
        $post->seo_wordCount = strlen($request->body . $request->title);

        $post->update();


        if($files = $request->file('photos')){


            if(count($files) > 5 ){
                Session::flash('photo_upload', 'You can only upload 5 files. Please try again.');
                return redirect()->back();
            }

            $oldPhotos = Photo::where('post_id', $post->id)->get();
            foreach ($oldPhotos as $photo){
                $photo->delete();
            }

            foreach ($files as $file){

                $name = time(). $file->getClientOriginalName();
                $file->move('images/posts', $name);

                if($request->default == 'default'){
                    $path =  'images/posts/' . $name;
                    $image = Image::make($path);
                    $image->resize(850,500);
                    $image->save('images/posts/' . $name);
                    $photos = array();
                    $photos[] = Photo::create(['file'=>$name, 'post_id'=>$post->id]);

                }elseif($request->pictWidth != null && $request->pictHeight != null ){
                    $path =  'images/posts/' . $name;
                    $image = Image::make($path);
                    $image->resize($request->pictWidth,$request->pictHeight);
                    $image->save('images/posts/' . $name);
                    $photos = array();
                    $photos[] = Photo::create(['file'=>$name, 'post_id'=>$post->id]);
                }elseif ($request->default != 'default' && $request->pictWidth == null && $request->pictHeight == null ){
                    Session::flash('post_crop', 'You need to fill in one of the size requirements. Please try again.');
                    return redirect()->back();
                }
            }
        }

        Toastr::success('Post Successfully Updated');

        return redirect('admin/posts');
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
        $posts = Post::where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('admin.posts.archive', compact('posts'));
    }

    public function gallery()
    {
        $photos = Photo::where('post_id', '!=', "")->paginate(60);
        return view('admin.posts.gallery', compact('photos'));
    }

    public function frontend()
    {
        $post = Post::find(1);
        return view('admin.posts.frontend', compact('post'));

    }
}
