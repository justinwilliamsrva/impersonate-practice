<?php

use App\Http\Controllers\ImpersonateController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/admin/impersonate', [ImpersonateController::class,'index'])->name('impersonate');
Route::post('/admin/impersonate', [ImpersonateController::class,'impersonate'])->name('impersonatePost');


require __DIR__.'/auth.php';


//alfred13@example.net
// jevon.kuhic@example.org