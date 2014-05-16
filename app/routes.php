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


/* Rute fix ke controller */

Route::get('/', function()
{
    return Redirect::to('/berita');
});

// DasborMainController
Route::get('/dasbor','Simta\Controllers\DasborMainController@tentukanDasborMana');

// LoginController
Route::get('/login', 'Simta\Controllers\LoginController@lihatLamanLogin');
Route::post('/login', 'Simta\Controllers\LoginController@lakukanProsesLogin');
Route::get('/logout', 'Simta\Controllers\LoginController@lakukanProsesLogout');

// BeritaController
Route::get('/berita', 'Simta\Controllers\BeritaController@lihatSemuaBerita');
Route::get('/berita/{id_berita}', 'Simta\Controllers\BeritaController@lihatIsiBerita');
Route::get('/dasbor/pegawai/berita', 'Simta\Controllers\BeritaController@dasborLihatDaftarBerita');
Route::get('/dasbor/pegawai/berita/baru', 'Simta\Controllers\BeritaController@dasborTambahkanBerita');
Route::post('/dasbor/pegawai/berita/baru', 'Simta\Controllers\BeritaController@dasborSimpanBeritaBaru');
Route::get('/dasbor/pegawai/berita/sunting/{id_berita}', 'Simta\Controllers\BeritaController@dasborSuntingBerita');
Route::post('/dasbor/pegawai/berita/sunting/{id_berita}', 'Simta\Controllers\BeritaController@dasborSimpanPerubahanBerita');
Route::get('/dasbor/pegawai/berita/hapus/{id_berita}', 'Simta\Controllers\BeritaController@dasborHapusBerita');

// MahasiswaController
Route::get('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasbor');
Route::get('/dasbor/mahasiswa/akun', 'Simta\Controllers\MahasiswaController@kelolaAkun');
Route::get('/dasbor/mahasiswa/pembimbing', 'Simta\Controllers\MahasiswaController@kelolaPembimbing');
Route::get('/dasbor/mahasiswa/penguji', 'Simta\Controllers\MahasiswaController@kelolaPenguji');
Route::get('/dasbor/mahasiswa/proposal', 'Simta\Controllers\MahasiswaController@kelolaProposal');

// MahasiswaController
// No you don't need this you jackass! -- wiramaswara
/*
Route::get('/mahasiswa/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@lihatProfilMahasiswa');
Route::get('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasborMahasiswa');
Route::get('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborTambahkanMahasiswa');
Route::post('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborSimpanMahasiswaBaru');
Route::get('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSuntingMahasiswa');
Route::post('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSimpanPerubahanMahasiswa');
Route::get('/dasbor/mahasiswa/hapus/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborHapusMahasiswa');
*/

// BidangMinatController
Route::get ('/prodi', 'Simta\Controllers\BidangMinatController@lihatSemuaBidangMinat');
Route::get ('/prodi/{id_prodi}', 'Simta\Controllers\BidangMinatController@lihatRincianBidangMinat');
Route::get ('/dasbor/pegawai/prodi', 'Simta\Controllers\BidangMinatController@dasborKelolaBidangMinat');
Route::get ('/dasbor/pegawai/prodi/baru', 'Simta\Controllers\BidangMinatController@dasborTambahkanBidangMinat');
Route::post('/dasbor/pegawai/prodi/baru', 'Simta\Controllers\BidangMinatController@dasborSimpanBidangMinatBaru');
Route::get ('/dasbor/pegawai/prodi/sunting/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborSuntingBidangMinat');
Route::post('/dasbor/pegawai/prodi/sunting/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborSimpanPerubahanBidangMinat');
Route::get ('/dasbor/pegawai/prodi/hapus/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborHapusBidangMinat');

// PanduanController
Route::get('/panduan', 'Simta\Controllers\PanduanController@lihatSemuaPanduan');
Route::get('/panduan/{id_panduan}', 'Simta\Controllers\PanduanController@lihatIsiPanduan');
Route::get('/dasbor/pegawai/panduan', 'Simta\Controllers\PanduanController@dasborLihatDaftarPanduan');
Route::get('/dasbor/pegawai/panduan/baru', 'Simta\Controllers\PanduanController@dasborTambahkanPanduan');
Route::post('/dasbor/pegawai/panduan/baru', 'Simta\Controllers\PanduanController@dasborSimpanPanduanBaru');
Route::get('/dasbor/pegawai/panduan/sunting/{id_panduan}', 'Simta\Controllers\PanduanController@dasborSuntingPanduan');
Route::post('/dasbor/pegawai/panduan/sunting/{id_panduan}', 'Simta\Controllers\PanduanController@dasborSimpanPerubahanPanduan');
Route::get('/dasbor/pegawai/panduan/hapus/{id_panduan}', 'Simta\Controllers\PanduanController@dasborHapusPanduan');

// BidangKeahlianController
Route::get('/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@lihatSemuaBidangKeahlian');
Route::get('/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@lihatIsiBidangKeahlian');
Route::get('/dasbor/pegawai/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborLihatDaftarBidangKeahlian');
Route::get('/dasbor/pegawai/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborTambahkanBidangKeahlian');
Route::post('/dasbor/pegawai/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborSimpanBidangKeahlianBaru');
Route::get('/dasbor/pegawai/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSuntingBidangKeahlian');
Route::post('/dasbor/pegawai/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSimpanPerubahanBidangKeahlian');
Route::get('/dasbor/pegawai/bidang_keahlian/hapus/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborHapusBidangKeahlian');

// prioritas rendah
Route::get('/bidang_keahlian/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat berbagai bidang ahli dengan filter prodi tertentu';
});

// TopikController
Route::get('/topik', 'Simta\Controllers\TopikController@lihatSemuaTopik');
Route::get('/topik/{id_topik}', 'Simta\Controllers\TopikController@lihatIsiTopik');
Route::get('/dasbor/pegawai/topik', 'Simta\Controllers\TopikController@dasborLihatDaftarTopik');
Route::get('/dasbor/pegawai/topik/baru', 'Simta\Controllers\TopikController@dasborTambahkanTopik');
Route::post('/dasbor/pegawai/topik/baru', 'Simta\Controllers\TopikController@dasborSimpanTopikBaru');
Route::get('/dasbor/pegawai/topik/sunting/{id_topik}', 'Simta\Controllers\TopikController@dasborSuntingTopik');
Route::post('/dasbor/pegawai/topik/sunting/{id_topik}', 'Simta\Controllers\TopikController@dasborSimpanPerubahanTopik');
Route::get('/dasbor/pegawai/topik/hapus/{id_topik}', 'Simta\Controllers\TopikController@dasborHapusTopik');

// TOLONG DIREVIEW CONTROLLER BERIKUT, APAKAH INTERAKSINYA DENGAN CRUD SEPLAIN INI?
// JudulController
Route::get('/judul', 'Simta\Controllers\JudulController@lihatSemuaJudul');
Route::get('/judul/{id_judul}', 'Simta\Controllers\JudulController@lihatIsiJudul');

Route::get('/dasbor/judul', 'Simta\Controllers\JudulController@dasborLihatDaftarJudul');
Route::get('/dasbor/judul/baru', 'Simta\Controllers\JudulController@dasborTambahkanJudul');
Route::post('/dasbor/judul/baru', 'Simta\Controllers\JudulController@dasborSimpanJudulBaru');
Route::get('/dasbor/judul/sunting/{id_judul}', 'Simta\Controllers\JudulController@dasborSuntingJudul');
Route::post('/dasbor/judul/sunting/{id_judul}', 'Simta\Controllers\JudulController@dasborSimpanPerubahanJudul');
Route::get('/dasbor/judul/hapus/{id_judul}', 'Simta\Controllers\JudulController@dasborHapusJudul');

// SidangController
Route::get('/sidang/proposal', 'Simta\Controllers\SidangController@lihatSidangProposal');
Route::get('/sidang/ta', 'Simta\Controllers\SidangController@lihatSidangTA');
Route::get('/dasbor/sidang', 'Simta\Controllers\SidangController@dasborKelolaSidang');
Route::get('/dasbor/sidang/baru', 'Simta\Controllers\SidangController@dasborTambahkanSidang');
Route::post('/dasbor/sidang/baru', 'Simta\Controllers\SidangController@dasborSimpanSidangBaru');
Route::get('/dasbor/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSuntingSidang');
Route::post('/dasbor/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSimpanPerubahanSidang');
Route::get('/dasbor/sidang/hapus/{id_sidang}', 'Simta\Controllers\SidangController@dasborHapusSidang');

// BATAS CONCERN CRUD PLAIN
// DosenController
/* You don't need this
Route::get('/dosen', 'Simta\Controllers\DosenController@lihatSemuaDosen');
Route::get('/dosen/{id_dosen}', 'Simta\Controllers\DosenController@lihatProfilDosen');
Route::get('/dasbor/dosen', 'Simta\Controllers\DosenController@dasborDosen');
Route::get('/dasbor/dosen/baru', 'Simta\Controllers\DosenController@dasborTambahkanDosen');
Route::post('/dasbor/dosen/baru', 'Simta\Controllers\DosenController@dasborSimpanDosenBaru');
Route::get('/dasbor/dosen/sunting/{id_dosen}', 'Simta\Controllers\DosenController@dasborSuntingDosen');
Route::post('/dasbor/dosen/sunting/{id_dosen}', 'Simta\Controllers\DosenController@dasborSimpanPerubahanDosen');
Route::get('/dasbor/dosen/hapus/{id_dosen}', 'Simta\Controllers\DosenController@dasborHapusDosen');
 */

/* Rute masih ngonsep/ngemokup */
// Kemungkinan rute yang akan dibuat:

Route::get('/topik/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat topik-topik yang dengan filter prodi tertentu';
});
Route::get('/topik/bidang_keahlian/{id_bidang_keahlian}', function($id_bidang_keahlian)
{
    return 'Halaman memuat topik-topik yang dengan filter bidang ahli tertentu';
});
Route::get('/topik/ambil/{id_topik}', function($id_topik)
{
    return 'Semacam topik TA sudah terambil dan Redirect ke profil mahasiswa';
});

// /topik/[id_topik]/lepas
Route::get('/topik/lepas/{id_topik}', function($id_topik)
{
    return 'Semacam topik TA yang sudah terambil sekarang dilepaskan dan Redirect ke profil mahasiswa';
});

// /judul/[id_judul]/ambil
Route::get('/judul/ambil/{id_judul}', function($id_judul)
{
    return 'Semacam Judul TA sudah terambil dan Redirect ke profil mahasiswa';
});

// /judul/[id_judul]/lepas
Route::get('/judul/lepas/{id_judul}', function($id_judul)
{
    return 'Semacam Judul TA yang sudah terambil sekarang dilepaskan dan Redirect ke profil mahasiswa';
});

// /judul/prodi/[id_prodi]
Route::get('/judul/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat judul-judul yang dengan filter prodi tertentu';
});

// /judul/bidang_keahlian/[id_bidang_keahlian]
Route::get('/judul/bidang_keahlian/{id_bidang_keahlian}', function($id_bidang_keahlian)
{
    return 'Halaman memuat judul-judul yang dengan filter bidang ahli tertentu';
});

// /judul/topik/[id_topik]
Route::get('/judul/topik/{id_topik}', function($id_topik)
{
    return 'Halaman memuat judul-judul yang dengan filter topik tertentu';
});

// /statistik


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

// /dasbor/sit_in
Route::get('/dasbor/sit_in', function()
{
    $item = array(

    );
    View::share('item', $item);
    return View::make('pages.dasbor.sit_in.index');
});
