<?php
/**
 * JudulController
 * Handle everything under "/judul" and "/dasbor/judul" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\JudulController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\PenawaranJudul;

class JudulController extends BaseController {
    /**
     * Tampilkan Judul Secara Umum
     *
     * @return View
     */
    public function lihatSemuaJudul()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Penawaran Judul')
        );

        $items = PenawaranJudul::with('topik.bidangKeahlian.bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.judul.index');
    }


    /**
     * Tampilkan Isi Judul
     *
     * @var string $id_judul
     * @return View
     */
    function lihatIsiJudul($id_judul)
    {
        $item = PenawaranJudul::with('topik.bidangKeahlian.bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->find($id_judul);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/judul'), 'text' => 'Judul TA'),
            array('link' => '', 'text' => $item->judul_tugas_akhir)
        );
        
        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.judul.item');
    }

    /**
     * Tampilkan daftar judul berdasarkan bidang minat
     *
     * @var string id_prodi
     * @return View
     */
    function lihatJudulDariBidangMinat($id_prodi)
    {
        return 'Halaman memuat judul-judul yang dengan filter bidang minat tertentu';
    }

    /**
     * Tampilkan daftar judul berdasarkan bidang keahlian
     *
     * @var string id_bidang_keahlian
     * @return View
     */
    function lihatJudulDariBidangKeahlian($id_bidang_keahlian)
    {
        return 'Halaman memuat judul-judul yang dengan filter bidang keahlian tertentu';
    }

    /**
     * Tampilkan daftar judul berdasarkan topik
     *
     * @var string id_topik
     * @return View
     */
    function lihatJudulDariTopik($id_topik)
    {
        return 'Halaman memuat judul-judul yang dengan filter topik tertentu';
    }

    /**
     * Ambil judul tertentu
     *
     * @var string id_judul
     * @return View
     */
    function ambilJudul($id_judul)
    {
        return 'Ambil judul kemudian redirect ke laman profil TA yang memuat informasi pengambilan';
    }

    /**
     * Batalkan judul yang sedang diambil
     *
     * @return View
     */
    function batalkanJudul()
    {
        return 'Batalkan judul yang sedang diambil';
    }
    
    /* Kelompok dasbor */

    /**
     * Tampilan daftar judul yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarJudul()
    {
        return View::make('pages.dasbor.judul.index');
    }

    /**
     * Tambahkan judul baru. Menampilkan laman penambahan judul.
     *
     * @return View
     */
    function dasborTambahkanJudul()
    {
        return View::make('pages.dasbor.judul.baru');
    }

    /**
     * Simpan judul baru.
     *
     * @return View
     */
    function dasborSimpanJudulBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/judul');
    }

    /**
     * Sunting judul
     *
     * @var string $id_judul
     * @return View
     */
    function dasborSuntingJudul($id_judul)
    {
        return View::make('pages.dasbor.judul.sunting');
    }

    /**
     * Simpan judul yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanJudul()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/judul');
    }

    /**
     * Hapus judul
     *
     * @var string $id_judul
     * @return View
     */
    function dasborHapusJudul($id_judul)
    {
        return Redirect::to('dasbor/judul');
    }
}
