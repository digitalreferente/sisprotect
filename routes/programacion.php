<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;

	// P R O G R A M A C I O N
	Route::get('/listado-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'listadodoprogramacion'])->name('programacion.listadoprogramacion');
	Route::post('/programacion-datatable', [App\Http\Controllers\Programacion\ProgramacionController::class, 'programaciondatatable'])->name('programacion.programaciondatatable');
	Route::get('/nueva-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'nuevaprogramacion'])->name('programacion.nuevaprogramacion');
	Route::post('/obtener-tarifas', [App\Http\Controllers\Programacion\ProgramacionController::class, 'obtenertarifas'])->name('programacion.obtenertarifas');
	Route::post('/guardar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'guardarprogramacion'])->name('programacion.guardarprogramacion'); 
	Route::get('/editar-programacion/{id}', [App\Http\Controllers\Programacion\ProgramacionController::class, 'editarprogramacion'])->name('programacion.editarprogramacion');
	Route::post('/eliminar-custodio-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'eliminarcustodioprogramacion'])->name('programacion.eliminarcustodioprogramacion');
	Route::post('/modificar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'modificarprogramacion'])->name('programacion.modificarprogramacion');
	Route::post('/desactivar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'deasactivarprogramacion'])->name('programacion.deasactivarprogramacion');
	Route::get('/catalogo-programacion-inactivos', [App\Http\Controllers\Programacion\ProgramacionController::class, 'programacioninactivas'])->name('programacion.programacioninactivas');
	Route::post('/activar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'activarprogramacion'])->name('programacion.activarprogramacion');

	// M O N I T O R E O
	Route::get('/listado-monitoreo', [App\Http\Controllers\Programacion\MonitoreoController::class, 'listadomonitoreo'])->name('monitoreo.listamonitoreo');
	Route::post('/monitoreo-datatable', [App\Http\Controllers\Programacion\MonitoreoController::class, 'monitoreodatatable'])->name('monitoreo.monitoreodatatable');