<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BatteryController;
use App\Http\Controllers\MetersController;


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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('home');

route::get('post',[HomeController::class,'post'])->middleware(['auth','admin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UsersController::class);
    Route::resource('battery', BatteryController::class);
    Route::resource('meters', MetersController::class);

    Route::get('/users/details/{id?}', [UsersController::class, 'details_meters'])->name('users.details');
    Route::get('/users/details/random/{id?}', [UsersController::class, 'rand_watt_home'])->name('users.details.random');

});

require __DIR__.'/auth.php';
