<?php
/**
 * BidangKeahlianController
 * Handle everything under "/bidang_keahlian" and "/dasbor/bidang_keahlian" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BidangKeahlianController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\BidangKeahlian;

class BidangKeahlianController extends BaseController {


    /**
     * Tampilkan Bidang Keahlian Secara Umum
     *
     * @return View
     */
    public function lihatSemuaBidangKeahlian()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Bidang Keahlian')
        );

        $items = BidangKeahlian::with('bidangMinat', 'dosen.pegawai')->get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.bidang_keahlian.index');
    }


    /**
     * Tampilkan Isi BidangKeahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function lihatIsiBidangKeahlian($id_bidang_keahlian)
    {
        $item = BidangKeahlian::with('topik.tugasAkhir.mahasiswa', 'bidangMinat', 'dosen.pegawai')->find($id_bidang_keahlian);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/bidang_keahlian'), 'text' => 'Bidang Ahli'),
            array('link' => '', 'text' => $item->nama_bidang_keahlian)
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.bidang_keahlian.item');
    }


    /**
     * Tampilkan daftar bidang keahlian berdasarkan bidang minat
     *
     * @var string id_prodi
     * @return View
     */
    function lihatBidangKeahlianDariBidangMinat($id_prodi)
    {
        return 'Halaman memuat bidang keahlian yang dengan filter bidang minat tertentu';
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar bidang_keahlian yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarBidangKeahlian()
    {
        return View::make('pages.dasbor.bidang_keahlian.index');
    }

    /**
     * Tambahkan bidang_keahlian baru. Menampilkan laman penambahan bidang_keahlian.
     *
     * @return View
     */
    function dasborTambahkanBidangKeahlian()
    {
        return View::make('pages.dasbor.bidang_keahlian.baru');
    }

    /**
     * Simpan bidang_keahlian baru.
     *
     * @return View
     */
    function dasborSimpanBidangKeahlianBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/bidang_keahlian');
    }

    /**
     * Sunting bidang_keahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function dasborSuntingBidangKeahlian($id_bidang_keahlian)
    {
        return View::make('pages.dasbor.bidang_keahlian.sunting');
    }

    /**
     * Simpan bidang_keahlian yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanBidangKeahlian()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/bidang_keahlian');
    }

    /**
     * Hapus bidang_keahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function dasborHapusBidangKeahlian($id_bidang_keahlian)
    {
        return Redirect::to('dasbor/pegawai/bidang_keahlian');
    }
}
