<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(AdminController::class)->group(function() {
    Route::get('/admin/logout','destroy')->name('admin.logout');
    // Route::get('/admin/login','destroy')->name('admin.login');
    Route::get('/admin/profile','Profile')->name('admin.profile');
    Route::get('/admin/profile/edit','EditProfile')->name('edit.profile');
    Route::post('admin/profile/store','StoreProfile')->name('store.profile');
    Route::get('/admin/profile/changePassword','ChangePassword')->name('change.password');
    Route::post('/admin/profile/updatePassword','updatePassword')->name('update.password');


    

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
