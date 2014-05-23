<?php
/**
 * DosenController
 * Mengelola proses dalam rute /dosen dan /dasbor/dosen
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\DosenController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Dosen;

class DosenController extends BaseController {
    /**
     * Tampilkan Dosen Secara Umum
     *
     * @return View
     */
    public function lihatSemuaDosen()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Dosen')
        );

        $l_item = array();
        // array_push($l_item, $item);
        // array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.dosen.index');
    }


    /**
     * Tampilkan Profil Dosen. Menerima parameter $id_dosen yang merupakan NIP dosen.
     *
     * @var string $id_dosen
     * @return View
     */
    function lihatProfilDosen($id_dosen)
    {
        $item = Dosen::with('bidangKeahlian', 'pegawai', 'penawaranJudul.tugasAkhir')->find($id_dosen);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Dosen'),
            array('link' => '', 'text' => 'Profil ' . $item->pegawai->nama_lengkap)
        );

        if ($item == null)
        {
            return Redirect::to('/');
        }

        View::share('item', $item);
        View::share('breadcrumbs', $breadcrumbs);
        return View::make('pages.dosen.item');
    }

    /* Kelompok dasbor */

    /**
     * Dasbor Dosen berbasis REST
     * @return View
     */
    function dasborDosen()
    {

        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.dosen.index');
            }
            else
            {
                return Response::json(Dosen::with('pegawai', 'bidangKeahlian')->get());
            }

        }
    }

}
