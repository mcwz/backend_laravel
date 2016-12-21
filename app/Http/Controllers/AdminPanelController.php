<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function index(Request $request)
    {
    	$data=['page_title'=>trans('sys.sys_indexpage')];
    	return view('admin/index')->with($data);
    }

    public function noPermission()
    {
    	$data=['page_title'=>trans('sys.sys_nopermission')];
    	return view('admin/no_permission')->with($data);
    }
}
