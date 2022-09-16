<?php

namespace App\Http\Controllers;

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

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $name = (new \App\Models\CheckFile)->getValidFilename($name);
        $name = time() . "_" . $name;
        $file = $folderPath . $name . '.' . $ext;
        if ($request->uploadType === "member") {
            $member = Member::find($request->member_id);
            if ($request->type === "avatar") {
                if ($member->avatar) {
                    File::delete(public_path($request->base . $member->avatar));
                }
                file_put_contents($file, $image_base64);
                $avatar = Avatar::create(['file' => $name . "." . $ext]);
                $member->avatar = $name . "." . $ext;
                $member->save();
            }
            if ($request->type === "banner") {
                if ($member->banner) {
                    File::delete(public_path($member->banner->file));
                }
                file_put_contents($file, $image_base64);
                $banner = Banner::create(['file' => $name . "." . $ext]);
                $member->banner_id = $banner->id;
                $member->save();
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
