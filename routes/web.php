<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartituraController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

//////////////////////////////////////////////////////
/////////////// VISTAS DEL ADMINISTRADOR /////////////
//////////////////////////////////////////////////////

// Vista principal del administrador
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// CRUD usuarios
Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/admin/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/admin/usuarios/crear', [UserController::class, 'store'])->name('usuarios.store');
Route::post('/admin/usuarios/borrar/{id}', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('usuarios.destroy');
Route::get('/admin/usuarios/{id}', [UserController::class, 'show'])->where('id', '[0-9]+')->name('usuarios.show');
Route::get('/admin/usuarios/{id}/editar', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('usuarios.edit');
Route::post('/admin/usuarios/{id}/editar', [UserController::class, 'update'])->where('id', '[0-9]+')->name('usuarios.update');

// CRUD partituras
Route::get('/admin/partituras', [PartituraController::class, 'index'])->name('partituras.index');
Route::get('/admin/partituras/crear', [PartituraController::class, 'create'])->name('partituras.create');
Route::post('/admin/partituras/crear', [PartituraController::class, 'store'])->name('partituras.store');
Route::post('/admin/partituras/borrar/{id}', [PartituraController::class, 'destroy'])->where('id', '[0-9]+')->name('partituras.destroy');
Route::get('/admin/partituras/{id}', [PartituraController::class, 'show'])->where('id', '[0-9]+')->name('partituras.show');
Route::get('/admin/partituras/{id}/editar', [PartituraController::class, 'edit'])->where('id', '[0-9]+')->name('partituras.edit');
Route::post('/admin/partituras/{id}/editar', [PartituraController::class, 'update'])->where('id', '[0-9]+')->name('partituras.update');

//////////////////////////////////////////////////////
////////////////// VISTAS DEL USUARIO ////////////////
//////////////////////////////////////////////////////

// Vista principal del usuario
Route::get('/usuario', [UserController::class, 'dashboard'])->name('usuario.dashboard');

// Vista de partituras del usuario
Route::get('/usuario/partituras', [PartituraController::class, 'misPartituras'])->name('usuario.partituras');

// Vista de perfil del usuario
Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->where('id', '[0-9]+')->name('usuario.perfil');





