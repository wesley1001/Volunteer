<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function error ()
    {
        return view('home.error');
    }

    public function unavailable ()
    {
        return view('home.unavailable');
    }

} /*class*/
