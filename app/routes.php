<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
/berita
/berita/[id-pos]
/dasbor/berita
/dasbor/berita/baru
/dasbor/berita/sunting/[id-pos]
/dasbor/berita/hapus/[id-pos]
/topik
/dasbor/topik
/dasbor/topik/baru
/dasbor/topik/sunting/[id-pos]
/dasbor/topik/hapus/[id-pos]
/sidang
/dasbor/sidang
/dasbor/sidang/baru
/dasbor/sidang/sunting/[id-pos]
/dasbor/sidang/hapus/[id-pos]
/statistik

*/

Route::get('/', function()
{
    return View::make('kosong');
});
Route::get('/test', function()
{
    $breadcrumbs = array(
        array('link' => '#1', 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Berita')
        );

    return View::make('pages.berita.index')->with('breadcrumbs', $breadcrumbs);
});
Route::get('/test-dasbor', function()
{
    return View::make('pages.dasbor.index');
});
// Route::get('', function()
// {
//  return View::make('');
// });
