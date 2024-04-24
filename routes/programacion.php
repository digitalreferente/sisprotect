<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;

	// P R O G R A M A C I O N
	Route::get('/listado-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'listadodoprogramacion'])->name('programacion.listadoprogramacion');
	Route::get('/nueva-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'nuevaprogramacion'])->name('programacion.nuevaprogramacion');
	 Route::post('/obtener-tarifas', [App\Http\Controllers\Programacion\ProgramacionController::class, 'obtenertarifas'])->name('programacion.obtenertarifas');