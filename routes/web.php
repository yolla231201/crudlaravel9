<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;

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

Route::get('/siswa', [EmployeeController::class, 'index'])->name('siswa');

Route::get('/tambahsiswa', [EmployeeController::class, 'tambahsiswa'])->name('tambahsiswa');
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}', [EmployeeController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');
Route::get('/hapusdata/{id}', [EmployeeController::class, 'hapusdata'])->name('hapusdata');


// export pdf
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');

Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');

