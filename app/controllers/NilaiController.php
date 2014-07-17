<?php
/**
 * NilaiController
 * Mengendalikan alur penilaian TugasAkhir mahasiswa
 * rute: /dasbor/dosen/nilai
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\NilaiController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\NilaiProposal;
use Simta\Models\NilaiAkhir;
use Simta\Models\Dosen;
use Simta\Models\TugasAkhir;
use Auth;

class NilaiController extends BaseController {
    /**
     * Menampilkan daftar nilai 
     * mahasiswa bimbingan & mahasiswa yang diuji
     * 
     * @return View
     */
    public function daftarNilaiMahasiswa()
    {
        $nip_dosen = Auth::user()->nomor_induk;
        # mahasiswa yang belum dinilai
        # oleh dosen pembimbingnya dan dosen pengujinya
        $dosen = Dosen::find($nip_dosen);
        if ($dosen != null)
        {
            # tugas akhir berdasarkan dosen pembimbing
            $tugasAkhirBimbingan = $dosen->tugasAkhir()->with('nilaiProposal', 'nilaiAkhir', 'mahasiswa')->get();
            # tugas akhir berdasarkan dosen penguji
            $seminarDanSidang = $dosen->sidang()->where('disetujui', 1)->with('tugasAkhir.mahasiswa')->get();
        }
        View::share('tugasAkhirBimbingan', $tugasAkhirBimbingan);
        View::share('seminarDanSidang', $seminarDanSidang);
        View::share('nip_dosen', $nip_dosen);
        return View::make('pages.dasbor.nilai.index');
    }

    public function nilaiAkhirMahasiswa($nrp_mahasiswa)
    {
        $item = new \StdClass;
        $item->page_title = '';
        $item->nama_lengkap = '';
        $item->nrp_mahasiswa = '';
        $item->judul_tugas_akhir = '';
        $item->jenis_nilai = '';
        $item->nilai = '';
        $item->id_tugas_akhir = '';

        View::share('item', $item);
        return View::make('pages.dasbor.nilai.item');
    }

    public function nilaiProposalMahasiswa($nrp_mahasiswa)
    {
        $item = new \StdClass;
        $item->page_title = '';
        $item->nama_lengkap = '';
        $item->nrp_mahasiswa = '';
        $item->judul_tugas_akhir = '';
        $item->jenis_nilai = '';
        $item->nilai = '';
        $item->id_tugas_akhir = '';

        View::share('item', $item);
        return View::make('pages.dasbor.nilai.item');
    }
}
