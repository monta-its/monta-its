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



// Kemungkinan rute yang akan dibuat:

// /
Route::get('/', function()
{
    return Redirect::to('/berita');
});

// /dasbor
Route::get('/dasbor', function()
{
    return View::make('pages.dasbor.index');
});
// /dasbor/akun
Route::get('/dasbor/akun', function()
{
    return View::make('pages.dasbor.akun');
});

// /berita
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

// /berita/[id-berita]
Route::get('/berita/{id_berita}', function($id_berita)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Berita')
    );

    $item = array(
        'judul_berita' => 'Judul Berita', 
        'id_berita' => 'id-berita', 
        'isi_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id-dosen',
        'nama_kategori' => 'Nama Kategori',
        'id_kategori' => 'id-kategori'
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.berita.item');
});

// /berita/kategori/[id-kategori]
Route::get('/berita/kategori/{id_kategori}', function($id_kategori)
{
    return "berita/kategori/id-kategori";
});

// /dasbor/berita
// /dasbor/berita/baru
// /dasbor/berita/sunting/[id-berita]
// /dasbor/berita/hapus/[id-berita]
// /panduan
Route::get('/panduan', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Panduan')
    );

    $item = array(
        'judul_panduan' => 'Judul Panduan', 
        'id_panduan' => 'id-panduan', 
        'cuplikan_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id-dosen',
        'tautan_lampiran' => 'tautan/ke/berkas.ext',
        'nama_lampiran' => 'Nama File.ext'
    );

    $l_item = array();
    array_push($l_item, $item);
    $item['tautan_lampiran'] = '';
    $item['nama_lampiran'] = '';
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.panduan.index');
});

// /panduan/[id-panduan]
Route::get('/panduan/{id_panduan}', function($id_panduan)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('panduan'), 'text' => 'Panduan'),
        array('link' => '', 'text' => 'Judul Panduan'),
    );

    $item = array(
        'judul_panduan' => 'Judul Panduan', 
        'id_panduan' => 'id-panduan', 
        'isi_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id-dosen',
        'tautan_lampiran' => 'tautan/ke/berkas.ext',
        'nama_lampiran' => 'Nama File.ext'
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.panduan.item');
});

// /dasbor/panduan
// /dasbor/panduan/baru
// /dasbor/panduan/sunting/[id-panduan]
// /dasbor/panduan/hapus/[id-panduan]
// /topik
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

// /topik/[id-topik]
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

// /topik/[id-topik]/ambil
Route::get('/topik/{id_topik}/ambil', function($id_topik)
{
    return 'Semacam topik TA sudah terambil dan Redirect ke profil mahasiswa';
});

// /topik/[id-topik]/lepas
Route::get('/topik/{id_topik}/lepas', function($id_topik)
{
    return 'Semacam topik TA yang sudah terambil sekarang dilepaskan dan Redirect ke profil mahasiswa';
});

// /topik/prodi/[id-prodi]
Route::get('/topik/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat topik-topik yang dengan filter prodi tertentu';
});

// /topik/bidang_ahli/[id-bidang-ahli]
Route::get('/topik/bidang-ahli/{id_bidang_ahli}', function($id_bidang_ahli)
{
    return 'Halaman memuat topik-topik yang dengan filter bidang ahli tertentu';
});

// /dasbor/topik
// /dasbor/topik/baru
// /dasbor/topik/sunting/[id-topik]
// /dasbor/topik/hapus/[id-topik]
// /sidang
// /sidang/proposal
Route::get('/sidang/proposal', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Sidang Proposal')
    );
    $l_item = array(
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        ),
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        ),
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        )
    );
    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.sidang.index');
});

// /sidang/ta
Route::get('/sidang/ta', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Sidang TA')
    );
    $l_item = array(
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        ),
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        ),
        array(
            'tanggal_sidang' => '15-10-2014 10:00AM',
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
            'ruang_sidang' => 'IF-201',
            'label_prodi' => 'Prodi',
            'nama_prodi' => 'Nama Prodi'
        )
    );
    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.sidang.index');
});

// /dasbor/sidang
// /dasbor/sidang/baru
// /dasbor/sidang/sunting/[id-sidang]
// /dasbor/sidang/hapus/[id-sidang]
// /statistik

// /prodi
Route::get('/prodi', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Prodi')
    );

    $item = array(
        'nama_prodi' => 'Nama Program Studi', 
        'id_prodi' => 'id-prodi', 
        'cuplikan_prodi' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'singkatan_prodi' => 'NPS', 
        'label_prodi' => 'KBK'
    );

    $l_item = array();
    array_push($l_item, $item);
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);

    return View::make('pages.prodi.index');
});

// /prodi/id-prodi
Route::get('/prodi/{id_prodi}', function($id_prodi)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/prodi'), 'text' => 'Prodi'),
        array('link' => '', 'text' => 'Nama Program Studi (NPS)'),
    );

    $item = array(
        'nama_prodi' => 'Nama Program Studi', 
        'id_prodi' => 'id-prodi', 
        'deskripsi_prodi' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'singkatan_prodi' => 'NPS', 
        'label_prodi' => 'KBK', 
        'dosen_prodi' => array(
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen',
                'bidang_ahli' => array(
                    array(
                        'id_bidang_ahli' => 'id-bidang-ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    ),
                    array(
                        'id_bidang_ahli' => 'id-bidang-ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    )
                )
            ),
            array(
                'id_dosen' => 'id-dosen',
                'nama_dosen' => 'Nama Dosen',
                'bidang_ahli' => array(
                    array(
                        'id_bidang_ahli' => 'id-bidang-ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    ),
                    array(
                        'id_bidang_ahli' => 'id-bidang-ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    )
                )
            )
        )
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);

    return View::make('pages.prodi.item');
});

// /dasbor/prodi/baru
// /dasbor/prodi/sunting/[id-prodi]
// /dasbor/prodi/hapus/[id-prodi]
// /dosen
Route::get('/dosen', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Dosen')
    );

    $l_item = array();
    // array_push($l_item, $item);
    // array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.dosen.index');
});

// /dosen/id-dosen
Route::get('/dosen/{id_dosen}', function($id_dosen)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/dosen'), 'text' => 'Dosen'),
        array('link' => '', 'text' => 'Profil')
    );
    View::share('breadcrumbs', $breadcrumbs);
    return View::make('pages.dosen.item');
});

// /dasbor/dosen/sunting/[id-dosen]
// /dasbor/dosen/hapus/[id-dosen]
// /kategori/id-kategori
// /dasbor/kategori
// /dasbor/kategori/baru
// /dasbor/kategori/sunting/[id-kategori]
// /dasbor/kategori/hapus/[id-kategori]
