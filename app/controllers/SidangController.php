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
use PDF;
use Simta\Models\Sidang;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;
use Simta\Models\Ruangan;
use Simta\Models\Dosen;

class SidangController extends BaseController {
    /**
     * Tampilkan Kalender Seminar Proposal
     *
     * @return View
     */
    public function lihatSidangProposal()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Seminar Proposal')
        );

        $l_item = Sidang::with('tugasAkhir.mahasiswa', 'tugasAkhir.penawaranJudul.bidangMinat', 'ruangan', 'sesiSidang')->where('jenis_sidang', 'proposal')->get();
        
        $urut = Input::get('urut');
        if ($urut == 'tanggal' || $urut == null)
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tanggal;
                $b = $b->tanggal;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'nama_lengkap')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tugasAkhir->mahasiswa->nama_lengkap;
                $b = $b->tugasAkhir->mahasiswa->nama_lengkap;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'bidang_minat')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tugasAkhir->penawaranJudul->bidangMinat->nama_bidang_minat;
                $b = $b->tugasAkhir->penawaranJudul->bidangMinat->nama_bidang_minat;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'ruangan')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->ruangan->kode_ruangan;
                $b = $b->ruangan->kode_ruangan;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }

        View::share('page_title', 'Daftar Seminar Proposal');
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
            array('link' => '', 'text' => 'Sidang Akhir')
        );

        $l_item = Sidang::with('tugasAkhir.mahasiswa', 'tugasAkhir.penawaranJudul.bidangMinat', 'ruangan', 'sesiSidang')->where('jenis_sidang', 'akhir')->get();
        
        $urut = Input::get('urut');
        if ($urut == 'tanggal' || $urut == null)
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tanggal;
                $b = $b->tanggal;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'nama_lengkap')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tugasAkhir->mahasiswa->nama_lengkap;
                $b = $b->tugasAkhir->mahasiswa->nama_lengkap;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'bidang_minat')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->tugasAkhir->penawaranJudul->bidangMinat->nama_bidang_minat;
                $b = $b->tugasAkhir->penawaranJudul->bidangMinat->nama_bidang_minat;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }
        else if ($urut == 'ruangan')
        {
            $l_item->sort(function($a, $b)
            {
                $a = $a->ruangan->kode_ruangan;
                $b = $b->ruangan->kode_ruangan;
                if ($a === $b) {
                    return 0;
                }
                return ($a > $b) ? 1 : -1;
            });
        }

        View::share('page_title', 'Daftar Sidang Akhir');
        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.sidang.index');
    }

    /* Kelompok dasbor */

    /**
     * Dasbor Kelola Sidang Mahasiswa berbasis REST
     * @return View
     */
    function dasborSidangMahasiswa()
    {
        $pesan = '';
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
                            foreach($ta->sidang()->with('tugasAkhir.mahasiswa', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan', 'sesiSidang')->get() as $s)
                            {
                                $sidang[] = $s->toArray();
                            }
                        }
                        return Response::json($sidang);
                    }
                    else if($auth->peran == 2)
                    {
                        $dosen = Dosen::find($auth->nomor_induk);
                        $sidang = $dosen->pengujiSidang()->with('tugasAkhir', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan', 'sesiSidang')->get();
                        return Response::json($sidang);
                    }
                    else
                    {
                        return Response::json(Sidang::with('tugasAkhir', 'pengujiSidang.pegawai', 'tugasAkhir.penawaranJudul', 'ruangan', 'sesiSidang')->get());
                    }

                }
                else
                {
                    // Sementara view untuk /dasbor/mahasiswa/sidang dulu ini
                    return View::make('pages.dasbor.sidang.mahasiswa');
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
                    $sidang->pengujiSidang()->attach($dosen);
                }

                $ruangan = Ruangan::find(Input::get('ruangan.id_ruangan'));
                $jenisSidang = Input::get('jenis_sidang');
                $mahasiswa = $tugasAkhir->mahasiswa()->first()->toArray();
                if(($jenisSidang == "proposal" && $mahasiswa['lolos_syarat_seminar_proposal'] == true) ||
                ($jenisSidang == "akhir" && $mahasiswa['lolos_syarat_sidang_akhir'] == true))
                {
                    $sidang->fill(Input::get());
                    $sidang->ruangan()->associate($ruangan);
                    $sidang->tugasAkhir()->associate($tugasAkhir);
                    $sidang->save();
                    $pesan = 'Penyimpanan data berhasil.';
                }
                else
                {
                    $pesan = 'Anda tidak berhak mengajukan sidang. Lengkapilah terlebih dahulu persyaratan pra seminar proposal atau pra sidang akhir.';
                }
            }
            else
            {
                $sidang = Sidang::find(Input::get('id_sidang'));
                if ($sidang != null)
                {
                    $sidang->delete();
                    $pesan = 'Penghapusan data berhasil.';
                }
                else
                {
                    $pesan = 'Data seminar / sidang tidak ditemukan. Penghapusan data dibatalkan.';
                }
            }

            return Response::json(array('pesan' => $pesan));
        }
    }

    /**
     * Dasbor kelola sidang oleh Pegawai
     * @return View
     */
    function dasborSidangPegawai()
    {
        $l_item_proposal = Sidang::with('tugasAkhir.mahasiswa', 'tugasAkhir.penawaranJudul.bidangKeahlian', 'tugasAkhir.penawaranJudul.bidangMinat', 'ruangan', 'sesiSidang')->where('jenis_sidang', 'proposal')->get();
        $l_item_akhir = Sidang::with('tugasAkhir.mahasiswa', 'tugasAkhir.penawaranJudul.bidangKeahlian', 'tugasAkhir.penawaranJudul.bidangMinat', 'ruangan', 'sesiSidang')->where('jenis_sidang', 'akhir')->get();

        View::share('l_item_proposal', $l_item_proposal);
        View::share('l_item_akhir', $l_item_akhir);
        return View::make('pages.dasbor.sidang.pegawai');
    }

    /**
     * Unduh berkas berita acara seminar dan sidang
     * @param  string $id_sidang ID seminar atau sidang yang ingin 
     * @return File Mime type : application/pdf
     */
    function unduhBeritaAcara($id_sidang)
    {
        $sidang = Sidang::with('pengujiSidang.pegawai', 'tugasAkhir.mahasiswa', 'tugasAkhir.penawaranJudul.bidangKeahlian', 'tugasAkhir.penawaranJudul.bidangMinat', 'ruangan', 'sesiSidang')->find($id_sidang);
        if ($sidang != null)
        {
            $jenis_berita_acara = '';
            $sidang->jenis_sidang == 'akhir' ? $jenis_berita_acara = 'Sidang' : $jenis_berita_acara = 'Seminar Proposal';
            
            setlocale(LC_ALL, 'IND');
            View::share('jenis_berita_acara', $jenis_berita_acara);
            View::share('sidang', $sidang);
            $pdf = PDF::loadView('reports.berita_acara')->setPaper('folio');
            return $pdf->download($sidang->id_sidang . '-' . $sidang->jenis_sidang . '-' . $sidang->ruangan->kode_ruangan . '-' . $sidang->tugasAkhir->nrp_mahasiswa. '.pdf');
        }
        else
        {
            Session::set('page_title', 'Tidak Ditemukan');
            Session::set('message', 'Data seminar atau sidang yang Anda maksudkan tidak ditemukan.');
            return Redirect::to('/sidang/terlarang');
        }
    }

}
