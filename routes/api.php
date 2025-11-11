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
use App\Http\Middleware\VerifyCsrfToken;

///////////////////////////////////////////////
/////////////// API Inventario ////////////////
///////////////////////////////////////////////

Route::prefix('v1')->group(function () {
    // Endpoint para que el Cliente obtenga las partituras disponibles

    // Endpoint para que el Cliente envíe una nueva solicitud de préstamo
    // Usaremos PrestamoController ya que es su responsabilidad
    Route::post('/solicitar-prestamo', [PrestamoController::class, 'apiSolicitarPrestamo'])->name('api.solicitar.prestamo');

    // Endpoint para recibir los datos de un nuevo usuario
    
    Route::post('/registrar-usuario', [UserController::class, 'apiRegistrarUsuario'])->name('api.registrar.usuario');

    Route::post('/procesar-prestamo/{id}', [PrestamoController::class, 'apiProcesarPrestamo'])->name('api.procesar.prestamo');

    Route::get('/partituras-disponibles', [PartituraController::class, 'apiPartiturasDisponibles'])->name('api.partituras.disponibles');

    Route::get('/mis-prestamos', [PrestamoController::class, 'apiMisPrestamos'])->name('api.mis.prestamos');

    Route::get('/partiturasdata', [inventarioController::class, 'apigetPartiturasData'])->name('api.listar.partituras');

    Route::get('/prestamosdata', [inventarioController::class, 'apigetPrestamosData'])->name('api.listar.prestamos');

    Route::put('/inventario/{partitura_id}/{estante_id_original}', [inventarioController::class, 'update'])->name('api.update.inventario');

    });