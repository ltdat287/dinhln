<?php
use Illuminate\Support\Facades\Auth;
/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */

Route::get('/',         array('as' => 'home', 'uses' => 'MemberController@index'));
Route::get('login',    array('as' => 'login', 'uses' => 'Auth\AuthController@getLogin'));
Route::post('login',    array('as' => 'login', 'uses' => 'Auth\AuthController@postLogin'));

Route::post('add/test', array('as' => 'test', 'uses' => 'MemberController@testcode'));
Route::post('Ajax/memberexist', array('as' => 'ajax.memberexist', 'uses' => 'MemberController@ajaxmemberexist'));

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'manager'], function () {
        Route::get('add',       array('as' => 'add', 'uses' => 'MemberController@create'));
        Route::post('add/conf', array('as' => 'add_conf', 'uses' => 'MemberController@add_conf'));
        Route::post('add/comp', array('as' => 'add_comp', 'uses' => 'MemberController@store'));
        Route::get('search',    array('as' => 'search', 'uses' => 'MemberController@search'));
        
        Route::group(['middleware' => 'direct_access'], function () {
            Route::group(['middleware' => 'is_disabled'], function () {
                Route::get('member/{id}/delete/conf', array('as' => 'delete_conf', 'uses' => 'MemberController@delete_conf'));
                Route::group(['middleware' => 'check_delete'], function () {                    
                    Route::post('member/{id}/delete/comp', array('as' => 'delete_comp', 'uses' => 'MemberController@destroy'));
                });
            });
        });
    });
    Route::group(['middleware' => 'is_disabled'], function () {
        Route::get('member/{id}/detail',       array('as' => 'member_detail', 'uses' => 'MemberController@show'));
        Route::group(['middleware' => 'check_edit'], function () {
            Route::get('member/{id}/edit',         array('as' => 'edit', 'uses' => 'MemberController@edit'));
            Route::post('member/{id}/edit/conf',   array('as' => 'edit_conf', 'uses' => 'MemberController@edit_conf'));
            Route::post('member/{id}/edit/comp',   array('as' => 'edit_comp', 'uses' => 'MemberController@update'));
        });
    });
    Route::get('logout',    array('as' => 'logout', 'uses' => 'Auth\AuthController@getLogout'));
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);
