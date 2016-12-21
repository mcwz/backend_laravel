<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;
use Entrust;
use App\Services\UserLog;


class RoleController extends Controller
{

    //角色列表
    public function index(Request $request,$role_id=0)
    {        
    	$roles = Role::all();

    	$data=['page_title'=>trans('sys.role_list'),
    			'roles'=>$roles];

        if($role_id>0)
        {
            $data['role']=Role::find($role_id);
        }
        UserLog::info('Showing roles.');

    	return view('admin/role_list')->with($data);
    }

    /**
	 * 保存角色信息
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request,$role_id=0)
	{
        if($role_id<=0)
        {
            $this->validate($request, [
            'role_name' => 'required|unique:roles,name|max:255',
            'role_displayname' => 'required|max:255',
            'role_description' => 'required|max:255',
            ]);
            $role=new Role();
        }
        else
        {
             $this->validate($request, [
            'role_name' => 'required|max:255',
            'role_displayname' => 'required|max:255',
            'role_description' => 'required|max:255',
            ]);
            $role=Role::find($role_id);
        }
	    

	    
	    $role->name=$request->input('role_name');
	    $role->display_name=$request->input('role_displayname');
	    $role->description=$request->input('role_description');
	    $role->save();

        UserLog::info('Store role:'.json_encode($role));

	    return redirect('admin/roles');
	}


	public function rolePermission(Role $role,Request $request)
    {
        $permissions=Permission::all();

        $rolePermission = DB::table("permission_role")->where("permission_role.role_id",$role->id)->pluck('permission_id')->toArray();

        $data=['page_title'=>trans('sys.role_add_permission'),
        'role'=>$role,
        'permissions'=>$permissions,
        'rolePermission'=>$rolePermission];

        
        return view('admin/role_permission')->with($data);
    }

    public function rolePermissionStore(Role $role,Request $request)
    {
        $assignPermissions=$request->input('permission');

        DB::table('permission_role')->where('role_id', '=', $role->id)->delete();
        foreach ($assignPermissions as $assignPermission) {
             $role->attachPermission($assignPermission);
        }
        UserLog::info('give a role('.$role->name.') permissons:'.json_encode($assignPermissions));
        return redirect('admin/role/permission/'.$role->id);
    }

    public function del(Role $role,Request $request)
    {
        $data=['page_title'=>trans('sys.role_delete_page'),
        'role'=>$role];

        $data['role_permissions'] = DB::table('permissions')
            ->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
            ->where('permission_role.role_id', '=', $role->id)
            ->select('permissions.id','permissions.name', 'permissions.display_name', 'permissions.description')
            ->get();
        $data['role_users'] = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', '=', $role->id)
            ->select('users.id','users.name', 'users.email', 'users.description')
            ->get();

        return view('admin/role_delete_view')->with($data);
    }
    public function confirm2del(Role $role,Request $request)
    {

        DB::beginTransaction();
            
         try {
                DB::table('permission_role')->where('role_id','=',$role->id)->delete();
                DB::table('role_user')->where('role_id','=',$role->id)->delete();
                DB::table('roles')->where('id', '=', $role->id)->delete();
            }
            catch (Exception $e) {
                DB::rollBack();
            }
        DB::commit();
        UserLog::info('delete a role:'.json_encode($role));
        $request->session()->flash('operation_success', trans('sys.role_delete_success'));
        return redirect('admin/roles');

    }
}
