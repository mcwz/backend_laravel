<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\Services\UserLog;

class UserController extends Controller
{

	//用户列表
    public function index()
    {
    	$users = DB::table('users')->paginate(15);

    	$data=['page_title'=>trans('sys.user_list'),
    			'users'=>$users];

        UserLog::info('Showing users.');

    	return view('admin/user_list')->with($data);
    }

    //新建用户页面
    public function add()
    {
    	$data=['page_title'=>trans('sys.user_add')];
    	return view('admin/user_add')->with($data);
    }

    //保存用户
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required|unique:users,name|max:255',
            'user_email' => 'required|email|unique:users,email|max:255',
            'user_pass' => 'required|max:255',
        ]);

        $user=new User();
        $user->name=$request->input('user_name');
        $user->email=$request->input('user_email');
        $user->password=\Hash::make($request->input('user_pass'));
        $user->avatar=$request->input('avatar_real');
        $user->description=$request->input('user_description');
        $user->save();

        UserLog::info('save a user:'.json_encode($user));

        return redirect('admin/users');
    }


    public function userRole(User $user,Request $request)
    {
        $roles=Role::all();

        $userRole = DB::table("role_user")->where("role_user.user_id",$user->id)->pluck('role_id')->toArray();

        $data=['page_title'=>trans('sys.user_role'),
        'user'=>$user,
        'roles'=>$roles,
        'userRole'=>$userRole];

        

        return view('admin/user_role')->with($data);
    }

    public function userRoleStore(User $user,Request $request)
    {
        $assignRoles=$request->input('role');

        DB::table('role_user')->where('user_id', '=', $user->id)->delete();
        foreach ($assignRoles as $assignRole) {
            $user->roles()->attach($assignRole); // id only
        }

        UserLog::info('Give a user('.$user->name.') roles :'.json_encode($assignRoles));
        return redirect('admin/user/role/'.$user->id);
    }

    public function userUpdate(User $user,Request $request)
    {
        $data=['page_title'=>trans('sys.user_update'),'user'=>$user];
        return view('admin/user_update')->with($data);
    }
    //保存用户
    public function userUpdateStore(User $user,Request $request)
    {
        $this->validate($request, [
            'user_pass' => 'max:255',
        ]);

        //$user->email=$request->input('user_email');
        if($request->input('user_pass'))
            $user->password=\Hash::make($request->input('user_pass'));
        if($request->input('avatar_real'))
        $user->avatar=$request->input('avatar_real');
        $user->description=$request->input('user_description');
        $user->save();

        UserLog::info('Update a user('.$user->id.') to :'.json_encode($user));

        return redirect('admin/users');
    }
    public function showUserAvatar($userid)
    {
        $user=User::find($userid);
        if($user)
        {
            if($user->avatar!='')
                return response()->file(storage_path().'/app/'.$user->avatar);
        }
        return response()->file(public_path('bower_components/AdminLTE/dist/img/avatar5.png'));
    }

    //显示、修改个人信息
    public function profile()
    {

    }
    public function avatarUpload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $avatar = $request->file('avatar');
                //$path = $request->file('avatar')->path();
                $path = $request->file('avatar')->store('./avatar');

                return ['save_path'=>$path];
            }
        }
        return ['error'=>'No files were processed.'];
    }

}
