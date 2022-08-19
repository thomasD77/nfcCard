<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageCropperController extends Controller
{
    public function upload(Request $request)
    {
        $nameExt = $this->getNameAndExt($request->name);
        $name = $nameExt['name'];
        $ext = $nameExt['ext'];
        if(!in_array($ext, $this->getValidExtensions())){
            return response()->json(['success' => "no"]);
        }

        $folderPath = public_path($request->base);

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . $name . '.' . $ext;

        if(file_exists($file)){
            unlink($file);
        }
        file_put_contents($file, $image_base64);

        return response()->json(['success'=>'success', 'file' => $file]);
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
