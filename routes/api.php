<?php

use App\Http\Controllers\API\Magazine\BannerController;
use App\Http\Controllers\API\Magazine\CategoryController;
use App\Http\Controllers\API\Magazine\FaqController;
use App\Http\Controllers\API\Magazine\FaqItemController;
use App\Http\Controllers\API\Magazine\PageController;
use App\Http\Controllers\API\Magazine\PostCommentController;
use App\Http\Controllers\API\Magazine\PostController;
use App\Http\Controllers\API\Magazine\SettingController;
use App\Http\Controllers\API\Magazine\SliderController;
use App\Http\Controllers\API\Magazine\TagController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
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

Route::post('register' , [RegisterController::class , 'register']);
Route::post('login' , [RegisterController::class , 'Login']);

Route::middleware('auth:api')->group( function (){
   Route::resource('products' , ProductController::class);
   Route::resource('tags', TagController::class);
   Route::resource('sliders', SliderController::class);
   Route::resource('setting', SettingController::class);
   Route::resource('pages', PageController::class);
   Route::resource('categories' , CategoryController::class);
   Route::resource('posts', PostController::class);
   Route::resource('faqs', FaqController::class);
   Route::resource('faqsitems', FaqItemController::class);
   Route::resource('banners', BannerController::class );

   Route::controller(PostCommentController::class)->group(function () {
        Route::get('comments', 'index');
        Route::post('comments',  'store');
        Route::put('comments/{comment}','update');
       Route::get('comments/{comment}', 'show');
       Route::delete('comments/{comment}','destroy');
       Route::post('comments/{comment}/like','like');
       Route::post('comments/{comment}/dislike','dislike');
    });
});

