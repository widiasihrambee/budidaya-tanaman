<?php

use App\Http\Controllers\BudidayaController;
use App\Models\Budidaya;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
    Route::get('/', function () {
        $data['budidaya'] = Budidaya::with('galleries')->get();
        return view('dashboard', $data);
    })->name('dashboard');

    Route::post('/budidaya', [BudidayaController::class, 'store'])->name('tambah');
    Route::get('/ubah/{id}', [BudidayaController::class, 'edit'])->name('ubah');
    Route::post('/budidaya/{id}', [BudidayaController::class, 'update'])->name('update');
    Route::get('/budidaya/{id}', [BudidayaController::class, 'destroy'])->name('delete');
});
