<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Log;
use Auth;
use App\Services\UserLog;

class PermissionController extends Controller
{
    //模块列表
    public function index($permission_id=0)
    {


    	$permissions = Permission::all();

    	$data=['page_title'=>trans('sys.permission_list'),
    			'permissions'=>$permissions];

    	if($permission_id>0)
    	{
    		$data['permission']=Permission::find($permission_id);
    	}

    	UserLog::info('Showing permissons');

    	return view('admin/permission_list')->with($data);
    }

    /**
	 * 保存模块信息
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request,$permission_id=0)
	{
		if($permission_id<=0)
		{
			$this->validate($request, [
	        'permission_name' => 'required|unique:permissions,name|max:255',
	        'permission_displayname' => 'required|max:255',
	        'permission_description' => 'required|max:255',
	    	]);
		}
		else
		{
			$this->validate($request, [
	        'permission_name' => 'required|max:255',
	        'permission_displayname' => 'required|max:255',
	        'permission_description' => 'required|max:255',
	    	]);
		}
	    
	    if($permission_id<=0)
	    	$permission=new Permission();
		else
			$permission=Permission::find($permission_id);
	    $permission->name=$request->input('permission_name');
	    $permission->display_name=$request->input('permission_displayname');
	    $permission->description=$request->input('permission_description');
	    $permission->save();

	    UserLog::info('Store permisson:'.json_encode($permission));

	    return redirect('admin/permissions');
	}
}
