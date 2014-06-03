<?php
/**
 * TugasAkhirController
 * Mengelola Tugas Akhir dan relasinya terhadap Dosen dan Mahasiswa
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\TugasAkhirController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Auth;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;
use Simta\Models\Dosen;
use Simta\Models\StatusTugasAkhir;

class TugasAkhirController extends BaseController {
    /**
     * Mengelola data Tugas Akhir yang dibimbing oleh Dosen tertentu.
     *
     * @return View
     */
    function bimbingan()
    {
        $dosen = Dosen::find(Auth::user()->nomor_induk);
        $mahasiswaBimbingan = $dosen->pembimbingTugasAkhir()->with('mahasiswa')->get();

        View::share('mahasiswaBimbingan', $mahasiswaBimbingan);
        return View::make('pages.dasbor.bimbingan.index');
    }

    /**
     * Menampilkan profil Tugas Akhir mahasiswa
     *
     * @var string $id_tugas_akhir
     * @return View
     */
    function profilBimbingan($id_tugas_akhir)
    {
        $dosen = Dosen::find(Auth::user()->nomor_induk);
        $tugasAkhir = $dosen->pembimbingTugasAkhir()->with('mahasiswa', 'penawaranJudul')->where('dosen_pembimbing.id_tugas_akhir', $id_tugas_akhir)->first();
        $mahasiswa = $tugasAkhir->mahasiswa()->first()->toArray();
        $statusTugasAkhir = StatusTugasAkhir::get();

        View::share('mahasiswa', $mahasiswa);
        View::share('item', $tugasAkhir);
        View::share('status', $statusTugasAkhir);
        return View::make('pages.dasbor.bimbingan.item');
    }

    /**
     * Tugas Akhir dalam bentuk REST
     *
     * @return Response::json
     */
    function dasborTugasAkhir()
    {
        $auth = Auth::user();
        if(Request::isMethod('get'))
        {
            // Mahasiswa: Ambil tugasAkhir bimbingannya saja
            // Lainnya: Ambil semua tugasAkhir
            if($auth->peran == 0)
            {
                return Response::json(TugasAkhir::with('penawaranJudul.topik.bidangKeahlian.bidangMinat', 'mahasiswa')->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->get());
            }
            else
            {
                return Response::json(TugasAkhir::with('penawaranJudul.topik.bidangKeahlian.bidangMinat', 'mahasiswa')->get());
            }
        }
        else if(Request::isMethod('put') || Request::isMethod('post'))
        {
            if(Request::isMethod('put'))
            {
                if($auth->peran == 2)
                {
                    $dosen = Dosen::find($auth->nomor_induk);
                    $tugasAkhir = $dosen->pembimbingTugasAkhir()->where('dosen_pembimbing.id_tugas_akhir', Input::get('id_tugas_akhir'))->first();
                }
                else if($auth->peran == 3)
                {
                    $tugasAkhir = TugasAkhir::find(Input::get('id_tugas_akhir'));
                }
            }
            else if (Request::isMethod('post'))
            {
                $tugasAkhir = new TugasAkhir;
            }

            $tugasAkhir->fill(Input::all());
            $tugasAkhir->save();
        }

    }


}
