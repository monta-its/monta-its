<?php
/**
 * SidangController
 * Handle everything under "/sidang" and "/dasbor/sidang" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\SidangController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Sidang;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;

class SidangController extends BaseController {
    /**
     * Tampilkan Kalender Sidang Proposal
     *
     * @return View
     */
    public function lihatSidangProposal()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Sidang Proposal')
        );
        $l_item = array(
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            ),
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            ),
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            )
        );
        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.sidang.index');
    }

    /**
     * Tampilkan Kalender Sidang Tugas Akhir
     *
     * @return View
     */
    public function lihatSidangTA()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Sidang TA')
        );
        $l_item = array(
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            ),
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            ),
            array(
                'tanggal_sidang' => '15-10-2014 10:00AM',
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'judul' => 'Judul Proposal Yang Panjang Sepanjang Panjangnya',
                'ruang_sidang' => 'IF-201',
                'label_prodi' => 'Prodi',
                'nama_prodi' => 'Nama Prodi'
            )
        );
        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.sidang.index');
    }

    /* Kelompok dasbor */

    /**
     * Dasbor Kelola Sidang berbasis REST
     * @return View
     */
    function dasborKelolaSidang()
    {
        $auth = Auth::user();
        if($auth)
        {
            if(Request::isMethod('get'))
            {
                if(Request::ajax())
                {
                    if($auth->peran == 0)
                    {
                        return Response::json(Sidang::with('tugasAkhir', 'pengujiSidang')->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->get());
                    }
                    else if($auth->peran == 2)
                    {
                        return Response::json(Sidang::with('tugasAkhir', 'pengujiSidang')->where('penguji_sidang.nip_dosen', $auth->nomor_induk)->get());
                    }
                    else
                    {
                        return Response::json(Sidang::with('tugasAkhir', 'pengujiSidang')->get());
                    }

                }
                else
                {
                    // Sementara view untuk /dasbor/mahasiswa/sidang dulu ini
                    return View::make('pages.dasbor.sidang.index');
                }
            }
            else if(Request::isMethod('post') || Request::isMethod('put'))
            {
                if(Request::isMethod('post'))
                {
                    $sidang = new Sidang;
                    if($auth->peran == 0)
                    {
                        $tugasAkhir = TugasAkhir::with('mahasiswa')->where('tugas_akhir.id_tugas_akhir', Input::get('id_tugas_akhir'))->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->first();
                    }
                    else
                    {
                        $tugasAkhir = TugasAkhir::find(Input::get('id_tugas_akhir'));
                    }
                }
                else if(Request::isMethod('put'))
                {
                    if($auth->peran == 0)
                    {
                        $tugasAkhir = TugasAkhir::with('mahasiswa')->where('tugas_akhir.id_tugas_akhir', Input::get('id_tugas_akhir'))->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->first();
                        $sidang = Sidang::with('tugasAkhir')->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->where('sidang.id_sidang', Input::get('id_sidang'))->first();
                    }
                    else
                    {
                        $tugasAkhir = TugasAkhir::find(Input::get('id_tugas_akhir'));
                        $sidang = Sidang::find(Input::get('id_sidang'));
                    }
                }

                $sidang->fill(Input::get());
                $sidang->tugasAkhir()->associate($tugasAkhir);
                $sidang->save();

            }
        }
    }

}
