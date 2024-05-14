<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\BlogController;
use Modules\Blog\App\Http\Controllers\CategoriesController;
use Modules\Blog\App\Http\Controllers\CommentsController;
use Modules\Blog\App\Http\Controllers\PostCalculateController;
use Modules\Blog\App\Http\Controllers\PostsCommentController;
use Modules\Blog\App\Http\Controllers\PostsController;
use Modules\Blog\App\Http\Controllers\TagsController;

Route::group(['prefix' => 'panel/blog', 'as' => 'blog.'], function () {
    Route::resource('tags', TagsController::class)->except(['create']);
    Route::resource('categories', CategoriesController::class)->except(['create']);
    Route::resource('/posts', PostsController::class);
    Route::post('/posts/calculate', PostCalculateController::class)->name('post.text.calculate');
    Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
    Route::post('/comments/{comment}/{status}/change', [CommentsController::class, 'changeCommentStatus'])->name('comments.status.change');
});

Route::group(['prefix' => '/blog', 'as' => 'blog.'], function () {
    Route::post('/posts/{post}/comment/store', [PostsCommentController::class, 'store'])->name('post.comment.store');
    Route::post('/posts/{post}/{postComment}/reply/store', [PostsCommentController::class, 'storeCommentReply'])->name('post.comment.reply.store');
});

Route::group(['prefix' => '/blog'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{post}/show', [BlogController::class, 'show'])->name('blog.show');
});
