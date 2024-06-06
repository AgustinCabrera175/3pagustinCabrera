<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssistController; 
use App\Http\Controllers\PDFController;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
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

Route::resource('products', ProductController::class);

Route::middleware(['log.ip'])->group(function () {
        Route::resource('students', StudentController::class);
});

Route::get('/logueo/user', function(){
    return view('students.log');
})->name('logueo');

Route::post('/students/agregarAsistencias', [StudentController::class, 'agregarAsistencia'])->name('students.agregarAsistencia');
Route::get('/students/{student}/assists',[StudentController::class,'assistsView'])->name('students.assistsView');
Route::post('/students/agregarAsistencias/realizarAsistencia/{student}', [AssistController::class, 'asistencia'])->name('students.asistencia');

Route::get('/cumple', [StudentController::class, 'cumple'])->name('students.cumple');

Route::get('/parametros', [AssistController::class, 'mostrarParametros'])->name('parametros');
Route::put('/parametros/{id}/editar', [AssistController::class, 'editarParametros'])->name('parametros.editar');
Route::post('/parametros/agregar', [AssistController::class, 'agregarParametros'])->name('parametros.agregar');

Route::get('/pdf/students', [StudentController::class,'generatePDF'])->name('students.pdf');
//Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

Route::get('/excel/students', function () {
    return Excel::download(new StudentsExport, 'students.xlsx');
})->name('students.excel');

require __DIR__.'/auth.php';
