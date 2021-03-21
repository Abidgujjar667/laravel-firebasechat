<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Multilevel\MultiCategoryController;
use App\Http\Controllers\Firebase\FirebaseSmsController;
use App\Http\Controllers\Firebase\FirebaseChatController;
use App\Http\Controllers\Firebase\GroupchatController;
use App\Http\Controllers\Firebase\ManageController;

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

//multilevel category with recursive
 Route::get('/categories',[MultiCategoryController::class,'index']);

 //firebase notification and message
Route::get('/firebase',[FirebaseSmsController::class,'index']);
Route::get('/firenotify',[FirebaseSmsController::class,'sendNotification']);
Route::get('/firesms',[FirebaseSmsController::class,'sendMessage']);

//firebase real time chat routes
Route::group(['prefix'=>'/admin'],function (){
    Route::get('/home',[FirebaseChatController::class,'home']);
    Route::get('/chathome',[FirebaseChatController::class,'adminChat']);
    Route::get('/sendsms',[FirebaseChatController::class,'sendSMS']);
});

Route::group(['prefix'=>'/profile'],function (){
    Route::get('/',[FirebaseChatController::class,'index']);
    Route::post('/token',[FirebaseChatController::class,'updateToken']);
});

//firebase real time chat routes manage
Route::group(['prefix'=>'/manage'],function (){
    Route::get('/',[ManageController::class,'index']);
    Route::get('/fetch',[ManageController::class,'fetch']);
    Route::post('/create',[ManageController::class,'create']);
});

//firebase real time group routes
Route::group(['prefix'=>'/group','middleware'=>'auth'],function (){
    Route::get('/chat',[GroupchatController::class,'home']);
    Route::get('/chathome',[GroupchatController::class,'adminChat']);
    Route::post('/sendsms',[GroupchatController::class,'sendSMS']);
    Route::post('/token',[GroupchatController::class,'updateToken']);
});
