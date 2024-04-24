<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;

	//  C L I E N T E
		Route::get('/listado-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'listadocliente'])->name('cliente.listadocliente');
		Route::post('/clientes-datatable', [App\Http\Controllers\Cliente\ClienteController::class, 'clientelistadodatatable'])->name('cliente.clientelistadodatatable');
		Route::get('/agregar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'agregarcliente'])->name('cliente.agregarcliente');
		Route::post('/guardar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'guardarcliente'])->name('cliente.guardarcliente'); 
		Route::get('/editar-cliente/{cliente}', [App\Http\Controllers\Cliente\ClienteController::class, 'editarcliente'])->name('cliente.editarcliente');
		Route::post('/eliminar-contacto-operativo', [App\Http\Controllers\Cliente\ClienteController::class, 'eliminarcontactooperativo'])->name('cliente.eliminarcontactooperativo');
		Route::post('/eliminar-contacto-facturacion', [App\Http\Controllers\Cliente\ClienteController::class, 'eliminarcontactofacturacion'])->name('cliente.eliminarcontactofacturacion');
		Route::post('/update-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'updatecliente'])->name('cliente.updatecliente'); 
		Route::post('/desactivar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'desactivarcliente'])->name('cliente.desactivarcliente');
		Route::get('/listado-clientes-inactivos', [App\Http\Controllers\Cliente\ClienteController::class, 'listadoclienteinactivo'])->name('cliente.listadoclienteinactivo');
		Route::post('/activar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'activarcliente'])->name('cliente.activarcliente');
		Route::get('/ver-cliente/{cliente}', [App\Http\Controllers\Cliente\ClienteController::class, 'vercliente'])->name('cliente.vercliente');