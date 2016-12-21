<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        return response()->file(public_path('bower_components/AdminLTE/dist/img/avatar5.png'));
    }
}
