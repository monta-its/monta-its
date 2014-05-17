<?php
/**
 * TopikController
 * Handle everything under "/topik" and "/dasbor/pegawai/topik" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\TopikController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Response;
use Request;
use Simta\Models\Topik;
use Simta\Models\BidangMinat;

class TopikController extends BaseController {


    /**
     * Tampilkan Topik Secara Umum
     *
     * @return View
     */
    // TODO: Tolong definisikan ulang apa itu Topik, kok gak nyambung ya dengan apa yang ada di model dan dasbor
    public function lihatSemuaTopik()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Topik TA')
        );

        $items = Topik::with('bidangMinat')->get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.topik.index');
    }


    /**
     * Tampilkan Isi Topik
     *
     * @var string $id_topik
     * @return View
     */
    function lihatIsiTopik($id_topik)
    {
        $item = Topik::with('bidangMinat', 'tugasAkhir', 'tugasAkhir.mahasiswa')->find($id_topik);
        if($item != null)
        {
            $breadcrumbs = array(
                array('link' => URL::to('/'), 'text' => 'Beranda'),
                array('link' => URL::to('/topik'), 'text' => 'Topik TA'),
                array('link' => '', 'text' => $item->topik)
            );

            View::share('breadcrumbs', $breadcrumbs);
            View::share('item', $item);
            return View::make('pages.topik.item');
        }

        return Redirect::to('/');
    }


    /**
     * Tampilkan daftar topik berdasarkan bidang minat
     *
     * @var string id_prodi
     * @return View
     */
    function lihatTopikDariBidangMinat($id_prodi)
    {
        return 'Halaman memuat topik-topik yang dengan filter bidang minat tertentu';
    }

    /**
     * Tampilkan daftar topik berdasarkan bidang keahlian
     *
     * @var string id_bidang_keahlian
     * @return View
     */
    function lihatTopikDariBidangKeahlian($id_bidang_keahlian)
    {
        return 'Halaman memuat topik-topik yang dengan filter bidang keahlian tertentu';
    }

    /**
     * Ambil topik tertentu
     *
     * @var string id_topik
     * @return View
     */
    function ambilTopik($id_topik)
    {
        return 'Ambil topik kemudian redirect ke laman profil TA yang memuat informasi pengambilan';
    }

    /**
     * Batalkan topik yang sedang diambil
     *
     * @return View
     */
    function batalTopik()
    {
        return 'Batalkan topik yang sedang diambil';
    }

    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor Topik, berbasiskan mekanisme REST
     * @return View
     */
    function dasborTopik()
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.topik.index');
            }
            else
            {
                return Response::json(Topik::with('bidangMinat')->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $topik = new Topik;
            $bidangMinat = BidangMinat::find(Input::get('kode_bidang_minat'));
            if($bidangMinat != null)
            {
                $topik->topik = Input::get('topik');
                $topik->deskripsi = Input::get('deskripsi');
                $topik->bidangMinat()->associate($bidangMinat);
                $topik->save();
            }

        }
        else if(Request::isMethod('put'))
        {
            $topik = Topik::find(Input::get('id_topik'));
            $bidangMinat = BidangMinat::find(Input::get('kode_bidang_minat'));
            if($bidangMinat != null && $topik != null)
            {
                $topik->topik = Input::get('topik');
                $topik->deskripsi = Input::get('deskripsi');
                $topik->bidangMinat()->associate($bidangMinat);
                $topik->save();
            }

        }
        else if(Request::isMethod('delete'))
        {
            // TODO: Perbaiki implementasi agar bisa berjalan
            Topik::delete(Input::get('id_topik'));
        }
    }
}
