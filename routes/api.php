<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CareerController;
use App\Http\Controllers\Dashboard\CareerApplicationController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ContactMessageController;
use App\Http\Controllers\Website\MainController;
use App\Http\Controllers\API\AuthController;


// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {

//     Route::post('/logout', [AuthController::class, 'logout']);

//     Route::get('/me', [AuthController::class, 'me']);



// });
Route::group(['prefix' => 'dashboard'], function () {


        /***************************************** Users *******************************************/

            Route::apiResource('user', UserController::class);

        /***************************************** Pages *******************************************/

            Route::apiResource('page', PageController::class);

        /***************************************** Sections *******************************************/

            Route::apiResource('section', SectionController::class);

        /***************************************** Items *******************************************/

            Route::apiResource('item', ItemController::class);

        /***************************************** Blogs *******************************************/

            Route::apiResource('blog', BlogController::class);

        /***************************************** Careers *******************************************/

            Route::apiResource('career', CareerController::class);

        /***************************************** Career Applications *******************************************/

            Route::apiResource('career-application', CareerApplicationController::class);

        /***************************************** Settings *******************************************/

            Route::apiResource('setting', SettingController::class);

        /***************************************** Contact Messages *******************************************/

            Route::apiResource('contact-message', ContactMessageController::class);

    });



Route::group(['prefix' => 'website'], function () {


        /***************************************** Pages *******************************************/

            Route::GET('index', [MainController::class, 'ActivePages']);
            // Route::apiResource('pages', PageController::class);

        /***************************************** Blogs *******************************************/

            Route::GET('published-blogs', [MainController::class, 'PublishedBlogs']);

        /***************************************** Careers *******************************************/

            Route::GET('active-careers', [MainController::class, 'ActiveCareers']);

        /***************************************** Career Applications *******************************************/

            Route::POST('apply-job', [MainController::class, 'ApplyJobApplication']);

        /***************************************** Contact Messages *******************************************/

            Route::POST('contact-us', [MainController::class, 'ContactUs']);

});

// Route::prefix('pages')->group(function () {

//     Route::get('/', [PageController::class, 'index']);

//     Route::get('{slug}', [PageController::class, 'show']);

//     Route::post('/', [PageController::class, 'store']);
// });

// Route::prefix('sections')->group(function () {

//     Route::get('{pageId}', [SectionController::class, 'index']);

//     Route::post('/', [SectionController::class, 'store']);
// });

// Route::prefix('items')->group(function () {

//     Route::get('{sectionId}', [ItemController::class, 'index']);

//     Route::post('/', [ItemController::class, 'store']);
// });

// Route::prefix('blogs')->group(function () {

//     Route::get('/', [BlogController::class, 'index']);

//     Route::get('{slug}', [BlogController::class, 'show']);

//     Route::post('/', [BlogController::class, 'store']);
// });

// Route::prefix('careers')->group(function () {

//     Route::get('/', [CareerController::class, 'index']);

//     Route::post('/', [CareerController::class, 'store']);
// });

// Route::post(
//     'contact',
//     [ContactController::class, 'store']
// );

// Route::post(
//     'media/upload',
//     [MediaController::class, 'store']
// );
