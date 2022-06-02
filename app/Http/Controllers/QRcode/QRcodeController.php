<?php

namespace App\Http\Controllers\QRcode;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\URL;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeController extends Controller
{
    //This is the function that will generate the QRCODE for the SWAP CARD
    public function QRcode($id)
    {
        $Card_id = listUrl::findOrFail($id);

        //If there is a custom QR code URL
        if($Card_id->custom_QR_url != "")
        {
            $QRcode_url = $Card_id->custom_QR_url;
            $QRcode = QrCode::size(150)->backgroundColor(255,255,255)->generate($QRcode_url);
            return $QRcode;
        }
        //Then we program the default URL for the profile
        else
        {
            $currentURL = URL::first()->url;
            $QRcode_url = $currentURL . '/?' . $id;
            $QRcode = QrCode::size(150)->backgroundColor(255,255,255)->generate($QRcode_url);
            return $QRcode;
        }
    }
}
