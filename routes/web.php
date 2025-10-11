<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\InstrumentoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartituraController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\TipoContribucionController;
use App\Http\Controllers\UsuarioInventarioController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

//////////////////////////////////////////////////////
/////////////// VISTAS DEL ADMINISTRADOR /////////////
//////////////////////////////////////////////////////

// Vista principal del administrador
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');

// CRUD con resource para entidades principales
Route::resource('admin/autores', AutorController::class)
    ->parameters(['autores' => 'autor'])
    ->names('admin.autores')
    ->middleware('admin');

Route::resource('admin/usuarios', UserController::class)
    ->parameters(['usuarios' => 'usuario'])
    ->names('admin.usuarios')
    ->middleware('admin');

Route::resource('admin/obras', ObraController::class)
    ->parameters(['obras' => 'obra'])
    ->names('admin.obras')
    ->middleware('admin');

Route::resource('admin/partituras', PartituraController::class)
    ->parameters(['partituras' => 'partitura'])
    ->names('admin.partituras')
    ->middleware('admin');

Route::resource('admin/instrumentos', InstrumentoController::class)
    ->parameters(['instrumentos' => 'instrumento'])
    ->names('admin.instrumentos')
    ->middleware('admin');

Route::resource('admin/tipo_contribuciones', TipoContribucionController::class)
    ->parameters(['tipo_contribuciones' => 'tipo_contribucion'])
    ->names('admin.tipo_contribuciones')
    ->middleware('admin');

///////////////////////////////////////////////
/////////////// API Inventario ////////////////
///////////////////////////////////////////////

Route::resource('admin/usuario_inventarios', UsuarioInventarioController::class)
    ->except("create", "edit")
    ->parameters(['usuario_inventarios' => 'usuario_inventario'])
    ->names('admin.usuario_inventarios')
    ->middleware('admin');

Route::resource('admin/estantes', EstanteController::class)
    ->except("create", "edit", "show")
    ->parameters(['estantes' => 'estante'])
    ->names('admin.estantes')
    ->middleware('admin');

Route::resource('admin/prestamos', PrestamoController::class)
    ->except("create", "edit")
    ->parameters(['prestamos' => 'prestamo'])
    ->names('admin.prestamos')
    ->middleware('admin');

Route::resource('admin/inventarios', InventarioController::class)
    ->except("create", "edit")
    ->parameters(['inventarios' => 'inventario'])
    ->names('admin.inventarios')
    ->middleware('admin');

//////////////////////////////////////////////////////
////////////////// VISTAS DEL USUARIO ////////////////
//////////////////////////////////////////////////////

// Vista principal del usuario
Route::get('/usuario', [UserController::class, 'dashboard'])->name('usuario.dashboard')->middleware('user');

// Vista de partituras del usuario
Route::get('/usuario/partituras', [PartituraController::class, 'misPartituras'])->name('usuario.partituras')->middleware('user');
Route::get('/usuario/partituras-por-autor', [PartituraController::class, 'misPartiturasPorAutor'])->name('usuario.partituras.autor')->middleware('user');
Route::get('/usuario/partituras/{id}', [PartituraController::class, 'usuario_ShowPartitura'])->where('id', '[0-9]+')->name('usuario.show.partitura')->middleware('user');

// Vista de perfil del usuario
Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->where('id', '[0-9]+')->name('usuario.perfil')->middleware('user');
//Cambiar contraseña usuario
Route::post('/usuario/cambiar-contraseña', [UserController::class, 'CambiarPassword'])->name('usuario.cambiar-password')->middleware('user');



///////////////////////////////
//////////// Login ////////////
///////////////////////////////

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.store')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgotten-password', [LoginController::class, 'showForgottenPasswordForm'])->name('password.request')->middleware('guest');
Route::post('/forgotten-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [LoginController::class, 'reset'])->name('password.update')->middleware('guest');

