<?php

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

Route::get('', 'MainController@Index')->name("Home");

Route::get('/ajoutNote', 'MainController@ajoutNote')->name("ajoutNote");

Route::get('inscription', 'MainController@inscription')->name("SignIn");

Route::get('connexion', 'MainController@connexion')->name("SignUp");

Route::get('noteupdated', 'MainController@note_updated')->name("noteupdated");

Route::post('traitement_profil_update', 'MainController@traitement_profil_update')->name("traitement_profil_update");


Route::get('profil', 'MainController@profil')->name("profil");

Route::get('modifierProfil', 'MainController@profilP')->name("modifierProfil");


Route::get('demo', 'MainController@demo')->name("demo");

Route::get('dashboard', 'MainController@dashboard')->name("dashboard");

Route::post('traitNM', 'MainController@traitNM')->name("traitNM");

Route::post('traitement', 'MainController@traitement')->name("traitement");

Route::post('ajoutTraitement', 'MainController@ajoutTraitement')->name("ajoutTraitement");

Route::post('traitementC', 'MainController@traitementC')->name("traitementC");

Route::get('deconnecter', 'MainController@deconnecter')->name("deconnecter");

Route::get('download_pdf', [
    "as" => "pdf_note",
    "uses" =>"MainController@DownloadPdf"
]);

