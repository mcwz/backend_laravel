<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Route::get('admin/test', 'TestController@index');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('index', 'AdminPanelController@index');
    Route::get('no_permission', 'AdminPanelController@noPermission');

    Route::get('permissions/{permission_id?}', 'admin\PermissionController@index')->middleware('checkPermissionAuto:permission_manage');
    Route::post('permissions/{permission_id?}', 'admin\PermissionController@store')->middleware('checkPermissionAuto:permission_manage');

    Route::get('roles/{role_id?}', 'admin\RoleController@index')->middleware('checkPermissionAuto:role_manage');
    Route::post('roles/{role_id?}', 'admin\RoleController@store')->middleware('checkPermissionAuto:role_manage');
    Route::get('role/permission/{role}','admin\RoleController@rolePermission')->middleware('checkPermissionAuto:permission_role');
    Route::get('role/del/{role}','admin\RoleController@del')->middleware('checkPermissionAuto:role_manage');
    Route::post('role/del/{role}','admin\RoleController@confirm2del')->middleware('checkPermissionAuto:role_manage');
    Route::post('role/permission/{role}','admin\RoleController@rolePermissionStore')->middleware('checkPermissionAuto:permission_role');

    Route::get('users', 'admin\UserController@index')->middleware('checkPermissionAuto:user_manage');
    Route::get('users/add', 'admin\UserController@add')->middleware('checkPermissionAuto:user_manage');
    Route::post('users/add', 'admin\UserController@store')->middleware('checkPermissionAuto:user_manage');
    Route::get('user/update/{user}', 'admin\UserController@userUpdate')->middleware('checkPermissionAuto:user_manage');
    Route::post('user/update/{user}', 'admin\UserController@userUpdateStore')->middleware('checkPermissionAuto:user_manage');
    Route::get('user/showuseravatar/{userid}', 'admin\UserController@showUserAvatar');//->middleware('checkPermissionAuto:user_manage');

    Route::get('user/role/{user}', 'admin\UserController@userRole')->middleware('checkPermissionAuto:role_user');
    Route::post('user/role/{user}', 'admin\UserController@userRoleStore')->middleware('checkPermissionAuto:role_user'); 



    Route::get('profile', 'admin\UserController@profile');
    //Route::get('user/avatar', 'admin\UserController@showAvatar');
    Route::post('avatarUpload','admin\UserController@avatarUpload');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
