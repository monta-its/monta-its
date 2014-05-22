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
            array('link' => URL::to('/bidang_keahlian'), 'text' => 'Bidang Keahlian'),
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
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.bidang_keahlian.index');
            }
            else
            {
                return Response::json(BidangKeahlian::get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $bidang_keahlian = new BidangKeahlian;
            $bidang_keahlian->nama_bidang_keahlian = Input::get('nama_bidang_keahlian');
            $bidang_keahlian->deskripsi_bidang_keahlian = Input::get('deskripsi_bidang_keahlian');
            $bidang_keahlian->save();

        }
        else if(Request::isMethod('put'))
        {
            $bidang_keahlian = BidangKeahlian::find(Input::get('id_bidang_keahlian'));
            if($bidang_keahlian != null) {
                $bidang_keahlian->nama_bidang_keahlian = Input::get('nama_bidang_keahlian');
                $bidang_keahlian->deskripsi_bidang_keahlian = Input::get('deskripsi_bidang_keahlian');
                $bidang_keahlian->save();
            }

        }
        else if(Request::isMethod('delete'))
        {
            $bidang_keahlian = BidangKeahlian::find(Input::get('id_bidang_keahlian'));
            $bidang_keahlian->delete();
        }
    }

}
