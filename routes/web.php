<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLikeController;
use Illuminate\Support\Facades\Auth;
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
*/;



// category routes
Route::group(['prefix' => 'categories', 'middleware' => 'auth'], function () {

    Route::get('create', [CategoryController::class, 'create'])->name('categories.create');


    Route::post('store', [CategoryController::class, 'store'])->name('categories.store');


    Route::get('categories_list', [CategoryController::class, 'index'])->name('categories.list');


    Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');


    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');


    Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
});


// post routes


Route::group(['middleware' => 'auth', 'prefix' => 'posts'], function () {

    Route::get('create', [PostController::class, 'create'])->name('create');

    Route::get('list', [PostController::class, 'index'])->name('list');

    Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');

    Route::get('details/{id}', [PostController::class, 'details'])->name('details');

    Route::post('store', [PostController::class, 'store'])->name('store');

    Route::delete('delete/{id}', [PostController::class, 'destroy'])->name('delete');

    Route::put('update/{id}', [PostController::class, 'update'])->name('update');



    Route::post('storeComment/{post}', [CommentController::class, 'store'])->name('storeComment');
    Route::delete('deleteComment/{id}', [CommentController::class, 'destroy'])->name('deleteComment');
});


Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('secret', [HomeController::class, 'secret'])->name('secret')->middleware('can:page.secret');
Route::get('commentPage/{id}', [CommentController::class, 'commentPage'])->name('commentPage');
Route::get('posts-by-tags/{id}', [PostTagController::class, 'index'])->name('posts-by-tags');

Route::resource('users',UserController::class)->only(['show','edit','update']);
Route::resource('users.comments', UserCommentController::class)->only('store');

Route::resource('posts.likes',PostLikeController::class)->only(['store','destroy']);
Route::resource('comments.likes', CommentLikeController::class)->only(['store', 'destroy']);
Route::resource('users.likes', UserLikeController::class)->only(['store', 'destroy']);


//email format preview
Route::get('mail',function(){

    $comment=App\Models\Comment::find(39);
   return new App\Mail\CommentedPostMarkDown($comment);

})->name('mail');


Auth::routes();
