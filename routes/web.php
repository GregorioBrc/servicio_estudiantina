<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//////////////////////////////////////////////////////
///////////////VISTAS DEL ADMINISTRADOR///////////////
//////////////////////////////////////////////////////
//CRUD usuarios//
Route::get('/admin', function () {
    return 'Vista administrador';
});

Route::get('/admin/usuarios', function () {
    return 'Vista CRUD usuarios';
});

Route::get('/admin/usuarios/crear', function () {
    return 'Vista crear usuario';
});

Route::post('/admin/usuarios/crear', function () {
    return 'Acción crear usuario';
});

Route::post('/admin/usuarios/borrar/{id}', function ($id) {
    return "Acción borrar usuario: $id";
})->where('id', '[0-9]+');;

Route::get('/admin/usuarios/{id}', function ($id) {
    return "Vista detalle usuario: $id";
})->where('id', '[0-9]+');

Route::get('/admin/usuarios/{id}/editar', function ($id) {
    return "Vista editar usuario: $id";
})->where('id', '[0-9]+');

Route::post('/admin/usuarios/{id}/editar', function ($id) {
    return "Acción editar usuario: $id";
})->where('id', '[0-9]+');

//CRUD partituras//
Route::get('/admin/partituras', function () {
    return 'Vista CRUD partituras';
});

Route::get('/admin/partituras/crear', function () {
    return 'Vista crear partitura';
});

Route::post('/admin/partituras/crear', function () {
    return 'Acción crear partitura';
});

Route::post('/admin/partituras/borrar/{id}', function ($id) {
    return "Acción borrar partitura: $id";
})->where('id', '[0-9]+');

Route::get('/admin/partituras/{id}', function ($id) {
    return "Vista detalle partitura: $id";
})->where('id', '[0-9]+');

Route::get('/admin/partituras/{id}/editar', function ($id) {
    return "Vista editar partitura: $id";
})->where('id', '[0-9]+');

Route::post('/admin/partituras/{id}/editar', function ($id) {
    return "Acción editar partitura: $id";
})->where('id', '[0-9]+');

//////////////////////////////////////////////////////
//////////////////VISTAS DEL USUARIO//////////////////
//////////////////////////////////////////////////////
Route::get('/usuario', function () {
    return 'Vista usuario';
});

Route::get('/usuario/partituras', function () {
    return 'Vista mis partituras';
});

Route::get('/usuario/perfil/{id}', function ($id) {
    return "Vista perfil usuario $id";
})->where('id', '[0-9]+');





