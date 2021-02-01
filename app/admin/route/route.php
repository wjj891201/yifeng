<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('', function() {
    Route::get('$', 'Index/index');
    Route::get('welcome', 'Index/welcome')->name('welcome');
    Route::get('setpassword', 'Manager/setpassword');
    Route::post('dopassword', 'Manager/dopassword');
    Route::get('logout', 'Login/logout')->name('logout');
    //价格类型
    Route::get('/classs$', 'Classs/index')->name("classs");
    Route::get('/classs/create', 'Classs/create')->name("classs.create");
    Route::post('/classs/save', 'Classs/save')->name("classs.save");
    Route::get('/classs/edit/:id', 'Classs/edit')->name("classs.edit");
    Route::post('/classs/update/:id', 'Classs/update')->name("classs.update");
    Route::post('/classs/delete/:id', 'Classs/delete')->name("classs.delete");
    //参数配置
    Route::get('/classitem/:classid$','Classitem/index')->name("classitem");
    Route::get('/classitem/create/:classid','Classitem/create')->name("classitem.create");
    Route::post('/classitem/save','Classitem/save')->name("classitem.save");
    Route::get('/classitem/edit/:id','Classitem/edit')->name("classitem.edit");
    Route::post('/classitem/update/:id','Classitem/update')->name("classitem.update");
    Route::post('/classitem/delete/:id','Classitem/delete')->name("classitem.delete");
    //会员管理
    Route::get('/users/list','Users/index')->name("users");
    Route::post('/users/delete/:id','Users/delete')->name("users.delete");
    Route::post('/users/status/:id','Users/status')->name("users.status");
    Route::post('/users/level/:id','Users/level')->name("users.level");
})->middleware(\app\middleware\CheckAdminLgoin::class);
//登录
Route::get('login', 'Login/login')->name('login');
Route::post('dologin', 'Login/dologin')->name('dologin');
Route::get('captcha/[:id]', "\\think\\captcha\\CaptchaController@index")->name('/captcha');
