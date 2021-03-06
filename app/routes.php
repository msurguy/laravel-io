<?php

Route::get('/', 'HomeController@getIndex');

// authentication
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::get('signup', 'AuthController@getSignup');
Route::get('signup-confirm', 'AuthController@getSignupConfirm');
Route::post('signup-confirm', 'AuthController@postSignupConfirm');
Route::get('logout', 'AuthController@getLogout');
Route::get('oauth', 'AuthController@getOauth');

// user dashboard
Route::get('dashboard', ['before' => 'auth', 'uses' => 'DashboardController@getIndex']);
Route::get('dashboard/articles', ['before' => 'auth', 'uses' => 'ArticlesController@getDashboard']);

// user profile
Route::get('user/{userSlug}', ['before' => 'auth', 'uses' => 'UsersController@getProfile']);

// chat
Route::get('contributors', 'ContributorsController@getIndex');

// chat
Route::get('chat', 'ChatController@getIndex');

// pastes
Route::get('bin', 'PastesController@getCreate');

// articles
Route::get('articles', 'ArticlesController@getIndex');
Route::get('article/{slug}', ['before' => 'handle_slug', 'uses' => 'ArticlesController@getShow']);
Route::get('articles/compose', ['before' => 'auth', 'uses' => 'ArticlesController@getCompose']);
Route::post('articles/compose', ['before' => 'auth', 'uses' => 'ArticlesController@postCompose']);
Route::get('articles/edit/{article}', ['before' => 'auth', 'uses' => 'ArticlesController@getEdit']);
Route::post('articles/edit/{article}', ['before' => 'auth', 'uses' => 'ArticlesController@postEdit']);

// forum
Route::get('forum', 'ForumController@getIndex');
Route::get('forum/create-thread', ['before' => 'auth', 'uses' => 'ForumController@getCreateThread']);
Route::post('forum/create-thread', ['before' => 'auth', 'uses' => 'ForumController@postCreateThread']);
Route::get('forum/edit-thread/{threadId}', ['before' => 'auth', 'uses' => 'ForumController@getEditThread']);
Route::get('forum/{slug}', ['before' => 'handle_slug', 'uses' => 'ForumController@getThread']);
Route::post('forum/{slug}', ['before' => 'auth|handle_slug', 'uses' => 'ForumController@postThread']);

// admin
Route::group(['before' => 'auth', 'prefix' => 'admin'], function() {

    Route::get('/', function() {
        return Redirect::action('Admin\UsersController@getIndex');
    });

	// users
    Route::group(['before' => 'has_role:admin_users'], function() {
    	Route::get('users', 'Admin\UsersController@getIndex');
        Route::get('edit/{user}', 'Admin\UsersController@getEdit');
        Route::post('edit/{user}', 'Admin\UsersController@postEdit');
    });
});
