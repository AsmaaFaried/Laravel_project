<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::get('/posts',[PostController::class,'index'])->name('post.index');
Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
Route::post('/posts/store',[PostController::class,'store'])->name('post.store');
Route::get('/posts/{post}',[PostController::class,'show'])->name('post.show');
Route::get('/posts/editPost/{postId}',[PostController::class,'editPost'])->name('post.edit');
Route::put('/posts/update/{postId}',[PostController::class,'update'])->name('post.update');
Route::delete('/posts/delete/{postId}',[PostController::class,'destroy'])->name('post.delete');
Route::post('/posts/comment/{postId}',[CommentController::class,'addComment'])->name('create.comment');
Route::delete('/posts/comment/delete/{postId}/{commentId}',[CommentController::class,'destroyComment'])->name('delete.comment');
