<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Models\Job;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Route;

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


// Jobs Routes
Route::resource('jobs', JobController::class)->middleware('auth')->except(['index', 'show']);

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

 // manage Jobs

Route::get('/job/manage', [JobController::class, 'manage'])->name('jobs.manage');


// User Routes

//Register
Route::get('/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::post('/doRegister', [UserController::class, 'doRegister'])->name('user.doRegister');

//login
Route::get('/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/doLogin', [UserController::class, 'doLogin'])->name('user.doLogin');


//logout
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');


// Route::get('/jobs/{job}', function (Job $job) {
//     return view('jobs.show', [
//         'job' => $job
//     ]);
// })->name('jobs.show');
