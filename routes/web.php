<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
})->name('home');
//авторизация
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::post('/login',[UserController::class, 'loginPost']);
//регистрация
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost']);
//если авторизован

Route::middleware('auth')->group(function() {
    //кабинет и выход
    Route::get('/cabinet', [UserController::class, 'cabinet'])->name('cabinet');
    Route::get('/cabinetEdit', function () {
        return view('users.edit');
    })->name('edit');
    Route::post('/cabinetEdit', [UserController::class, 'cabinetEdit']);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/friends', [UserController::class, 'friends'])->name('friends');
    Route::post('/friendAdd', [UserController::class, 'friendAdd'])->name('friendAdd');
    Route::post('/friendDelete', [UserController::class, 'friendDelete'])->name('friendDelete');
    Route::post('/friendAccept', [UserController::class, 'friendAccept'])->name('friendAccept');

    Route::get('/user/{id}', [UserController::class, 'profile']);

    Route::post('/sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/chat/{id}', [ChatController::class, 'dialogue']);
    Route::get('/chats', [ChatController::class, 'chats'])->name('chats');


    Route::get('/search', function (Request $request) {
        return view('index', ['result' => User::where('full_name','LIKE', '%'.$request['full_name'].'%')->where('birthday','LIKE', '%'.$request['birthday'].'%')->get()]);
    })->name('search');

});
