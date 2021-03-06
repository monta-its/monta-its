<?php
/**
 * BidangMinatController
 * Menangani semua proses yang berkaitan dengan bidang minat, baik di halaman umum maupun dasbor
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BidangMinatController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Response;
use Request;
use Simta\Models\BidangMinat;
use Simta\Models\Dosen;

class BidangMinatController extends BaseController {

    /**
     * Tampilan bidang minat secara umum.
     *
     * @return View
     */
    public function lihatSemuaBidangMinat()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Prodi')
        );

        $items = BidangMinat::with('bidangKeahlian')->get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);

        return View::make('pages.prodi.index');
    }

    /**
     * Tampilan laman rincian bidang minat.
     *
     * @return View
     */
    public function lihatRincianBidangMinat($id_prodi)
    {
        $item = BidangMinat::with('dosen.bidangKeahlian', 'dosen', 'bidangKeahlian.penawaranJudul.tugasAkhir.mahasiswa', 'bidangKeahlian.penawaranJudul.dosen')->find($id_prodi);
        if($item != null)
        {
            $breadcrumbs = array(
                array('link' => URL::to('/'), 'text' => 'Beranda'),
                array('link' => URL::to('/prodi'), 'text' => 'Prodi'),
                array('link' => '', 'text' => $item->nama_bidang_minat . '('. $item->kode_bidang_minat .')'),
            );


            View::share('breadcrumbs', $breadcrumbs);
            View::share('item', $item);

            return View::make('pages.prodi.item');
        }

        return Redirect::to('/');
    }

    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor BidangMinat, berbasiskan mekanisme REST
     * @return View
     */
    function dasborBidangMinat()
    {
        $pesan = "";
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.prodi.index');
            }
            else
            {
                // With Dosen
                if(Input::get('dosen') == '')
                {
                    return Response::json(BidangMinat::with('dosen', 'dosen', 'dosen.bidangKeahlian')->get());
                }
                else
                {
                    // With Koordinator
                    return Response::json(BidangMinat::with('dosenKoordinator', 'dosenKoordinator')->get());
                }
            }
        }
        else if(Request::isMethod('post'))
        {
            $bidangMinat = new BidangMinat;
            $dosenKoordinator = Dosen::find(Input::get('dosenKoordinator.nip'));
            if($dosenKoordinator != null)
            {
                $bidangMinat->kode_bidang_minat = Input::get('kode_bidang_minat');
                $bidangMinat->nama_bidang_minat = Input::get('nama_bidang_minat');
                $bidangMinat->dosenKoordinator()->associate($dosenKoordinator);
                $bidangMinat->save();
                $pesan = "Penyimpan data berhasil.";
            }
            else
            {
                $pesan = "Data Ketua Laboratorium tidak ditemukan. Penambahan data dibatalkan.";
            }

        }
        else if(Request::isMethod('put'))
        {
            $bidangMinat = BidangMinat::find(Input::get('id_bidang_minat'));
            $dosenKoordinator = Dosen::find(Input::get('dosenKoordinator.nip'));
            if($dosenKoordinator != null && $bidangMinat != null)
            {
                $bidangMinat->nama_bidang_minat = Input::get('nama_bidang_minat');
                $bidangMinat->kode_bidang_minat = Input::get('kode_bidang_minat');
                $bidangMinat->dosenKoordinator()->associate($dosenKoordinator);
                $bidangMinat->save();
                $pesan = "Perubahan data berhasil disimpan.";
            }
            else
            {
                $pesan = "Data Ketua Laboratorium atau Laboratorium tidak ditemukan. Penyimpanan perubahan data dibatalkan.";
            }

        }
        else if(Request::isMethod('delete'))
        {
            $bidangMinat = BidangMinat::find(Input::get('id_bidang_minat'));
            if ($bidangMinat != null)
            {
                $bidangMinat->delete();                
                $pesan = "Data berhasil dihapus.";
            }
            else
            {
                $pesan = "Data Laboratorium tidak ditemukan. Penghapusan data dibatalkan.";
            }
        }

        return Response::json(array('pesan' => $pesan));
    }
}
