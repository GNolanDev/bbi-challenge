<?php

use App\Http\Controllers\APIController;
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

Route::get('/', [APIController::class, 'search']);
/* 
// old template code
function (Request $request) {
    return $request->user();
}); */

/* fallback option for any unrecognised api request types */
Route::fallback(function () {
    return response("", 404);
});
