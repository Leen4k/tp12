<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\CommentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function (){
    return "hello";
});

Route::post('/authors', [AuthorController::class, 'create']);
Route::get('/authors/{name}/articles', [AuthorController::class, 'getArticles']);
Route::get('/authors/{name}/audiences', [AuthorController::class, 'getAudiences']);

Route::post('/articles', [ArticleController::class, 'create']);
Route::get('/articles/{name}/audiences', [ArticleController::class, 'getAudiences']);

Route::post('/audiences', [AudienceController::class, 'create']);
Route::get('/audiences/{name}/comments', [AudienceController::class, 'getComments']);

Route::post('/comments', [CommentController::class, 'create']);
Route::get('/comments-with-topics', [CommentController::class, 'getAllCommentsWithTopics']);




