<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categories','CategoryController');
Route::get('getList','CategoryController@get_categories');
Route::resource('budgets','BudgetController');
Route::resource('vacations','VacationController');
Route::resource('expenses','ExpenseController');
Route::resource('socials','SocialController');
Route::get('getMoney','SocialController@getMoney');

Route::get('overview','DataController@getData');
Route::get('graphData','DataController@graphData');
Route::get('dashboard','DataController@dashboard');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::get('test','DataController@getData');