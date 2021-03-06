<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

// Route::middleware('auth')->group(function(){
    Route::get('/',[PostController::class,'index'])->name('post.index');
    Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
    Route::post('/posts/store',[PostController::class,'store'])->name('post.store');
    Route::get('/posts/{slug}',[PostController::class,'show'])->name('post.show');
    Route::get('/posts/editPost/{slug}',[PostController::class,'editPost'])->name('post.edit');
    Route::put('/posts/update/{slug}',[PostController::class,'update'])->name('post.update');
    Route::delete('/posts/delete/{postId}',[PostController::class,'destroy'])->name('post.delete');
    Route::post('/posts/comment/{postId}',[CommentController::class,'addComment'])->name('create.comment');
    Route::delete('/posts/comment/delete/{postId}/{commentId}',[CommentController::class,'destroyComment'])->name('delete.comment');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

// });
Route::delete('/oldPosts', [PostController::class, 'deleteOldPosts'])->name('old.posts');

Auth::routes();


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.auth');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();
    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user,true);

    return redirect('/home');
});
