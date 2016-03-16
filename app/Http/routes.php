<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {


Route::bind('boardname', function ($slug) {

    return App\Board::where('boardname', $slug)->first();

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Build', 'BoardController@create');

Route::get('/about', function () {
    return view('about');
});

Route::get('board', 'BoardController@index');
Route::get('board/{boardname}', 'BoardController@show');


Route::patch('board/{boardname}', 'BoardController@update');

/*generate new board*/

Route::get('build', 'BoardController@create');

Route::get('board/{boardname}/authorize', ['as' => 'board.authorize', 'uses' => 'BoardController@getAuthorize']);

Route::post('board/{boardname}/authorize', ['as' => 'board.authorize.post', 'uses' => 'BoardController@postAuthorize']);

Route::post('board/access-via-pincode', ['as' => 'board.access-via-pincode', 'uses' => 'BoardController@accessViaPincode']);

Route::get('board/{boardname}/save', ['as' => 'board.save', 'uses' => 'BoardController@save']);

Route::post('build', 'BoardController@store');

/*Route delete board. Note: currently not working :(*/



/*Routes Home to Board. Note: Need to look at auth middleware to reroute to Board or redirect to previous page*/

Route::get('home', 'BoardController@index');

Route::get('/about', function () {
    return view('about');
});
Route::get('/enter', function () {
    return view('enter');
});

/*contact form*/
Route::get(
    'contact',
    ['as' => 'contact', 'uses' => 'AboutController@create']
);
Route::post(
    'contact',
    ['as' => 'contact_store', 'uses' => 'AboutController@store']
);
/*Refer your boss*/
Route::post('referboss', ['as' => 'referboss', 'uses' => 'ReferController@store']);

    // Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
    // Moderator routes.

    Route::group(['prefix' => 'moderator'], function ()  {
        Route::resource('boards', 'Moderator\BoardsController', ['only' => ['index', 'edit', 'update']]);

        Route::resource('boards.comments', 'Moderator\BoardsCommentsController');

        Route::resource('boards.bans', 'Moderator\BoardsBansController', ['only' => ['index', 'store', 'destroy']]);
    });


});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
