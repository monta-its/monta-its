<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});

/*
 * Simta own implementation of auth filter
 */



Route::filter('mahasiswaAuth', function()
{
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->peran != 0)
        {
            return Redirect::to('dasbor');
        }
    }
});


Route::filter('pegawaiAuth', function()
{
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->peran != 1 || $user->peran != 3)
        {
            return Redirect::to('dasbor');
        }
    }
});


Route::filter('dosenAuth', function()
{
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->peran != 2 || $user->peran != 3)
        {
            return Redirect::to('dasbor');
        }
    }
});

Route::when('dasbor', 'auth');
Route::when('dasbor/*', 'auth');
Route::when('dasbor/mahasiswa', 'mahasiswaAuth');
Route::when('dasbor/mahasiswa/*', 'mahasiswaAuth');
Route::when('dasbor/pegawai', 'pegawaiAuth');
Route::when('dasbor/pegawai/*', 'pegawaiAuth');
Route::when('dasbor/dosen', 'dosenAuth');
Route::when('dasbor/dosen/*', 'dosenAuth');

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
