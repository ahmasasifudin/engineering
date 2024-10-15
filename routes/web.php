<?php

use App\Http\Controllers\EmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/login', [HomeController::class, 'loginPage'])->middleware('guest');
Route::post('/login', [HomeController::class, 'authenticate']);
Route::post('/logout', [HomeController::class, 'logout']);

Route::group(['middleware' => ['auth', 'admin:admin']], function(){
    Route::get('/material', [MaterialController::class, 'index']);
    Route::get('/material/edit/{id}', [MaterialController::class, 'showEdit']);
    Route::post('/material/edit/{id}/simpan', [MaterialController::class, 'updateData']);
    Route::get('/material/delete/{id}', [MaterialController::class, 'deleteData']);
    
    Route::get('/new-material', [MaterialController::class, 'tampilanTambahMaterial']);
    Route::post('/new-material', [MaterialController::class, 'tambah']);
    
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'showEdit']);
    Route::post('/supplier/edit/{id}/simpan', [SupplierController::class, 'updateData']);
    Route::get('/supplier/delete/{id}', [SupplierController::class, 'deleteData']);
    
    Route::get('/new-supplier', [SupplierController::class, 'tampilanTambahSupplier']);
    Route::post('/new-supplier', [SupplierController::class, 'tambah']);

    Route::get('/schedule', [ScheduleController::class, 'index']);
    Route::get('/schedule-calendar', [ScheduleController::class, 'detailCalendar']);
    Route::get('/schedule/edit/{id}', [ScheduleController::class, 'showEdit']);
    Route::post('/schedule/edit/{id}/simpan', [ScheduleController::class, 'updateData']);
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'deleteData']);

    Route::get('/new-schedule', [ScheduleController::class, 'tampilanTambahSchedule']);
    Route::get('/new-schedule/{id}', [ScheduleController::class, 'getData']);
    Route::post('/new-schedule', [ScheduleController::class, 'tambah']);

    Route::post('/report/accept/{id}', [ReportController::class, 'accept']);
    Route::post('/report/keterangan/{id}', [ReportController::class, 'updateKeterangan']);
});

Route::get('/report', [ReportController::class, 'index'])->middleware('auth');
Route::get('/report/edit/{id}', [ReportController::class, 'showEdit'])->middleware('auth');
Route::post('/report/edit/{id}/simpan', [ReportController::class, 'updateData'])->middleware('auth');
Route::get('/report/delete/{id}', [ReportController::class, 'deleteData'])->middleware('auth');

Route::get('/view-report/{id}', [ReportController::class, 'viewReport'])->middleware('auth');

Route::get('/new-report', [ReportController::class, 'tampilanTambahReport'])->middleware('auth');
Route::get('/new-report/{id}', [ReportController::class, 'getData'])->middleware('auth');
Route::post('/new-report', [ReportController::class, 'tambah'])->middleware('auth');
