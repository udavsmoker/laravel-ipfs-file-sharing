<?php
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ActivityLogController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/howitworks', [App\Http\Controllers\HomeController::class, 'howitworks'])->name('howitworks');
Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activitylogs')->middleware('auth');
Route::get('/upload', [FileController::class, 'index'])->name('upload.form')->middleware('auth', 'verified');
Route::post('/uploadfile', [FileController::class, 'upload'])->name('upload')->middleware('auth', 'verified');
Route::get('/download', [FileController::class, 'downloadForm'])->name('download.form')->middleware('auth', 'verified');
Route::get('/downloadfile', [FileController::class, 'download'])->name('download')->middleware('auth', 'verified');


Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password-change');
Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('password-update');
