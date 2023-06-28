<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AutorDocumentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SistemUpravljanjaController;
use App\Http\Controllers\SistemUpravljanjaDocumentController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\TypedocumentDocumentController;
use App\Http\Controllers\UserController;
use App\Models\SistemUpravljanja;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//Show i index, get operacije
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);

Route::get('/autors',[AutorController::class,'index']);
Route::get('/autors/{id}',[AutorController::class,'show']);

Route::get('/documents',[DocumentController::class,'index']);
Route::get('/documents/{id}',[DocumentController::class,'show']);

Route::get('/sistemupravljanja',[SistemUpravljanjaController::class,'index']);
Route::get('/sistemupravljanja/{id}',[SistemUpravljanjaController::class,'show']);

Route::get('/typedocuments',[TypeDocumentController::class,'index']);
Route::get('/typedocuments/{id}',[TypeDocumentController::class,'show']);

//Ugnjezdeni resursi
Route::get("/autors/{id}/documents",[AutorDocumentController::class,'index'])->name('autors.documents.index');
Route::get("/sistemupravljanja/{id}/documents",[SistemUpravljanjaDocumentController::class,'index'])->name('sistemupravljanja.documents.index');
Route::get("/typedocuments/{id}/documents",[TypedocumentDocumentController::class,'index'])->name('typedocument.documents.index');

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/profile',function(Request $request){
        return auth()->user();
    });

    Route::resource('users',UserController::class)->only(['update','destroy']);
    Route::resource('autors',AutorController::class)->only(['store','update','destroy']);
    Route::resource('documents',DocumentController::class)->only(['store','update','destroy']);;
    Route::resource('sistemupravljanja',SistemUpravljanjaController::class)->only(['store','update','destroy']);;
    Route::resource('typedocuments',TypeDocumentController::class)->only(['store','update','destroy']);;
}); 
