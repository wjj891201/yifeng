<?php

use think\facade\Route;

//Route::group('', function () {
//    // Route::get("/:ver/test", ":ver.Index/test");
//    //短信接口
//    Route::post("/:ver/getcode", ":ver.Index/getsmscode");
//    //密码找回接口
//    Route::post("/:ver/users/findpassword", ":ver.Users/findpassword");
//    //用户注册
//    Route::post("/:ver/users", ":ver.Users/create");
//
//    //基础参数
//    Route::post('/:ver/getconfig', ":ver.Classs/getClasss")->middleware('check');
//    //用户登录
//    Route::post("/:ver/login", ":ver.Login/login");
//})->allowCrossDomain(['Access-Control-Allow-Headers' => 'sign,content-type']);
//Route::group('', function () {
//    // Route::post('/:ver/test',":ver.Login/test")->middleware('check');
//    Route::post('/:ver/test1', ":ver.Login/test1")->middleware('check');
//    Route::post('/:ver/test', ":ver.Login/test");
//    Route::get("/:ver", ":ver.Index/index");
//});


Route::post("/:ver/users/findpassword", ":ver.Users/findpassword");
Route::post("/:ver/users", ":ver.Users/create");
Route::post("/:ver/getcode", ":ver.Index/getsmscode");
Route::post("/:ver/login", ":ver.Login/login");
Route::get("/:ver", ":ver.Index/index");