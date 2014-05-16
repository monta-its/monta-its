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

Route::get ('/', function()
{
    return Redirect::to('/berita');
});

// DasborMainController
Route::get ('/dasbor','Simta\Controllers\DasborMainController@tentukanDasborMana');

// LoginController

Route::get ('/login', 'Simta\Controllers\LoginController@lihatLamanLogin');
Route::post('/login', 'Simta\Controllers\LoginController@lakukanProsesLogin');
Route::get ('/logout', 'Simta\Controllers\LoginController@lakukanProsesLogout');

// BeritaController
Route::get ('/berita', 'Simta\Controllers\BeritaController@lihatSemuaBerita');
Route::get ('/berita/{id_berita}', 'Simta\Controllers\BeritaController@lihatIsiBerita');
Route::get ('/dasbor/berita', 'Simta\Controllers\BeritaController@dasborLihatDaftarBerita');
Route::get ('/dasbor/berita/baru', 'Simta\Controllers\BeritaController@dasborTambahkanBerita');
Route::post('/dasbor/berita/baru', 'Simta\Controllers\BeritaController@dasborSimpanBeritaBaru');
Route::get ('/dasbor/berita/sunting/{id_berita}', 'Simta\Controllers\BeritaController@dasborSuntingBerita');
Route::post('/dasbor/berita/sunting/{id_berita}', 'Simta\Controllers\BeritaController@dasborSimpanPerubahanBerita');
Route::get ('/dasbor/berita/hapus/{id_berita}', 'Simta\Controllers\BeritaController@dasborHapusBerita');

// MahasiswaController
Route::get ('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasbor');
Route::get ('/dasbor/akun', 'Simta\Controllers\MahasiswaController@kelolaAkun');
Route::get ('/dasbor/pembimbing', 'Simta\Controllers\MahasiswaController@kelolaPembimbing');
Route::get ('/dasbor/penguji', 'Simta\Controllers\MahasiswaController@kelolaPenguji');
Route::get ('/dasbor/proposal', 'Simta\Controllers\MahasiswaController@kelolaProposal');
// MahasiswaController
Route::get ('/mahasiswa/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@lihatProfilMahasiswa');
Route::get ('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasborMahasiswa');
Route::get ('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborTambahkanMahasiswa');
Route::post('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborSimpanMahasiswaBaru');
Route::get ('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSuntingMahasiswa');
Route::post('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSimpanPerubahanMahasiswa');
Route::get ('/dasbor/mahasiswa/hapus/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborHapusMahasiswa');

// BidangMinatController
Route::get ('/prodi', 'Simta\Controllers\BidangMinatController@lihatSemuaBidangMinat');
Route::get ('/prodi/{id_prodi}', 'Simta\Controllers\BidangMinatController@lihatRincianBidangMinat');
Route::get ('/dasbor/prodi', 'Simta\Controllers\BidangMinatController@dasborKelolaBidangMinat');
Route::get ('/dasbor/prodi/baru', 'Simta\Controllers\BidangMinatController@dasborTambahkanBidangMinat');
Route::post('/dasbor/prodi/baru', 'Simta\Controllers\BidangMinatController@dasborSimpanBidangMinatBaru');
Route::get ('/dasbor/prodi/sunting/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborSuntingBidangMinat');
Route::post('/dasbor/prodi/sunting/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborSimpanPerubahanBidangMinat');
Route::get ('/dasbor/prodi/hapus/{id_prodi}', 'Simta\Controllers\BidangMinatController@dasborHapusBidangMinat');

// PanduanController
Route::get ('/panduan', 'Simta\Controllers\PanduanController@lihatSemuaPanduan');
Route::get ('/panduan/{id_panduan}', 'Simta\Controllers\PanduanController@lihatIsiPanduan');
Route::get ('/dasbor/panduan', 'Simta\Controllers\PanduanController@dasborLihatDaftarPanduan');
Route::get ('/dasbor/panduan/baru', 'Simta\Controllers\PanduanController@dasborTambahkanPanduan');
Route::post('/dasbor/panduan/baru', 'Simta\Controllers\PanduanController@dasborSimpanPanduanBaru');
Route::get ('/dasbor/panduan/sunting/{id_panduan}', 'Simta\Controllers\PanduanController@dasborSuntingPanduan');
Route::post('/dasbor/panduan/sunting/{id_panduan}', 'Simta\Controllers\PanduanController@dasborSimpanPerubahanPanduan');
Route::get ('/dasbor/panduan/hapus/{id_panduan}', 'Simta\Controllers\PanduanController@dasborHapusPanduan');

// BidangKeahlianController
Route::get ('/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@lihatSemuaBidangKeahlian');
Route::get ('/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@lihatIsiBidangKeahlian');
Route::get ('/dasbor/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborLihatDaftarBidangKeahlian');
Route::get ('/dasbor/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborTambahkanBidangKeahlian');
Route::post('/dasbor/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborSimpanBidangKeahlianBaru');
Route::get ('/dasbor/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSuntingBidangKeahlian');
Route::post('/dasbor/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSimpanPerubahanBidangKeahlian');
Route::get ('/dasbor/bidang_keahlian/hapus/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborHapusBidangKeahlian');
// prioritas rendah
Route::get ('/bidang_keahlian/prodi/{id_prodi}', function($id_prodi)
{
    return 'Halaman memuat berbagai bidang ahli dengan filter prodi tertentu';
});

// TopikController
Route::get ('/topik', 'Simta\Controllers\TopikController@lihatSemuaTopik');
Route::get ('/topik/{id_topik}', 'Simta\Controllers\TopikController@lihatIsiTopik');
Route::get ('/dasbor/topik', 'Simta\Controllers\TopikController@dasborLihatDaftarTopik');
Route::get ('/dasbor/topik/baru', 'Simta\Controllers\TopikController@dasborTambahkanTopik');
Route::post('/dasbor/topik/baru', 'Simta\Controllers\TopikController@dasborSimpanTopikBaru');
Route::get ('/dasbor/topik/sunting/{id_topik}', 'Simta\Controllers\TopikController@dasborSuntingTopik');
Route::post('/dasbor/topik/sunting/{id_topik}', 'Simta\Controllers\TopikController@dasborSimpanPerubahanTopik');
Route::get ('/dasbor/topik/hapus/{id_topik}', 'Simta\Controllers\TopikController@dasborHapusTopik');
Route::get ('/topik/prodi/{id_prodi}', 'Simta\Controllers\TopikController@lihatTopikDariBidangMinat');
Route::get ('/topik/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\TopikController@lihatTopikDariBidangKeahlian');
Route::get ('/topik/ambil/{id_topik}', 'Simta\Controllers\TopikController@ambilTopik');
Route::get ('/topik/batal', 'Simta\Controllers\TopikController@batalkanTopik');

// JudulController
Route::get ('/judul', 'Simta\Controllers\JudulController@lihatSemuaJudul');
Route::get ('/judul/{id_judul}', 'Simta\Controllers\JudulController@lihatIsiJudul');
Route::get ('/judul/ambil/{id_judul}', 'Simta\Controllers\JudulController@ambilJudul');
Route::get ('/judul/batal', 'Simta\Controllers\JudulController@batalkanJudul');
Route::get ('/judul/prodi/{id_prodi}', 'Simta\Controllers\JudulController@lihatJudulDariBidangMinat');
Route::get ('/judul/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\JudulController@lihatJudulDariBidangKeahlian');
Route::get ('/judul/topik/{id_topik}', 'Simta\Controllers\JudulController@lihatJudulDariTopik');
Route::get ('/dasbor/judul', 'Simta\Controllers\JudulController@dasborLihatDaftarJudul');
Route::get ('/dasbor/judul/baru', 'Simta\Controllers\JudulController@dasborTambahkanJudul');
Route::post('/dasbor/judul/baru', 'Simta\Controllers\JudulController@dasborSimpanJudulBaru');
Route::get ('/dasbor/judul/sunting/{id_judul}', 'Simta\Controllers\JudulController@dasborSuntingJudul');
Route::post('/dasbor/judul/sunting/{id_judul}', 'Simta\Controllers\JudulController@dasborSimpanPerubahanJudul');
Route::get ('/dasbor/judul/hapus/{id_judul}', 'Simta\Controllers\JudulController@dasborHapusJudul');

// SidangController
Route::get ('/sidang/proposal', 'Simta\Controllers\SidangController@lihatSidangProposal');
Route::get ('/sidang/ta', 'Simta\Controllers\SidangController@lihatSidangTA');
Route::get ('/dasbor/sidang', 'Simta\Controllers\SidangController@dasborKelolaSidang');
Route::get ('/dasbor/sidang/baru', 'Simta\Controllers\SidangController@dasborTambahkanSidang');
Route::post('/dasbor/sidang/baru', 'Simta\Controllers\SidangController@dasborSimpanSidangBaru');
Route::get ('/dasbor/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSuntingSidang');
Route::post('/dasbor/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSimpanPerubahanSidang');
Route::get ('/dasbor/sidang/hapus/{id_sidang}', 'Simta\Controllers\SidangController@dasborHapusSidang');

// DosenController
Route::get ('/dosen', 'Simta\Controllers\DosenController@lihatSemuaDosen');
Route::get ('/dosen/{id_dosen}', 'Simta\Controllers\DosenController@lihatProfilDosen');
Route::get ('/dasbor/dosen', 'Simta\Controllers\DosenController@dasborDosen');
Route::get ('/dasbor/dosen/baru', 'Simta\Controllers\DosenController@dasborTambahkanDosen');
Route::post('/dasbor/dosen/baru', 'Simta\Controllers\DosenController@dasborSimpanDosenBaru');
Route::get ('/dasbor/dosen/sunting/{id_dosen}', 'Simta\Controllers\DosenController@dasborSuntingDosen');
Route::post('/dasbor/dosen/sunting/{id_dosen}', 'Simta\Controllers\DosenController@dasborSimpanPerubahanDosen');
Route::get ('/dasbor/dosen/hapus/{id_dosen}', 'Simta\Controllers\DosenController@dasborHapusDosen');

/* Rute masih ngonsep/ngemokup */
// Kemungkinan rute yang akan dibuat:

// /statistik


// /kategori/id_kategori
// /dasbor/kategori
// /dasbor/kategori/baru
// /dasbor/kategori/sunting/[id_kategori]
// /dasbor/kategori/hapus/[id_kategori]

// /dasbor/pengguna/mahasiswa
// /dasbor/pengguna/mahasiswa/tambah
Route::get ('/dasbor/pengguna/mahasiswa/tambah', function()
{
    return View::make('pages.dasbor.pengguna.mahasiswa.tambah');
});
// /dasbor/pengguna/mahasiswa/tambah/[nrp]
Route::post('/dasbor/pengguna/mahasiswa/tambah', function()
{
    $nrp_mahasiswa = Input::get ('nrp_mahasiswa');
    $nama_mahasiswa = '';
    if (!is_array($nrp_mahasiswa))
    {
        $nama_mahasiswa = Input::get ('nama_mahasiswa');
        View::share('pesan', $nama_mahasiswa . ' (' . $nrp_mahasiswa . ')');
    }
    else
    {
        View::share('pesan', count($nrp_mahasiswa) . ' mahasiswa');
    }


    return View::make('pages.dasbor.pengguna.mahasiswa.tambah_sukses');
});
// /dasbor/pengguna/mahasiswa/calon
Route::get ('/dasbor/pengguna/mahasiswa/calon', function()
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

// /dasbor/sit_in
Route::get ('/dasbor/sit_in', function()
{
    $item = array(

    );
    View::share('item', $item);
    return View::make('pages.dasbor.sit_in.index');
});
