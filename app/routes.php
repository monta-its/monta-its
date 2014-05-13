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
    $status = array(
        'TA' => 'MAJU SIDANG',
        'Prodi' => 'REKAYASA PERANGKAT LUNAK',
    );

    $profil = array(
        'Nama' => 'Michael Schumacher',
        'NRP' => '5111100000',
        'TopikTA' => 'Simulasi',
        'JudulTA' => 'Aplikasi Simulasi Pembalap F1',
        'DeskripsiTA' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in',
        'Pembimbing' => 'Kimi Räikkönen',
        'Penguji' => 'Fernando Alonso',
        'Mulai' => '1 Januari 2013',
        'Selesai' => '2 Januari 2013',

    );

    View::share('status', $status);
    View::share('profil', $profil);
    return View::make('pages.dasbor.index');
});
// /dasbor/akun
Route::get('/dasbor/akun', function()
{
    return View::make('pages.dasbor.akun');
});
// /dasbor/pembimbing
Route::get('/dasbor/pembimbing', function()
{
    $statusPembimbing = 'Michael Schumacher';
    View::share('statusPembimbing', $statusPembimbing);
    $daftarProdi = array(
        array('kode' => '0928019824', 'nama' => 'RPL'),
        array('kode' => '0928019824', 'nama' => 'KCV'),
        array('kode' => '0928019824', 'nama' => 'NCC')
    );
    View::share('daftarProdi', $daftarProdi);
    $daftarPembimbing = array(
        array('NIP' => '0928019824', 'nama' => 'Michael Schumacher'),
        array('NIP' => '0928019824', 'nama' => 'Kimi Schumacher'),
        array('NIP' => '0928019824', 'nama' => 'Raphael Schumacher')
    );
    View::share('daftarPembimbing', $daftarPembimbing);
    return View::make('pages.dasbor.pembimbing');
});
// /dasbor/penguji
Route::get('/dasbor/penguji', function()
{
    $statusPenguji = 'Michael Schumacher';
    View::share('statusPenguji', $statusPenguji);
    $daftarProdi = array(
        array('kode' => '0928019824', 'nama' => 'RPL'),
        array('kode' => '0928019824', 'nama' => 'KCV'),
        array('kode' => '0928019824', 'nama' => 'NCC')
    );
    View::share('daftarProdi', $daftarProdi);
    $daftarPenguji = array(
        array('NIP' => '0928019824', 'nama' => 'Michael Raikkonen'),
        array('NIP' => '0928019824', 'nama' => 'Kimi Raikkonen'),
        array('NIP' => '0928019824', 'nama' => 'Raphael Raikkonen')
    );
    View::share('daftarPenguji', $daftarPenguji);
    return View::make('pages.dasbor.penguji');
});
// /dasbor/proposal
Route::get('/dasbor/proposal', function()
{
    $proposal = array(
        'nama' => 'Proposal_TA_511110000000.pdf', 
        'format' => 'PDF',
        'ukuran' => 45.5
    );
    View::share('proposal', $proposal);
    return View::make('pages.dasbor.proposal');
});
// /dasbor/prodi
Route::get('/dasbor/prodi', function()
{
    return View::make('pages.dasbor.pembimbing');
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
        'id_berita' => 'id_berita', 
        'cuplikan_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id_dosen',
        'nama_kategori' => 'Nama Kategori',
        'id_kategori' => 'id_kategori'
    );

    $l_item = array();
    array_push($l_item, $item);
    
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.berita.index');
});

// /berita/[id_berita]
Route::get('/berita/{id_berita}', function($id_berita)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Berita')
    );

    $item = array(
        'judul_berita' => 'Judul Berita', 
        'id_berita' => 'id_berita', 
        'isi_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id_dosen',
        'nama_kategori' => 'Nama Kategori',
        'id_kategori' => 'id_kategori'
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.berita.item');
});

// /berita/kategori/[id_kategori]
Route::get('/berita/kategori/{id_kategori}', function($id_kategori)
{
    return "berita/kategori/id_kategori";
});

// /dasbor/berita
// /dasbor/berita/baru
// /dasbor/berita/sunting/[id_berita]
// /dasbor/berita/hapus/[id_berita]
// /panduan
Route::get('/panduan', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Panduan')
    );

    $item = array(
        'judul_panduan' => 'Judul Panduan', 
        'id_panduan' => 'id_panduan', 
        'cuplikan_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id_dosen',
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

// /panduan/[id_panduan]
Route::get('/panduan/{id_panduan}', function($id_panduan)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('panduan'), 'text' => 'Panduan'),
        array('link' => '', 'text' => 'Judul Panduan'),
    );

    $item = array(
        'judul_panduan' => 'Judul Panduan', 
        'id_panduan' => 'id_panduan', 
        'isi_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'waktu' => '11 Januari 2014 13:00AM', 
        'nama_dosen' => 'Nama Penulis',
        'id_dosen' => 'id_dosen',
        'tautan_lampiran' => 'tautan/ke/berkas.ext',
        'nama_lampiran' => 'Nama File.ext'
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.panduan.item');
});

// /dasbor/panduan
// /dasbor/panduan/baru
// /dasbor/panduan/sunting/[id_panduan]
// /dasbor/panduan/hapus/[id_panduan]

// /bidang_ahli
Route::get('/bidang_ahli', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Bidang Ahli')
    );

    $item = array(
        'judul_bidang_ahli' => 'Judul Bidang Ahli', 
        'id_bidang_ahli' => 'id_bidang_ahli', 
        'cuplikan_bidang_ahli' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'id_bidang_ahli' => 'id_bidang_ahli',
        'nama_bidang_ahli' => 'Nama Bidang Ahli',
        'label_prodi' => 'Laboratorium', 
        'status_terambil' => true, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'penulis' => array(
            'id_dosen' => 'id_dosen',
            'nama_dosen' => 'Nama Dosen'
        )
    );

    $l_item = array();
    array_push($l_item, $item);
    $item['status_terambil'] = false;
    $item['nama_prodi'] = 'RPL';
    array_push($l_item, $item);

    View::share('breadcrumbs', $breadcrumbs);
    View::share('l_item', $l_item);
    return View::make('pages.bidang_ahli.index');
});

// /bidang_ahli/[id_bidang_ahli]
Route::get('/bidang_ahli/{id_bidang_ahli}', function($id_bidang_ahli)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/bidang_ahli'), 'text' => 'Bidang Ahli'),
        array('link' => '', 'text' => 'Judul Bidang Ahli')
    );
    $item = array(
        'judul_bidang_ahli' => 'Judul Bidang Ahli', 
        'id_bidang_ahli' => 'id_bidang_ahli', 
        'isi_bidang_ahli' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'label_prodi' => 'Laboratorium', 
        'id_bidang_ahli' => 'id_bidang_ahli',
        'nama_bidang_ahli' => 'Nama Bidang Ahli',
        'status_terambil' => false, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'penulis' => array(
            'id_dosen' => 'id_dosen',
            'nama_dosen' => 'Nama Dosen'
        ),
        'topik_bidang_ahli' => array(
            array(
                'judul_topik'=> 'Judul Topik',
                'id_topik'=> 'id_topik',
                'mahasiswa_topik'=> array(
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    )
                )
            ),
            array(
                'judul_topik'=> 'Judul Topik',
                'id_topik'=> 'id_topik',
                'mahasiswa_topik'=> array(
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    )
                )
            ),
            array(
                'judul_topik'=> 'Judul Topik',
                'id_topik'=> 'id_topik',
                'mahasiswa_topik'=> array(
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    )
                )
            ),
            array(
                'judul_topik'=> 'Judul Topik',
                'id_topik'=> 'id_topik',
                'mahasiswa_topik'=> array(
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    ),
                    array(
                        'nama_mahasiswa' => 'Nama Mahasiswa',
                        'nrp_mahasiswa' => '1234567890',
                        'id_mahasiswa' => '0987654321',
                    )
                )
            )
        )
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.bidang_ahli.item');
});

// /bidang_ahli/prodi/[id_prodi]
Route::get('/bidang_ahli/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat berbagai bidang ahli dengan filter prodi tertentu';
});

// /dasbor/bidang_ahli
// /dasbor/bidang_ahli/baru
// /dasbor/bidang_ahli/sunting/[id_bidang_ahli]
// /dasbor/bidang_ahli/hapus/[id_bidang_ahli]

// /topik
Route::get('/topik', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Topik TA')
    );

    $item = array(
        'judul_topik' => 'Judul Topik TA', 
        'id_topik' => 'id_topik', 
        'cuplikan_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'id_bidang_ahli' => 'id_bidang_ahli',
        'nama_bidang_ahli' => 'Nama Bidang Ahli',
        'label_prodi' => 'Laboratorium', 
        'status_terambil' => true, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'penulis' => array(
            'id_dosen' => 'id_dosen',
            'nama_dosen' => 'Nama Dosen'
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

// /topik/[id_topik]
Route::get('/topik/{id_topik}', function($id_topik)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/topik'), 'text' => 'Topik TA'),
        array('link' => '', 'text' => 'Judul Topik TA')
    );
    $item = array(
        'judul_topik' => 'Judul Topik TA', 
        'id_topik' => 'id_topik', 
        'isi_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'label_prodi' => 'Laboratorium', 
        'id_bidang_ahli' => 'id_bidang_ahli',
        'nama_bidang_ahli' => 'Nama Bidang Ahli',
        'status_terambil' => false, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'penulis' => array(
            'id_dosen' => 'id_dosen',
            'nama_dosen' => 'Nama Dosen'
        ),
        'mahasiswa_judul' => array(
            array(
                'judul_judul' => 'Judul Judul TA',
                'id_judul' => 'id_judul',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'nrp_mahasiswa' => '1234567890',
                'id_mahasiswa' => '0987654321'
            ),
            array(
                'judul_judul' => 'Judul Judul TA',
                'id_judul' => 'id_judul',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'nrp_mahasiswa' => '1234567890',
                'id_mahasiswa' => '0987654321'
            ),
            array(
                'judul_judul' => 'Judul Judul TA',
                'id_judul' => 'id_judul',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'nrp_mahasiswa' => '1234567890',
                'id_mahasiswa' => '0987654321'
            )
        )
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.topik.item');
});

// /topik/[id_topik]/ambil
Route::get('/topik/{id_topik}/ambil', function($id_topik)
{
    return 'Semacam topik TA sudah terambil dan Redirect ke profil mahasiswa';
});

// /topik/[id_topik]/lepas
Route::get('/topik/{id_topik}/lepas', function($id_topik)
{
    return 'Semacam topik TA yang sudah terambil sekarang dilepaskan dan Redirect ke profil mahasiswa';
});

// /topik/prodi/[id_prodi]
Route::get('/topik/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat topik-topik yang dengan filter prodi tertentu';
});

// /topik/bidang_ahli/[id_bidang_ahli]
Route::get('/topik/bidang_ahli/{id_bidang_ahli}', function($id_bidang_ahli)
{
    return 'Halaman memuat topik-topik yang dengan filter bidang ahli tertentu';
});

// /dasbor/topik
// /dasbor/topik/baru
// /dasbor/topik/sunting/[id_topik]
// /dasbor/topik/hapus/[id_topik]

// /judul
Route::get('/judul', function()
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => '', 'text' => 'Judul TA')
    );

    $item = array(
        'judul_judul' => 'Judul Judul TA', 
        'id_judul' => 'id_judul', 
        'cuplikan_judul' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'id_topik' => 'id_topik',
        'nama_topik' => 'Nama Topik',
        'label_prodi' => 'Laboratorium', 
        'status_terambil' => true, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'pembimbing' => array(
            array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            array(
                'id_dosen' => 'id_dosen',
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
    return View::make('pages.judul.index');
});

// /judul/[id_judul]
Route::get('/judul/{id_judul}', function($id_judul)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/judul'), 'text' => 'Judul TA'),
        array('link' => '', 'text' => 'Judul Judul TA')
    );
    $item = array(
        'judul_judul' => 'Judul Judul TA', 
        'id_judul' => 'id_judul', 
        'isi_judul' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'nama_prodi' => 'NCC', 
        'id_prodi' => 'id_prodi', 
        'label_prodi' => 'Laboratorium', 
        'id_topik' => 'id_topik',
        'nama_topik' => 'Nama Topik',
        'status_terambil' => false, 
        'waktu_mulai' => '10 Januari 2013', 
        'waktu_akhir' => '30 Desember 2014', 
        'pembimbing' => array(
            array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen'
            )
        )
    );

    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.judul.item');
});

// /judul/[id_judul]/ambil
Route::get('/judul/{id_judul}/ambil', function($id_judul)
{
    return 'Semacam Judul TA sudah terambil dan Redirect ke profil mahasiswa';
});

// /judul/[id_judul]/lepas
Route::get('/judul/{id_judul}/lepas', function($id_judul)
{
    return 'Semacam Judul TA yang sudah terambil sekarang dilepaskan dan Redirect ke profil mahasiswa';
});

// /judul/prodi/[id_prodi]
Route::get('/judul/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat judul-judul yang dengan filter prodi tertentu';
});

// /judul/bidang_ahli/[id_bidang_ahli]
Route::get('/judul/bidang_ahli/{id_bidang_ahli}', function($id_bidang_ahli)
{
    return 'Halaman memuat judul-judul yang dengan filter bidang ahli tertentu';
});

// /judul/topik/[id_topik]
Route::get('/judul/topik/{id_topik}', function($id_topik)
{
    return 'Halaman memuat judul-judul yang dengan filter topik tertentu';
});

// /dasbor/judul
// /dasbor/judul/baru
// /dasbor/judul/sunting/[id_judul]
// /dasbor/judul/hapus/[id_judul]

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
// /dasbor/sidang/sunting/[id_sidang]
// /dasbor/sidang/hapus/[id_sidang]
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
        'id_prodi' => 'id_prodi', 
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

// /prodi/id_prodi
Route::get('/prodi/{id_prodi}', function($id_prodi)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/prodi'), 'text' => 'Prodi'),
        array('link' => '', 'text' => 'Nama Program Studi (NPS)'),
    );

    $item = array(
        'nama_prodi' => 'Nama Program Studi', 
        'id_prodi' => 'id_prodi', 
        'deskripsi_prodi' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.', 
        'singkatan_prodi' => 'NPS', 
        'label_prodi' => 'KBK', 
        'dosen_prodi' => array(
            array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen',
                'bidang_ahli' => array(
                    array(
                        'id_bidang_ahli' => 'id_bidang_ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    ),
                    array(
                        'id_bidang_ahli' => 'id_bidang_ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    )
                )
            ),
            array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen',
                'bidang_ahli' => array(
                    array(
                        'id_bidang_ahli' => 'id_bidang_ahli',
                        'nama_bidang_ahli' => 'Nama Bidang Ahli'    
                    ),
                    array(
                        'id_bidang_ahli' => 'id_bidang_ahli',
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
// /dasbor/prodi/sunting/[id_prodi]
// /dasbor/prodi/hapus/[id_prodi]
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

// /dosen/id_dosen
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

// /dasbor/dosen/sunting/[id_dosen]
// /dasbor/dosen/hapus/[id_dosen]
// /mahasiswa
// /mahasiswa/nrp/[nrp_mahasiswa]
Route::get('/mahasiswa/nrp/{nrp_mahasiswa}', function($nrp_mahasiswa)
{
    $breadcrumbs = array(
        array('link' => URL::to('/'), 'text' => 'Beranda'),
        array('link' => URL::to('/mahasiswa'), 'text' => 'Mahasiswa'),
        array('link' => '', 'text' => 'Profil')
    );

    $item = array(
        'nama_mahasiswa' => 'Nama Mahasiswa',
        'nrp_mahasiswa' => '1234567890',
        'id_mahasiswa' => '0987654321',
        'nama_dosen' => 'Nama Dosen Pembimbing',
        'id_dosen' => 'id_dosen',
        'judul_topik' => 'Judul Topik TA',
        'id_topik' => 'id_topik',
        'judul_judul' => 'Judul Judul TA',
        'id_judul' => 'id_judul'
    );
    View::share('breadcrumbs', $breadcrumbs);
    View::share('item', $item);
    return View::make('pages.mahasiswa.item');
});
// /mahasiswa/id/[id_mahasiswa]
// /dasbor/mahasiswa/sunting/[id_mahasiswa]
// /dasbor/mahasiswa/hapus/[id_mahasiswa]
// /kategori/id_kategori
// /dasbor/kategori
// /dasbor/kategori/baru
// /dasbor/kategori/sunting/[id_kategori]
// /dasbor/kategori/hapus/[id_kategori]

// /dasbor/pengguna/mahasiswa
// /dasbor/pengguna/mahasiswa/tambah
Route::get('/dasbor/pengguna/mahasiswa/tambah', function()
{
    return View::make('pages.dasbor.pengguna.mahasiswa.tambah');
});
// /dasbor/pengguna/mahasiswa/tambah/[nrp]
Route::post('/dasbor/pengguna/mahasiswa/tambah', function()
{
    $nrp_mahasiswa = Input::get('nrp_mahasiswa');
    $nama_mahasiswa = '';
    if (!is_array($nrp_mahasiswa)) 
    {
        $nama_mahasiswa = Input::get('nama_mahasiswa');
        View::share('pesan', $nama_mahasiswa . ' (' . $nrp_mahasiswa . ')');
    }
    else 
    {
        View::share('pesan', count($nrp_mahasiswa) . ' mahasiswa');
    }
    
    
    return View::make('pages.dasbor.pengguna.mahasiswa.tambah_sukses');
});
// /dasbor/pengguna/mahasiswa/calon
Route::get('/dasbor/pengguna/mahasiswa/calon', function()
{
    $l_item = array(
        array(
            'nrp_mahasiswa' => '1234567890',
            'nama_mahasiswa' => 'Nama Calon Mahasiswa',
            'sks_lulus' => 'xx',
            'sks_tempuh' => 'yy'
        ),
        array(
            'nrp_mahasiswa' => '1234567890',
            'nama_mahasiswa' => 'Nama Calon Mahasiswa',
            'sks_lulus' => 'xx',
            'sks_tempuh' => 'yy'
        ),
        array(
            'nrp_mahasiswa' => '1234567890',
            'nama_mahasiswa' => 'Nama Calon Mahasiswa',
            'sks_lulus' => 'xx',
            'sks_tempuh' => 'yy'
        )
    );
    View::share('l_item', $l_item);
    return View::make('pages.dasbor.pengguna.mahasiswa.calon');
});
// /dasbor/pengguna/mahasiswa/cari
Route::post('/dasbor/pengguna/mahasiswa/cari', function()
{
    $item = array(
        'nama_mahasiswa' => 'Nama Mahasiswa',
        'nrp_mahasiswa' => '1234567890',
        'id_mahasiswa' => '0987654321',
        'nama_dosen_wali' => 'Nama Dosen Wali',
        'id_dosen_wali' => 'id_dosen',
        'sks_lulus' => '82',
        'sks_tempuh' => '100'
    );
    View::share('item', $item);
    return View::make('pages.dasbor.pengguna.mahasiswa.cari');
});
// /dasbor/pengguna/mahasiswa/aktifkan/{id_mahasiswa}
// /dasbor/pengguna/mahasiswa/nonaktifkan/{id_mahasiswa}
// /dasbor/pengguna/mahasiswa/hapus/{id_mahasiswa}
// /dasbor/pengguna/mahasiswa/sunting/{id_mahasiswa}
// /dasbor/pengguna/mahasiswa/aktifkan/nrp/{nrp_mahasiswa}
// /dasbor/pengguna/mahasiswa/nonaktifkan/nrp/{nrp_mahasiswa}
// /dasbor/pengguna/mahasiswa/hapus/nrp/{nrp_mahasiswa}
// /dasbor/pengguna/mahasiswa/sunting/nrp/{nrp_mahasiswa}
// /dasbor/pengguna/dosen/tambah
// /dasbor/pengguna/dosen/aktifkan/{id_dosen}
// /dasbor/pengguna/dosen/nonaktifkan/{id_dosen}
// /dasbor/pengguna/dosen/hapus/{id_dosen}
// /dasbor/pengguna/dosen/sunting/{id_dosen}
// /dasbor/pengguna/dosen/aktifkan/nip/{nip_dosen}
// /dasbor/pengguna/dosen/nonaktifkan/nip/{nip_dosen}
// /dasbor/pengguna/dosen/hapus/nip/{nip_dosen}
// /dasbor/pengguna/dosen/sunting/nip/{nip_dosen}
// /dasbor/pengguna/petugas/aktifkan/{id_petugas}
// /dasbor/pengguna/petugas/nonaktifkan/{id_petugas}
// /dasbor/pengguna/petugas/hapus/{id_petugas}
// /dasbor/pengguna/petugas/sunting/{id_petugas}
// /dasbor/pengguna/petugas/nip/{nip_petugas}
// /dasbor/pengguna/petugas/nip/{nip_petugas}
// /dasbor/pengguna/petugas/nip/{nip_petugas}
// /dasbor/pengguna/petugas/nip/{nip_petugas}
// /dasbor/pengguna/admin/tambah
// /dasbor/pengguna/admin/hapus/{id_admin}
// /dasbor/pengguna/admin/sunting/{id_admin}
// /dasbor/pengguna/admin/aktifkan/{id_admin}
// /dasbor/pengguna/admin/nonaktifkan/{id_admin}