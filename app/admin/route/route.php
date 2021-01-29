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
})->middleware(\app\middleware\CheckAdminLgoin::class);
//登录
Route::get('login', 'Login/login')->name('login');
Route::post('dologin', 'Login/dologin')->name('dologin');
Route::get('captcha/[:id]', "\\think\\captcha\\CaptchaController@index")->name('/captcha');
