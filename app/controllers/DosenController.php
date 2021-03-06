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
use Simta\Models\BidangMinat;
use Auth;

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
        $item = Dosen::with('bidangKeahlian', 'bidangMinat', 'penawaranJudul.tugasAkhir', 'pembimbingTugasAkhir.mahasiswa', 'pembimbingTugasAkhir.penawaranJudul', 'sitIn.mahasiswa')->find($id_dosen);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Dosen'),
            array('link' => '', 'text' => 'Profil ' . $item->nama_lengkap)
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
     * Kelola Dosen berbasis REST
     * @return View
     */
    function kelolaDosen()
    {

        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.dosen.index');
            }
            else
            {
                $dosen = array();
                if(Input::has('bidangMinat') && Input::has('hari') && Input::has('sesi'))
                {
                    $daftarBidangMinat = json_decode(Input::get('bidangMinat'));
                    foreach($daftarBidangMinat as $dbm)
                    {

                        $dosenBidangMinat = BidangMinat::find($dbm)->dosen()->with('bidangKeahlian')->get();
                        foreach ($dosenBidangMinat as $d)
                        {
                            if($d->apakahTersediaJadwalDosen(Input::get('hari'), Input::get('sesi')))
                            {
                                $dosen[] = $d->toArray();
                            }
                        }
                    }
                    return Response::json($dosen);
                }
                else
                {
                    return Response::json(Dosen::with('bidangKeahlian')->get());
                }
            }

        }
    }

    /**
     * Dasbor Dosen
     * @return View
     */
    function dasborDosen()
    {
        $pemberitahuan = Dosen::with(array('pemberitahuan' => function($query)
        {
            $query->orderBy('id_pemberitahuan', 'DESC');
        }))->find(Auth::user()->person_id)->pemberitahuan;
        View::share('pemberitahuan', $pemberitahuan);

        $dosen = Dosen::find(Auth::user()->person_id);

        $mahasiswaBimbingan = $dosen->pembimbingTugasAkhir()->with('mahasiswa')->get();
        View::share('mahasiswaBimbingan', $mahasiswaBimbingan);

        $mahasiswaSitIn = $dosen->sitIn()->with('mahasiswa')->get();
        View::share('mahasiswaSitIn', $mahasiswaSitIn);

        $jadwalSidangBimbingan = $dosen->pembimbingTugasAkhir()->with('sidang.pengujiSidang', 'mahasiswa', 'sidang.ruangan')->get();
        View::share('jadwalSidangBimbingan', $jadwalSidangBimbingan);

        $jadwalSidangMenguji = $dosen->pengujiSidang()->with('tugasAkhir.mahasiswa', 'pengujiSidang')->get();
        View::share('jadwalSidangMenguji', $jadwalSidangMenguji);

        return View::make('pages.dasbor.dosen.index');
    }

}
