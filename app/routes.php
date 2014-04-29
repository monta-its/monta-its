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

Kemungkinan rute yang akan dibuat:

/berita
/berita/[id-berita]
/dasbor/berita
/dasbor/berita/baru
/dasbor/berita/sunting/[id-berita]
/dasbor/berita/hapus/[id-berita]
/panduan
/panduan/[id-panduan]
/dasbor/panduan
/dasbor/panduan/baru
/dasbor/panduan/sunting/[id-panduan]
/dasbor/panduan/hapus/[id-panduan]
/topik
/dasbor/topik
/dasbor/topik/baru
/dasbor/topik/sunting/[id-topik]
/dasbor/topik/hapus/[id-topik]
/sidang
/dasbor/sidang
/dasbor/sidang/baru
/dasbor/sidang/sunting/[id-sidang]
/dasbor/sidang/hapus/[id-sidang]
/statistik
/prodi
/prodi/id-prodi
/dasbor/prodi/baru
/dasbor/prodi/sunting/[id-prodi]
/dasbor/prodi/hapus/[id-prodi]
/dosen
/dosen/id-dosen
/dasbor/dosen/sunting/[id-dosen]
/dasbor/dosen/hapus/[id-dosen]
/kategori/id-kategori
/dasbor/kategori
/dasbor/kategori/baru
/dasbor/kategori/sunting/[id-kategori]
/dasbor/kategori/hapus/[id-kategori]
*/

Route::get('/berita/kategori/{id_kategori}', function($id_kategori)
{
    return "berita/kategori/id-kategori";
});
Route::get('/berita/{id_berita}', function($id_berita)
{
    return "berita/id_berita";
});
Route::get('/topik', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Topik TA')
    );

    $item = array(
        'judul_topik' => 'Judul Topik TA', 
        'id_topik' => 'id-topik', 
        'cuplikan_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id-prodi', 
        'label_prodi' => 'KBK', 
        'status_terambil' => true, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'pembimbing' => array(
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            )
        )
    );

    $l_item = array();
    array_push($l_item, $item);
    $item['status_terambil'] = false;
    $item['nama_prodi'] = 'RPL';
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.topik.index');
});
Route::get('/topik/{id_topik}', function($id_topik)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/topik'), 'text' => 'Topik TA'),
        array('link' => '', 'text' => 'Judul Topik TA')
    );
    $item = array(
        'judul_topik' => 'Judul Topik TA', 
        'id_topik' => 'id-topik', 
        'isi_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id-prodi', 
        'label_prodi' => 'KBK', 
        'status_terambil' => false, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'pembimbing' => array(
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            )
        )
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.topik.item');
});
Route::get('/topik/{id_topik}/ambil', function($id_topik)
{
    return 'Semacam topik TA sudah terambil dan Redirect ke profil mahasiswa';
});
Route::get('/berita', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Berita')
    );

    $item = array(
        'judul_berita' => 'Judul Berita', 
        'id_berita' => 'id-berita', 
        'cuplikan_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id-dosen',
        'nama_kategori' => 'Nama Kategori',
        'id_kategori' => 'id-kategori'
    );

    $l_item = array();
    array_push($l_item, $item);
    
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.berita.index');
});

Route::get('/panduan', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Panduan')
    );

    $item = array(
        'judul_topik' => 'Judul Topik TA', 
        'id_topik' => 'id-topik', 
        'cuplikan_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id-prodi', 
        'label_prodi' => 'KBK', 
        'status_terambil' => true, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'pembimbing' => array(
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen'
            )
        )
    );

    $l_item = array();
    array_push($l_item, $item);
    $item['status_terambil'] = false;
    $item['nama_prodi'] = 'RPL';
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.panduan.index');
});

Route::get('/dosen/{id_dosen}', function($id_dosen)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/dosen'), 'text' => 'Dosen'),
        array('link' => '', 'text' => 'Profil')
    );
    View::share('breadcrumbs', $breadcrumbs);
    return View::make('pages.dosen.profil');
});

Route::get('/sidang/proposal', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Sidang Proposal')
    );
    View::share('breadcrumbs', $breadcrumbs);
    return View::make('pages.sidang.index');
});

Route::get('/sidang/ta', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Sidang TA')
    );
    View::share('breadcrumbs', $breadcrumbs);
    return View::make('pages.sidang.index');
});

Route::get('/', function()
{
    return Redirect::to('/berita');
});
Route::get('/', function()
{
    return Redirect::to('/berita');
});

Route::get('/dasbor', function()
{
    return View::make('pages.dasbor.index');
});