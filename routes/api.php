<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ChuongController;
use App\Http\Controllers\Api\BaiHocController;
use App\Http\Controllers\Api\CauHoiController;
use App\Http\Controllers\Api\ChonAnhController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/chuong', [ChuongController::class, 'index']);
Route::get('/chuong/{id}', [ChuongController::class, 'show']);
Route::get('/chuong/{id}/baihoc', [BaiHocController::class, 'getByChuong']);

Route::get('/baihoc', [BaiHocController::class, 'index']);
Route::get('/baihoc/{id}', [BaiHocController::class, 'show']);
Route::get('/baihoc/{id}/cauhoi', [CauHoiController::class, 'getByBaiHoc']);

Route::get('/cauhoi', [CauHoiController::class, 'index']);
Route::get('/cauhoi/{id}', [CauHoiController::class, 'show']);

Route::get('/chonanh/{id}', [ChonAnhController::class, 'show']);
