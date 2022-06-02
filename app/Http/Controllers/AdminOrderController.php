<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function store(Request $request)
    {
        //
        $order = new Order();

        if($file = $request->file('order')){
            $name = time(). $file->getClientOriginalName();

            $file->move('orders', $name);
            $order->file = $name;
            $order->save();
        }

        return redirect()->route('admin.home');
    }
}
