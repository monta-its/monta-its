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
use Request;
use Response;

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

        $items = BidangKeahlian::with('bidangKeahlian', 'dosen.pegawai')->get();

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
        $item = BidangKeahlian::with('topik.tugasAkhir.mahasiswa', 'bidangKeahlian', 'dosen.pegawai')->find($id_bidang_keahlian);

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
    function lihatBidangKeahlianDariBidangKeahlian($id_prodi)
    {
        return 'Halaman memuat bidang keahlian yang dengan filter bidang minat tertentu';
    }

    /* Kelompok dasbor */
    /**
     * Controller untuk Dasbor BidangKeahlian, berbasiskan mekanisme REST
     * @return View
     */
    function dasborBidangKeahlian()
    {
        if(Request::isMethod('get'))
        {
            return Response::json(BidangKeahlian::get());
        }
    }

}
