<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\File;
use App\Models\Avatar;
use App\Models\Banner;
use App\Models\User;


class ImageCropperController extends Controller
{
    public function upload(Request $request)
    {
        $nameExt = $this->getNameAndExt($request->name);
        $name = $nameExt['name'];
        $ext = $nameExt['ext'];
        if (!in_array($ext, $this->getValidExtensions())) {
            return response()->json(['success' => "no", 'error' => 'Ext']);
        }

        $folderPath = public_path($request->base);
        $this->checkFolder($folderPath);

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $name = (new \App\Models\CheckFile)->getValidFilename($name);
        $name = time() . "_" . $name;
        $file = $folderPath . $name . '.' . $ext;
        if ($request->uploadType === "profile") {
            $profile = Profile::find($request->profile_id);
            if ($request->type === "avatar") {
                if ($profile->avatar) {
                    File::delete(public_path($request->base . $profile->avatar));
                }
                file_put_contents($file, $image_base64);
                $avatar = Avatar::create(['file' => $name . "." . $ext]);
                $profile->avatar = $name . "." . $ext;
                $profile->save();
            }
            if ($request->type === "banner") {
                if ($profile->banner) {
                    File::delete(public_path($profile->banner->file));
                }
                file_put_contents($file, $image_base64);
                $banner = Banner::create(['file' => $name . "." . $ext]);
                $profile->banner_id = $banner->id;
                $profile->save();
            }
            if($request->type === "logo"){
                if($profile->logo){
                    File::delete(public_path($profile->logo->file));
                }
                file_put_contents($file, $image_base64);
                $logo = Logo::create(['file' => $name . "." .$ext]);
                $profile->logo_id = $logo->id;
                $profile->save();
            }

        } else {
            $user = User::find($request->user_id);
            if ($user->avatar) {
                File::delete(public_path($user->avatar->file));
            }
            file_put_contents($file, $image_base64);
            $avatar = Avatar::create(['file' => $name . "." . $ext]);
            $user->avatar_id = $avatar->id;
            $user->save();
        }
        return response()->json(['success' => 'success', 'file' => $file, 'name' => $name . "." . $ext]);
    }

    public function checkFolder($path){
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
    }

    public function getNameAndExt($name)
    {
        $name = explode('\\', $name);
        $name = end($name);
        $split = explode('.', $name);
        $name = $split[0];
        $ext = $split[1];
        return ['name' => $name, "ext" => $ext];
    }

    public function getValidExtensions()
    {
        return array('png', 'jpg', 'jpeg');
    }
}
