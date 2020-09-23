<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('accueil');
});

//Route::get('/accueil', 'CreateEpisodeController@index');
//Route::post('/accueil', 'CreateEpisodeController@store');

Route::get('/aleatoire', 'AffaireController@aleatoire');

Route::get('/affaires', 'AffaireController@index');
Route::post('/affaires', 'AffaireController@index');

Route::get('/affaire/{id}/{titre?}', 'AffaireController@show')->name('affaire.show');

Route::get('/criteres', 'AffaireController@criteres');
Route::post('/criteres', 'AffaireController@showCriteres');

Route::post('/criteresAjax', 'AffaireController@showCriteresAjax');
Route::post('/affairesAjax', 'AffaireController@episodesTriAjax');
Route::post('/resultatsAjax', 'AffaireController@criteresTriAjax');

Route::get('/carte', 'AffaireController@carte');
Route::post('/carte', 'AffaireController@carteApi');

Route::get('/episodes', 'AffaireController@episodesSelecteurSaisons');
Route::post('/episodes', 'AffaireController@episodesList');




