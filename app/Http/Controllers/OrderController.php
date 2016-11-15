<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function commit ()
    {
        return view('order.commit');
    }
}
