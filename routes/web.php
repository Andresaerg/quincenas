<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;

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
    /* return view('welcome'); */
    return redirect()->route('login');
});

Auth::routes();

Route::resource('libros', App\Http\Controllers\LibroController::class)->middleware('auth');
Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('proyectos', App\Http\Controllers\ProyectoController::class)->middleware('auth');
Route::get('/price/{value}', function($value){
    $price = Categoria::where('id', $value)->first()->precio;
    return response()->json(['precio' => $price]);
});
Route::delete('proyectos/delete_all/{libro}', [App\Http\Controllers\ProyectoController::class, 'delete_all'])->name('proyectos.delete_all');
Route::get('libros/{libro}/pdf', [App\Http\Controllers\LibroController::class, 'pdf'])->name('libros.pdf');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
