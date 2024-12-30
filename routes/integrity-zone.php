<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegrityZoneController;

Route::resource('/admin/integrity-zone', IntegrityZoneController::class);
Route::post('/ubah-status-integrity/{integrity_zone:uuid}', [IntegrityZoneController::class, 'ubah_status']);
Route::get('/DataTablesIntegrity', [IntegrityZoneController::class, 'dataTables']);
