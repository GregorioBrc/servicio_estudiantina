<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\estanteController;
use App\Http\Controllers\instrumentoController;
use App\Http\Controllers\inventarioController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartituraController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\tipoContribucionController;
use App\Http\Controllers\UsuarioInventarioController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

//////////////////////////////////////////////////////
/////////////// VISTAS DEL ADMINISTRADOR /////////////
//////////////////////////////////////////////////////

// Vista principal del administrador
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

//CRUD autores
Route::get('/admin/autores', [AutorController::class, 'index'])->name('autores.index');
Route::get('/admin/autores/crear', [AutorController::class, 'create'])->name('autores.create');
Route::post('/admin/autores/crear', [AutorController::class, 'store'])->name('autores.store');
Route::get('/admin/autores/{autor}', [AutorController::class, 'show'])->name('autores.show');
Route::get('/admin/autores/{autor}/editar', [AutorController::class, 'edit'])->name('autores.edit');
Route::post('/admin/autores/{autor}/editar', [AutorController::class, 'update'])->name('autores.update');
Route::post('/admin/autores/borrar/{autor}', [AutorController::class, 'destroy'])->name('autores.destroy');

// CRUD usuarios
Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/admin/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/admin/usuarios/crear', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/admin/usuarios/{user}', [UserController::class, 'show'])->where('id', '[0-9]+')->name('usuarios.show');
Route::get('/admin/usuarios/{user}/editar', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('usuarios.edit');
Route::post('/admin/usuarios/{user}/editar', [UserController::class, 'update'])->where('id', '[0-9]+')->name('usuarios.update');
Route::post('/admin/usuarios/borrar/{user}', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('usuarios.destroy');

// CRUD obras
Route::get('/admin/obras', [ObraController::class, 'index'])->name('obras.index');
Route::get('/admin/obras/crear', [ObraController::class, 'create'])->name('obras.create');
Route::post('/admin/obras/crear', [ObraController::class, 'store'])->name('obras.store');
Route::get('/admin/obras/{obra}', [ObraController::class, 'show'])->name('obras.show');
Route::get('/admin/obras/{obra}/editar', [ObraController::class, 'edit'])->name('obras.edit');
Route::post('/admin/obras/{obra}/editar', [ObraController::class, 'update'])->name('obras.update');
Route::post('/admin/obras/borrar/{obra}', [ObraController::class, 'destroy'])->name('obras.destroy');

// CRUD partituras
Route::get('/admin/partituras', [PartituraController::class, 'index'])->name('partituras.index');
Route::get('/admin/partituras/crear', [PartituraController::class, 'create'])->name('partituras.create');
Route::post('/admin/partituras/crear', [PartituraController::class, 'store'])->name('partituras.store');
Route::get('/admin/partituras/{partitura}', [PartituraController::class, 'show'])->where('id', '[0-9]+')->name('partituras.show');
Route::get('/admin/partituras/{partitura}/editar', [PartituraController::class, 'edit'])->where('id', '[0-9]+')->name('partituras.edit');
Route::post('/admin/partituras/{partitura}/editar', [PartituraController::class, 'update'])->where('id', '[0-9]+')->name('partituras.update');
Route::post('/admin/partituras/borrar/{partitura}', [PartituraController::class, 'destroy'])->where('id', '[0-9]+')->name('partituras.destroy');

//CRUD instrumento
Route::get('/admin/instrumentos', [instrumentoController::class, 'index'])->name('instrumentos.index');
Route::get('/admin/instrumentos/crear', [instrumentoController::class, 'create'])->name('instrumentos.create');
Route::post('/admin/instrumentos/crear', [instrumentoController::class, 'store'])->name('instrumentos.store');
Route::get('/admin/instrumentos/{instrumento}', [instrumentoController::class, 'show'])->name('instrumentos.show');
Route::get('/admin/instrumentos/{instrumento}/editar', [instrumentoController::class, 'edit'])->name('instrumentos.edit');
Route::post('/admin/instrumentos/{instrumento}/editar', [instrumentoController::class, 'update'])->name('instrumentos.update');
Route::post('/admin/instrumentos/borrar/{instrumento}', [instrumentoController::class, 'destroy'])->name('instrumentos.destroy');

//CRUD tipo contribucion
Route::get('/admin/tipo_contribuciones', [tipoContribucionController::class, 'index'])->name('tipo_contribuciones.index');
Route::get('/admin/tipo_contribuciones/crear', [tipoContribucionController::class, 'create'])->name('tipo_contribuciones.create');
Route::post('/admin/tipo_contribuciones/crear', [tipoContribucionController::class, 'store'])->name('tipo_contribuciones.store');
Route::get('/admin/tipo_contribuciones/{tipoContribucion}', [tipoContribucionController::class, 'show'])->name('tipo_contribuciones.show');
Route::get('/admin/tipo_contribuciones/{tipoContribucion}/editar', [tipoContribucionController::class, 'edit'])->name('tipo_contribuciones.edit');
Route::post('/admin/tipo_contribuciones/{tipoContribucion}/editar', [tipoContribucionController::class, 'update'])->name('tipo_contribuciones.update');
Route::post('/admin/tipo_contribuciones/borrar/{tipoContribucion}', [tipoContribucionController::class, 'destroy'])->name('tipo_contribuciones.destroy');


/////////////////////////////////////////////////
/////////////// Rutas Inventario ////////////////
/////////////////////////////////////////////////

//CRUD usuarioInventario
Route::get('/admin/usuario_inventarios', [UsuarioInventarioController::class, 'usuariosInventarioIndex'])->name('usuario_inventarios.index');
Route::get('/admin/usuario_inventarios/crear', [UsuarioInventarioController::class, 'usuariosInventarioCreate'])->name('usuario_inventarios.create');
Route::post('/admin/usuario_inventarios/crear', [UsuarioInventarioController::class, 'usuariosInventarioStore'])->name('usuario_inventarios.store');
Route::get('/admin/usuario_inventarios/{usuarioInventario}', [UsuarioInventarioController::class, 'usuariosInventarioShow'])->name('usuario_inventarios.show');
Route::get('/admin/usuario_inventarios/{usuarioInventario}/editar', [UsuarioInventarioController::class, 'usuariosInventarioEdit'])->name('usuario_inventarios.edit');
Route::post('/admin/usuario_inventarios/{usuarioInventario}/editar', [UsuarioInventarioController::class, 'usuariosInventarioUpdate'])->name('usuario_inventarios.update');
Route::post('/admin/usuario_inventarios/borrar/{usuarioInventario}', [UsuarioInventarioController::class, 'usuariosInventarioDestroy'])->name('usuario_inventarios.destroy');

//CRUD estante
Route::get('/admin/estantes', [estanteController::class, 'index'])->name('estantes.index');
Route::get('/admin/estantes/crear', [estanteController::class, 'create'])->name('estantes.create');
Route::post('/admin/estantes/crear', [estanteController::class, 'store'])->name('estantes.store');
Route::get('/admin/estantes/{estante}', [estanteController::class, 'show'])->name('estantes.show');
Route::get('/admin/estantes/{estante}/editar', [estanteController::class, 'edit'])->name('estantes.edit');
Route::post('/admin/estantes/{estante}/editar', [estanteController::class, 'update'])->name('estantes.update');
Route::post('/admin/estantes/borrar/{estante}', [estanteController::class, 'destroy'])->name('estantes.destroy');

//CRUD prestamo
Route::get('/admin/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
Route::get('/admin/prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
Route::post('/admin/prestamos/crear', [PrestamoController::class, 'store'])->name('prestamos.store');
Route::get('/admin/prestamos/{prestamo}', [PrestamoController::class, 'show'])->name('prestamos.show');
Route::get('/admin/prestamos/{prestamo}/editar', [PrestamoController::class, 'edit'])->name('prestamos.edit');
Route::post('/admin/prestamos/{prestamo}/editar', [PrestamoController::class, 'update'])->name('prestamos.update');
Route::post('/admin/prestamos/borrar/{prestamo}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');

//CRUD inventario
Route::get('/admin/inventarios', [inventarioController::class, 'index'])->name('inventarios.index');
Route::get('/admin/inventarios/crear', [inventarioController::class, 'create'])->name('inventarios.create');
Route::post('/admin/inventarios/crear', [inventarioController::class, 'store'])->name('inventarios.store');
Route::get('/admin/inventarios/{inventario}', [inventarioController::class, 'show'])->name('inventarios.show');
Route::get('/admin/inventarios/{inventario}/editar', [inventarioController::class, 'edit'])->name('inventarios.edit');
Route::post('/admin/inventarios/{inventario}/editar', [inventarioController::class, 'update'])->name('inventarios.update');
Route::post('/admin/inventarios/borrar/{inventario}', [inventarioController::class, 'destroy'])->name('inventarios.destroy');



//////////////////////////////////////////////////////
////////////////// VISTAS DEL USUARIO ////////////////
//////////////////////////////////////////////////////

// Vista principal del usuario
Route::get('/usuario', [UserController::class, 'dashboard'])->name('usuario.dashboard');

// Vista de partituras del usuario
Route::get('/usuario/partituras', [PartituraController::class, 'misPartituras'])->name('usuario.partituras');

// Vista de perfil del usuario
Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->where('id', '[0-9]+')->name('usuario.perfil');
