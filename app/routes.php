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
Route::get ('/dasbor/dosen/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::post ('/dasbor/dosen/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::put ('/dasbor/dosen/berita', 'Simta\Controllers\BeritaController@dasborBerita');
Route::delete ('/dasbor/dosen/berita', 'Simta\Controllers\BeritaController@dasborBerita');

// MahasiswaController
Route::get ('/dasbor/mahasiswa', 'Simta\Controllers\MahasiswaController@dasborMahasiswa');
Route::get ('/dasbor/mahasiswa/akun', 'Simta\Controllers\MahasiswaController@kelolaAkun');
Route::get ('/dasbor/mahasiswa/pembimbing', 'Simta\Controllers\MahasiswaController@kelolaPembimbing');
Route::get ('/dasbor/mahasiswa/penguji', 'Simta\Controllers\MahasiswaController@kelolaPenguji');
Route::get ('/dasbor/mahasiswa/proposal', 'Simta\Controllers\MahasiswaController@kelolaProposal');
Route::get ('/mahasiswa/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@lihatProfilMahasiswa');

/* Hanya pegawai yang dapat menambahkan pengguna mahasiswa. Lihat PenggunaController.
    Mekanisme penghapusan akun dan data lampau mahasiswa belum direncanakan
Route::get ('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborTambahkanMahasiswa');
Route::post('/dasbor/mahasiswa/baru', 'Simta\Controllers\MahasiswaController@dasborSimpanMahasiswaBaru');
Route::get ('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSuntingMahasiswa');
Route::post('/dasbor/mahasiswa/sunting/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborSimpanPerubahanMahasiswa');
Route::get ('/dasbor/mahasiswa/hapus/{id_mahasiswa}', 'Simta\Controllers\MahasiswaController@dasborHapusMahasiswa');
*/

// BidangMinatController
Route::get ('/prodi', 'Simta\Controllers\BidangMinatController@lihatSemuaBidangMinat');
Route::get ('/prodi/{id_prodi}', 'Simta\Controllers\BidangMinatController@lihatRincianBidangMinat');
Route::get ('/dasbor/dosen/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::post ('/dasbor/dosen/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::put ('/dasbor/dosen/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');
Route::delete ('/dasbor/dosen/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');

// PanduanController
Route::get ('/panduan', 'Simta\Controllers\PanduanController@lihatSemuaPanduan');
Route::get ('/panduan/{id_panduan}', 'Simta\Controllers\PanduanController@lihatIsiPanduan');
Route::get ('/dasbor/dosen/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::post ('/dasbor/dosen/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::put ('/dasbor/dosen/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');
Route::delete ('/dasbor/dosen/panduan', 'Simta\Controllers\PanduanController@dasborPanduan');

// BidangKeahlianController
// TODO: Bro, BidangKeahlian unrelated sama BidangMinat dan TugasAkhir apapun,
// ini related sama dosen aja. Baca model lagi.
// Perukah yang ini dibuat view di halaman tamu? I don't think so
Route::get ('/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@lihatSemuaBidangKeahlian');
Route::get ('/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\BidangKeahlianController@lihatIsiBidangKeahlian');
Route::get ('/bidang_keahlian/prodi/{id_prodi}', 'Simta\Controllers\BidangKeahlianController@lihatBidangKeahlianDariBidangMinat');
Route::get ('/dasbor/dosen/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborBidangKeahlian');
Route::post ('/dasbor/dosen/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborBidangKeahlian');
Route::put ('/dasbor/dosen/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborBidangKeahlian');
Route::delete ('/dasbor/dosen/bidang_keahlian', 'Simta\Controllers\BidangKeahlianController@dasborBidangKeahlian');

// TopikController
Route::get ('/topik', 'Simta\Controllers\TopikController@lihatSemuaTopik');
Route::get ('/topik/{id_topik}', 'Simta\Controllers\TopikController@lihatIsiTopik');
Route::get ('/dasbor/dosen/topik', 'Simta\Controllers\TopikController@dasborTopik');
Route::post ('/dasbor/dosen/topik', 'Simta\Controllers\TopikController@dasborTopik');
Route::put ('/dasbor/dosen/topik', 'Simta\Controllers\TopikController@dasborTopik');
Route::delete ('/dasbor/dosen/topik', 'Simta\Controllers\TopikController@dasborTopik');

// TODO: Bro, tolong kasih tahu fungsi dari dua controller ini
Route::get ('/topik/ambil/{id_topik}', 'Simta\Controllers\TopikController@ambilTopik');
Route::get ('/topik/batal', 'Simta\Controllers\TopikController@batalkanTopik');

// TODO: Ini maksudmu JUDUL itu TugasAkhir ya?
// PLIS BRO, BACA MODELNYA LAGI, KALAU BUTUH DIAGRAM, TANYA AKU :(
// JudulController
Route::get ('/judul', 'Simta\Controllers\JudulController@lihatSemuaJudul');
Route::get ('/judul/{id_judul}', 'Simta\Controllers\JudulController@lihatIsiJudul');
Route::get ('/judul/ambil/{id_judul}', 'Simta\Controllers\JudulController@ambilJudul');
Route::get ('/judul/batal', 'Simta\Controllers\JudulController@batalkanJudul');
Route::get ('/judul/prodi/{id_prodi}', 'Simta\Controllers\JudulController@lihatJudulDariBidangMinat');
Route::get ('/judul/bidang_keahlian/{id_bidang_keahlian}', 'Simta\Controllers\JudulController@lihatJudulDariBidangKeahlian');
Route::get ('/judul/topik/{id_topik}', 'Simta\Controllers\JudulController@lihatJudulDariTopik');
Route::get ('/dasbor/dosen/judul', 'Simta\Controllers\JudulController@dasborJudul');
Route::post ('/dasbor/dosen/judul', 'Simta\Controllers\JudulController@dasborJudul');
Route::put ('/dasbor/dosen/judul', 'Simta\Controllers\JudulController@dasborJudul');
Route::delete ('/dasbor/dosen/judul', 'Simta\Controllers\JudulController@dasborJudul');

// SidangController
/**
 * Rute untuk SidangController.
 * Pegawai dan dosen berhak mengatur sidang.
 * Pegawai mengatur sidang untuk sidang terjadwal mahasiswa secara jamak.
 * Dosen mengatur jadwal untuk menentukan ketersediaannya. (Informasi lebih lengkap, pelajari lagi rekaman progress 1 bersama Bu Wiwik)
 */
Route::get ('/sidang/proposal', 'Simta\Controllers\SidangController@lihatSidangProposal');
Route::get ('/sidang/ta', 'Simta\Controllers\SidangController@lihatSidangTA');
Route::get ('/dasbor/pegawai/sidang', 'Simta\Controllers\SidangController@dasborKelolaSidang');
Route::get ('/dasbor/pegawai/sidang/baru', 'Simta\Controllers\SidangController@dasborTambahkanSidang');
Route::post('/dasbor/pegawai/sidang/baru', 'Simta\Controllers\SidangController@dasborSimpanSidangBaru');
Route::get ('/dasbor/pegawai/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSuntingSidang');
Route::post('/dasbor/pegawai/sidang/sunting/{id_sidang}', 'Simta\Controllers\SidangController@dasborSimpanPerubahanSidang');
Route::get ('/dasbor/pegawai/sidang/hapus/{id_sidang}', 'Simta\Controllers\SidangController@dasborHapusSidang');

// SitInController
/**
 * Rute untuk SitInController.
 * Implementasi laman Sit In untuk mahasiswa dan dosen berbeda.
 * Laman Sit In mahasiswa menampilkan form alur mahasiswa memilih dosen.
 * Laman Sit In dosen menampilkan form permintaan sit in dan persetujuannya.
 */
Route::get ('/dasbor/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
Route::post ('/dasbor/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
Route::delete ('/dasbor/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
Route::get ('/dasbor/dosen/sit_in', 'Simta\Controllers\SitInController@dasborSitInDosen');

// PenggunaController
Route::get ('/dasbor/pengguna/mahasiswa/tambah', 'Simta\Controllers\PenggunaController@borangTambahPenggunaMahasiswa');
Route::post('/dasbor/pengguna/mahasiswa/tambah', 'Simta\Controllers\PenggunaController@tambahPenggunaMahasiswa');
Route::get ('/dasbor/pengguna/mahasiswa/calon', 'Simta\Controllers\PenggunaController@lihatSemuaCalonPenggunaMahasiswa');
Route::post('/dasbor/pengguna/mahasiswa/cari', 'Simta\Controllers\PenggunaController@lihatHasilPencarianCalonPenggunaMahasiswa');

// DosenController
Route::get('/dosen/{id_dosen}', 'Simta\Controllers\DosenController@lihatProfilDosen');
Route::get('/dasbor/dosen', 'Simta\Controllers\DosenController@dasborDosen');
Route::get('/dasbor/pengguna/dosen', 'Simta\Controllers\DosenController@kelolaDosen');
Route::post('/dasbor/pengguna/dosen', 'Simta\Controllers\DosenController@kelolaDosen');
Route::put('/dasbor/pengguna/dosen', 'Simta\Controllers\DosenController@kelolaDosen');
Route::delete('/dasbor/pengguna/dosen', 'Simta\Controllers\DosenController@kelolaDosen');

// TugasAkhirController
Route::get('/dasbor/dosen/bimbingan', 'Simta\Controllers\TugasAkhirController@bimbingan');
Route::get('/dasbor/dosen/bimbingan/{id_tugas_akhir}', 'Simta\Controllers\TugasAkhirController@profilBimbingan');

// PegawaiController
Route::get('/dasbor/pegawai', 'Simta\Controllers\PegawaiController@dasborPegawai');

// SyaratController
Route::get('/dasbor/pegawai/syarat', 'Simta\Controllers\SyaratController@cariSyarat');
Route::get('/dasbor/pegawai/syarat/{nrp_mahasiswa}', 'Simta\Controllers\SyaratController@kelolaSyaratMahasiswa');

// RUTE SPESIAL, AKSES SILANG
// Special case Ajax request only for Master Data
if(Request::ajax()){
    // Bisa diakses semua
    Route::get ('/dasbor/umum/dosen/prodi', 'Simta\Controllers\BidangMinatController@dasborBidangMinat');

    // Diakses role dan user tertentu (atau mungkin beda role beda perlakuan)
    // Dienforce di dalam kode secara manual
    Route::get('/dasbor/dosen/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
    Route::put('/dasbor/dosen/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
    Route::delete('/dasbor/dosen/mahasiswa/sit_in', 'Simta\Controllers\SitInController@dasborSitInMahasiswa');
}

// BATAS CONCERN CRUD PLAIN
/* You don't need this
Route::get('/dosen', 'Simta\Controllers\DosenController@lihatSemuaDosen');
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
