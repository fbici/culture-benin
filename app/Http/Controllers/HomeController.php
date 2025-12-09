<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function edit($id) {
        return view ('edit', compact ('id'));
    }
    //
}
