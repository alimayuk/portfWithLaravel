<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreateSettingsController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\StatController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class,'home'])->name('home');
Route::get('/categories', [FrontController::class,"pageCategory"])->name("page.category");
Route::get('/categories/{slug:categories}', [FrontController::class,"category"])->name("front.category");
Route::get('/blogs', [FrontController::class,"articles"])->name("front.blogPage");
Route::get('/about', [FrontController::class,"about"])->name("page.about");
Route::get('/contact', [FrontController::class,"contact"])->name("page.contact");
Route::get('categories/{categorySlug}/{articleSlug}', [FrontController::class,"articleDetail"])->name("front.articleDetail");
Route::get('/gallery', [FrontController::class,"gallery"])->name("front.gallery");

Route::prefix('admin')->middleware("auth")->group(function () {
    Route::get("/",[StatController::class,"viewStat"])->name("admin.index");
    Route::post('/',[StatController::class,'goalCreate'])->name('goal.create');
    Route::post('goal/delete',[StatController::class,"delete"])->name("goal.delete");


    Route::get("article",[ArticleController::class,"index"])->name("article.index");
    Route::post("article/change-status", [ArticleController::class, "changeStatus"])->name("article.changeStatus");
    Route::post("article/change-feature-status", [ArticleController::class, "changeFeatureStatus"])->name("article.changeFeatureStatus");
    Route::get("article/create",[ArticleController::class,"create"])->name("article.create");
    Route::post("article/create",[ArticleController::class,"store"]);
    Route::get("article/{id}/edit",[ArticleController::class,"edit"])->name("article.edit")
    ->whereNumber('id');
    Route::post("article/{id}/edit",[ArticleController::class,"update"])
    ->whereNumber('id');
    Route::post("article/{id}/edit",[ArticleController::class,"fastUpdate"])->name("article.edit")
    ->whereNumber('id');
    Route::post('article/delete',[ArticleController::class,"delete"])->name("article.delete");

    Route::get("categories",[CategoryController::class,"index"])->name("category.index");
    Route::post("categories/change-status",[CategoryController::class,"changeStatus"])->name("category.changeStatus");
    Route::get("categories/create",[CategoryController::class,"create"])->name("category.create");
    Route::post("categories/create",[CategoryController::class,"store"]);
    Route::get("categories/{id}/edit",[CategoryController::class,"edit"])->name("category.edit")
    ->whereNumber('id');
    Route::post("categories/{id}/edit",[CategoryController::class,"update"])->whereNumber('id');
    Route::post('categories/delete',[CategoryController::class,"delete"])->name("category.delete");

    Route::get("gallery/list",[GalleryController::class,"index"])->name("gallery.index");
    Route::get("gallery/create",[GalleryController::class,"create"])->name("gallery.create");
    Route::post('gallery/create',[GalleryController::class,"store"]);
    Route::get('gallery/{id}/edit',[GalleryController::class,"edit"])->name('gallery.edit')->whereNumber('id');
    Route::post('gallery/{id}/edit',[GalleryController::class,"update"])->whereNumber('id');
    Route::post('gallery/delete',[GalleryController::class,"delete"])->name("gallery.delete");


    Route::get("settings",[CreateSettingsController::class,"show"])->name("settings");
    Route::post("settings",[CreateSettingsController::class,"update"]);
});

Route::get("login",[LoginController::class,"showLogin"])->name("login");
Route::post("login",[LoginController::class,"login"]);
Route::post("logout",[LoginController::class,"logout"])->name('logout');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});