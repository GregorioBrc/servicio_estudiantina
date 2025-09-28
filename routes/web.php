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
Route::get('/', [HomeController::class, 'index'])->name('home');

//////////////////////////////////////////////////////
/////////////// VISTAS DEL ADMINISTRADOR /////////////
//////////////////////////////////////////////////////

// Vista principal del administrador
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// CRUD con resource para entidades principales
Route::resource('admin/autores', AutorController::class)
    ->parameters(['autores' => 'autor'])
    ->names('admin.autores');

Route::resource('admin/usuarios', UserController::class)
    ->parameters(['usuarios' => 'usuario'])
    ->names('admin.usuarios');

Route::resource('admin/obras', ObraController::class)
    ->parameters(['obras' => 'obra'])
    ->names('admin.obras');

Route::resource('admin/partituras', PartituraController::class)
    ->parameters(['partituras' => 'partitura'])
    ->names('admin.partituras');

Route::resource('admin/instrumentos', InstrumentoController::class)
    ->parameters(['instrumentos' => 'instrumento'])
    ->names('admin.instrumentos');

Route::resource('admin/tipo_contribuciones', TipoContribucionController::class)
    ->parameters(['tipo_contribuciones' => 'tipo_contribucion'])
    ->names('admin.tipo_contribuciones');

Route::resource('admin/usuario_inventarios', UsuarioInventarioController::class)
    ->parameters(['usuario_inventarios' => 'usuario_inventario'])
    ->names('admin.usuario_inventarios');

Route::resource('admin/estantes', EstanteController::class)
    ->parameters(['estantes' => 'estante'])
    ->names('admin.estantes');

Route::resource('admin/prestamos', PrestamoController::class)
    ->parameters(['prestamos' => 'prestamo'])
    ->names('admin.prestamos');

Route::resource('admin/inventarios', InventarioController::class)
    ->parameters(['inventarios' => 'inventario'])
    ->names('admin.inventarios');

//////////////////////////////////////////////////////
////////////////// VISTAS DEL USUARIO ////////////////
//////////////////////////////////////////////////////

// Vista principal del usuario
Route::get('/usuario', [UserController::class, 'dashboard'])->name('usuario.dashboard');

// Vista de partituras del usuario
Route::get('/usuario/partituras', [PartituraController::class, 'misPartituras'])->name('usuario.partituras');
Route::get('/usuario/partituras/{id}', [PartituraController::class, 'usuario_ShowPartitura'])->where('id', '[0-9]+')->name('usuario.show.partitura');

// Vista de perfil del usuario
Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->where('id', '[0-9]+')->name('usuario.perfil');
//Cambiar contraseña usuario
Route::post('/usuario/cambiar-contraseña', [UserController::class, 'CambiarPassword'])->name('usuario.cambiar-password');


///////////////////////////////
//////////// Login ////////////
///////////////////////////////

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

