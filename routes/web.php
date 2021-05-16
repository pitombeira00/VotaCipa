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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Votar/{name}', 'VotacaoController@votacao')->name('votar');
Route::post('/Votou/', 'VotacaoController@voto')->name('votar.salvar');


Route::group(['middleware'=>['auth']], function() {

    Route::resource('Funcionarios', FuncionariosController::class);
    Route::resource('Votacao', VotacaoController::class);
    Route::resource('Candidatos', CandidatosController::class);
    Route::get('Votacao/Candidatos/{id}', 'CandidatosController@indexPorVotacao')->name('candidatos.votacao');
    Route::get('Votacao/Candidatos/Criar/{id}', 'CandidatosController@createPorVotacao')->name('candidatos.incluir');

});
