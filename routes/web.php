<?php

use App\Exports\ChatsExport;
use App\Http\Controllers\GlobalBotController as BotController;
use App\Http\Controllers\HomeController;
use App\Models\Instituciones_Organizaciones;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', HomeController::class);



Route::get("/prueba",function(){
   return Instituciones_Organizaciones::hombre()->get();
});
Route::get("/exportarchat",function(){
    return Excel::download(new ChatsExport(), 'ChatExport.xlsx');
});
