<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObraController;
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
Route::get('/admin/usuarios/{user}', [UserController::class, 'show'])->where('id', '[0-9]+')->name('usuarios.show');
Route::get('/admin/usuarios/{user}/editar', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('usuarios.edit');
Route::post('/admin/usuarios/{user}/editar', [UserController::class, 'update'])->where('id', '[0-9]+')->name('usuarios.update');
Route::post('/admin/usuarios/borrar/{user}', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('usuarios.destroy');

// CRUD partituras
Route::get('/admin/partituras', [PartituraController::class, 'index'])->name('partituras.index');
Route::get('/admin/partituras/crear', [PartituraController::class, 'create'])->name('partituras.create');
Route::post('/admin/partituras/crear', [PartituraController::class, 'store'])->name('partituras.store');
Route::get('/admin/partituras/{partitura}', [PartituraController::class, 'show'])->where('id', '[0-9]+')->name('partituras.show');
Route::get('/admin/partituras/{partitura}/editar', [PartituraController::class, 'edit'])->where('id', '[0-9]+')->name('partituras.edit');
Route::post('/admin/partituras/{partitura}/editar', [PartituraController::class, 'update'])->where('id', '[0-9]+')->name('partituras.update');
Route::post('/admin/partituras/borrar/{partitura}', [PartituraController::class, 'destroy'])->where('id', '[0-9]+')->name('partituras.destroy');

// === NUEVAS RUTAS PARA OBRAS ===
Route::get('/admin/obras', [ObraController::class, 'index'])->name('obras.index');
Route::get('/admin/obras/crear', [ObraController::class, 'create'])->name('obras.create');
Route::post('/admin/obras/crear', [ObraController::class, 'store'])->name('obras.store');
Route::get('/admin/obras/{obra}', [ObraController::class, 'show'])->name('obras.show');
Route::get('/admin/obras/{obra}/editar', [ObraController::class, 'edit'])->name('obras.edit');
Route::post('/admin/obras/{obra}/editar', [ObraController::class, 'update'])->name('obras.update');
Route::post('/admin/obras/borrar/{obra}', [ObraController::class, 'destroy'])->name('obras.destroy');

//////////////////////////////////////////////////////
////////////////// VISTAS DEL USUARIO ////////////////
//////////////////////////////////////////////////////

// Vista principal del usuario
Route::get('/usuario', [UserController::class, 'dashboard'])->name('usuario.dashboard');

// Vista de partituras del usuario
Route::get('/usuario/partituras', [PartituraController::class, 'misPartituras'])->name('usuario.partituras');

// Vista de perfil del usuario
Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->where('id', '[0-9]+')->name('usuario.perfil');





