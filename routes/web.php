<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

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

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('student-list');

Route::get('/sms/send', [App\Http\Controllers\SMS\SmsController::class, 'send']);
Route::get('/sms/receive', [App\Http\Controllers\SMS\SmsController::class, 'receive']);

//datatables route for students
/*Route::resource('students','\App\Http\Controllers\StudentsController');*/

Route::get('show/students',[StudentsController::class,'show']);
Route::get('/students',[StudentsController::class,'getStudent']);

Route::post('/students',[StudentsController::class,'postStudent']);


