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
Route::get ('/dasbor/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::post ('/dasbor/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::put ('/dasbor/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::delete ('/dasbor/berita', 'Simta\Controllers\BeritaController@dasborBerita');

// MahasiswaController
Route::get ('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasbor');
Route::get ('/dasbor/akun', 'Simta\Controllers\MahasiswaController@kelolaAkun');
Route::get ('/dasbor/pembimbing', 'Simta\Controllers\MahasiswaController@kelolaPembimbing');
Route::get ('/dasbor/penguji', 'Simta\Controllers\MahasiswaController@kelolaPenguji');
Route::get ('/dasbor/proposal', 'Simta\Controllers\MahasiswaController@kelolaProposal');
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
Route::get ('/dasbor/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::post ('/dasbor/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::put ('/dasbor/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::delete ('/dasbor/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');

// PanduanController
Route::get ('/panduan', 'Simta\Controllers\PanduanController@lihatSemuaPanduan');
Route::get ('/panduan/{id_panduan}', 'Simta\Controllers\PanduanController@lihatIsiPanduan');
Route::get ('/dasbor/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::post ('/dasbor/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::put ('/dasbor/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::delete ('/dasbor/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');

// BidangKeahlianController
Route::get ('/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@lihatSemuaBidangKeahlian');
Route::get ('/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@lihatIsiBidangKeahlian');
Route::get ('/bidang_keahlian/prodi/{id_prodi}', 'Simta\Controllers\BidangKeahlianController@lihatBidangKeahlianDariBidangMinat');
Route::get ('/dasbor/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborLihatDaftarBidangKeahlian');
Route::get ('/dasbor/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborTambahkanBidangKeahlian');
Route::post('/dasbor/bidang_keahlian/baru', 'Simta\Controllers\BidangKeahlianController@dasborSimpanBidangKeahlianBaru');
Route::get ('/dasbor/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSuntingBidangKeahlian');
Route::post('/dasbor/bidang_keahlian/sunting/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborSimpanPerubahanBidangKeahlian');
Route::get ('/dasbor/bidang_keahlian/hapus/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@dasborHapusBidangKeahlian');

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

// TOLONG DIREVIEW CONTROLLER BERIKUT, APAKAH INTERAKSINYA DENGAN CRUD SELAIN INI?
// ifan: gak ngerti aku maksud instruksimu apa.
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

// SitInController
Route::get ('/dasbor/sit_in', 'Simta\Controllers\SitInController@lihatLamanSitIn');

// PenggunaController
// /dasbor/pengguna/mahasiswa
// /dasbor/pengguna/mahasiswa/tambah
Route::get ('/dasbor/pengguna/mahasiswa/tambah', 'Simta\Controllers\PenggunaController@borangTambahPenggunaMahasiswa');
Route::post('/dasbor/pengguna/mahasiswa/tambah', 'Simta\Controllers\PenggunaController@tambahPenggunaMahasiswa');
Route::get ('/dasbor/pengguna/mahasiswa/calon', 'Simta\Controllers\PenggunaController@lihatSemuaCalonPenggunaMahasiswa');
Route::post('/dasbor/pengguna/mahasiswa/cari', 'Simta\Controllers\PenggunaController@lihatHasilPencarianCalonPenggunaMahasiswa');

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

// /statistik
