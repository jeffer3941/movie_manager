<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use App\Http\Controllers\EpisodiosController;

Route::get('/', function () {
    return view('teste');
});

Route::get('/',[SeriesController::class,'index'])->name('mainPage');
Route::get('/series/criar',[SeriesController::class,'create'])->name('criarSerie');
Route::post('/series/criar',[SeriesController::class,'store']);
Route::delete('/series/{id}',[SeriesController::class,'destroy']);
Route::post('/series/{id}/editaNome',[SeriesController::class,'editaNome']);
Route::get('/serie/{serieId}/temporadas',[TemporadasController::class,'index']);
Route::get('/temporadas/{temporada}/episodios',[EpisodiosController::class,'index']);
