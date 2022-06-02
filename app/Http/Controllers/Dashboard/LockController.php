<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lock;
use Illuminate\Http\Request;

class LockController extends Controller
{
    //
    public function lock()
    {
        $lock = Lock::first();
        $lock->status = 0;
        $lock->update();

        return redirect('/admin');
    }

    public function unlock()
    {
        $lock = Lock::first();
        $lock->status = 1;
        $lock->update();

        return redirect('/admin');
    }
}
