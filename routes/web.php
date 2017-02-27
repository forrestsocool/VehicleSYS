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

Route::get('/', function () {
    return view('welcome');
});

//Restful api 格式，实现车辆北斗定位数据的更新查询
Route::resource('beidou', 'BeiDouController',
                    ['except' => ['create', 'store', 'update', 'destroy']]);
Route::get('beidou/{id}/edit', 'BeiDouController@edit');