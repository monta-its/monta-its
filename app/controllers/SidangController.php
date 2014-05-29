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
use Auth;
use Simta\Models\Sidang;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;
use Simta\Models\Ruangan;
use Simta\Models\Dosen;

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
    function dasborSidang()
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
                        $sidang = array();
                        $mahasiswa = Mahasiswa::find($auth->nomor_induk);
                        $tugasAkhir = $mahasiswa->tugasAkhir()->get();
                        foreach($tugasAkhir as $ta)
                        {
                            foreach($ta->sidang()->with('tugasAkhir.mahasiswa', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan')->get() as $s)
                            {
                                $sidang[] = $s->toArray();
                            }
                        }
                        return Response::json($sidang);
                    }
                    else if($auth->peran == 2)
                    {
                        $dosen = Dosen::find($auth->nomor_induk);
                        $sidang = $dosen->pengujiSidang()->with('tugasAkhir', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan')->get();
                        return Response::json($sidang);
                    }
                    else
                    {
                        return Response::json(Sidang::with('tugasAkhir', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan')->get());
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
                        $tugasAkhir = TugasAkhir::with('mahasiswa')->where('tugas_akhir.id_tugas_akhir', Input::get('tugasAkhir.id_tugas_akhir'))->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->first();
                    }
                    else
                    {
                        $tugasAkhir = TugasAkhir::find(Input::get('tugasAkhir.id_tugas_akhir'));
                    }
                }
                else if(Request::isMethod('put'))
                {
                    if($auth->peran == 0)
                    {
                        $tugasAkhir = TugasAkhir::with('mahasiswa')->where('tugas_akhir.nrp_mahasiswa', $auth->nomor_induk)->where('tugas_akhir.id_tugas_akhir', Input::get('tugasAkhir.id_tugas_akhir'))->first();
                    }
                    else
                    {
                        $tugasAkhir = TugasAkhir::find(Input::get('id_tugas_akhir'));
                    }
                    $sidang = $tugasAkhir->sidang()->find(Input::get('id_sidang'));
                }

                $sidang->save();
                $sidang->pengujiSidang()->detach();
                foreach(Input::get('pengujiSidang') as $penguji)
                {
                    $dosen = Dosen::find($penguji['nip_dosen']);
                    if(!$sidang->pengujiSidang->contains($dosen->nip_dosen))
                    {
                        $sidang->pengujiSidang()->attach($dosen);
                    }
                }

                $ruangan = Ruangan::find(Input::get('ruangan.id_ruangan'));

                $sidang->fill(Input::get());
                $sidang->ruangan()->associate($ruangan);
                $sidang->tugasAkhir()->associate($tugasAkhir);
                $sidang->save();

            }
            else
            {
                $sidang = Sidang::find(Input::get('id_sidang'));
                $sidang->delete();
            }
        }
    }

}
