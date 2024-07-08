<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherLoginController;
use App\Http\Controllers\TeacherRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\EventController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//teacher用ルーティング
Route::group(['prefix' => 'teacher'], function () {
    // 登録
    Route::get('register', [TeacherRegisterController::class, 'create'])
        ->name('teacher.register');

    Route::post('register', [TeacherRegisterController::class, 'store'])
        ->name('teacher.register');

    // ログイン
    Route::get('login', [TeacherLoginController::class, 'showLoginPage'])
        ->name('teacher.login');

    Route::post('login', [TeacherLoginController::class, 'login']);
    
    
    
    // 以下の中は認証必須のエンドポイントとなる
    Route::middleware(['auth:teacher'])->group(function () {
        // ダッシュボード
        Route::get('dashboard', fn() => view('teacher.dashboard'))
            ->name('teacher.dashboard');
        
        
        // Route::view('/calendar', 'teacher.calendar.calendar');

        // Route::post('/calendar', [EventController::class, 'store'])->name('event.store');
        
        // Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
        
    });
});



//student用ルーティング
Route::group(['prefix' => 'student'], function () {
    // 登録
    Route::get('register', [StudentRegisterController::class, 'create'])
        ->name('student.register');

    Route::post('register', [StudentRegisterController::class, 'store'])
        ->name('student.register');

    // ログイン
    Route::get('login', [StudentLoginController::class, 'showLoginPage'])
        ->name('student.login');

    Route::post('login', [StudentLoginController::class, 'login']);
    
    
    
    // 以下の中は認証必須のエンドポイントとなる
    Route::middleware(['auth:student'])->group(function () {
        // ダッシュボード
        Route::get('dashboard', fn() => view('student.dashboard'))
            ->name('student.dashboard');
        
        
        // Route::view('/calendar', 'student.calendar.calendar');

        // Route::post('/calendar', [EventController::class, 'store'])->name('student?event.store');
        
        // Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
        
    });
});

Route::view('/calendar', 'teacher.calendar.calendar');

Route::post('/calendar', [EventController::class, 'store'])->name('event.store');

Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');

// Route::get('teacher/dashboard', function() {
//     return view('teacher.dashboard');
// })->name('teacher.dashboard');

