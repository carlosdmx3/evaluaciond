<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvalDocController;
use App\Http\Controllers\AvisosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SnteController;
use App\Http\Controllers\ResultadosController;
use App\Http\Controllers\DatasExportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
   
Route::middleware(["auth"])->group(function () {
    Route::resource('home', HomeController::class);
    Route::resource('evaluacion', EvalDocController::class);
    Route::resource('administrador', AdminController::class);

    Route::get('file-export', [DatasExportController::class, 'fileExport'])->name('file-export');
    Route::get('file-export-result', [DatasExportController::class, 'fileExportResultados'])->name('file-export-result');
});

Route::resource('resultados', ResultadosController::class);
