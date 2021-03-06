<?php
/**
 * MahasiswaController
 * Mengelola proses dalam rute /mahasiswa dan /dasbor/mahasiswa
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\MahasiswaController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Mahasiswa;
use Auth;

class MahasiswaController extends BaseController {

    /**
     * Tampilkan Profil Mahasiswa
     *
     * @var string $id
     * @return View
     */
    function lihatProfilMahasiswa($id)
    {
        $item = Mahasiswa::with('tugasAkhir.penawaranJudul.bidangKeahlian', 'tugasAkhir.penawaranJudul.bidangKeahlian.bidangMinat', 'tugasAkhir.dosenPembimbing')->find($id);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Mahasiswa'),
            array('link' => '', 'text' => 'Profil ' . $item->nama_lengkap)
        );

        if ($item == null)
        {
            return Redirect::to('/');
        }

        $tugasAkhir = null;

        if ($item->tugasAkhir != null)
        {
            $tugasAkhir = $item->tugasAkhir->sortBy('id_tugas_akhir')->last();
        }

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        View::share('tugasAkhir', $tugasAkhir);
        return View::make('pages.mahasiswa.item');
    }

    /* Kelompok dasbor */

    /**
     * Tampilan laman dasbor awal untuk mahasiswa.
     * Sekarang mulai mengatur akses REST (melalui AJAX juga)
     * @return View
     */
    function dasborMahasiswa()
    {
        if(!Request::ajax())
        {
            $item = Mahasiswa::with('tugasAkhir.penawaranJudul.bidangKeahlian', 'tugasAkhir.penawaranJudul.bidangKeahlian.bidangMinat', 'tugasAkhir.dosenPembimbing', 'tugasAkhir.sidang.ruangan', 'tugasAkhir.sidang.pengujiSidang')->find(Auth::user()->person_id);
            $tugasAkhir = null;
            $sidang = null;
            $pemberitahuan = null;

            if ($item->tugasAkhir->count() > 0)
            {
                $tugasAkhir = $item->tugasAkhir->sortBy('id_tugas_akhir')->last();
                $sidang = $tugasAkhir->sidang->sortBy('id_sidang');
            }

            $pemberitahuan = Mahasiswa::with(array('pemberitahuan' => function($query)
            {
                $query->orderBy('id_pemberitahuan', 'DESC');
            }))->find(Auth::user()->person_id)->pemberitahuan;

            View::share('pemberitahuan', $pemberitahuan);
            View::share('item', $item);
            View::share('tugasAkhir', $tugasAkhir);
            View::share('sidang', $sidang);
            return View::make('pages.dasbor.mahasiswa.index');
        }
        else
        {
            if(Request::has('mySelf'))
            {
                return Response::json(Mahasiswa::find(Auth::user()->person_id));
            }
            else
            {
                return Response::json(Mahasiswa::where('aktif', '1')->get());
            }
        }
    }
}
