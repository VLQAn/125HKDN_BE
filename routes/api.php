<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChuongController;
use App\Http\Controllers\BaiHocController;
use App\Http\Controllers\CauHoiController;
use App\Http\Controllers\ChonAnhController;
use App\Http\Controllers\DienTuController;
use App\Http\Controllers\NgheHoiThoaiController;
use App\Http\Controllers\NgheXepCauController;
use App\Http\Controllers\TracNghiemController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TienDoHocController;
use App\Http\Controllers\Api\AuthController;

Route::get('/users/top-score', [UserController::class, 'top5UserDiemCaoNhat']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{point}/{id}/{idbaihoc}', [UserController::class, 'AddPoints']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/chuong', [ChuongController::class, 'index']);
Route::get('/chuong/{id}', [ChuongController::class, 'show']);
Route::get('/chuong/{id}/baihoc', [BaiHocController::class, 'getByChuong']);

Route::get('/baihoc', [BaiHocController::class, 'index']);
Route::get('/baihoc/{id}', [BaiHocController::class, 'show']);
Route::get('/baihoc/{id}/cauhoi', [CauHoiController::class, 'getByBaiHoc']);
Route::get('/baihoc/{id}/cauhoichitiet', [CauHoiController::class, 'getChitietCauHoiByBaiHoc']);

Route::get('/cauhoi', [CauHoiController::class, 'index']);
Route::get('/cauhoi/{id}', [CauHoiController::class, 'show']);

Route::get('/chonanh/{id}', [ChonAnhController::class, 'show']);

Route::get('/dientu/{id}', [DienTuController::class, 'show']);

Route::get('/nghehoithoai/{id}', [NgheHoiThoaiController::class, 'show']);

Route::get('/nghexepcau/{id}', [NgheXepCauController::class, 'show']);

Route::get('/video/{id}', [VideoController::class, 'show']);

Route::get('/tracnghiem/{id}', [TracNghiemController::class, 'show']);

Route::get('/user/{id}/baihoc/dang-hoc', [TienDoHocController::class, 'baiHocDangHocGanNhat']);
