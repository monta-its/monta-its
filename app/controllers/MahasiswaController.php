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
     * @var string $id_mahasiswa
     * @return View
     */
    function lihatProfilMahasiswa($id_mahasiswa)
    {
        $item = Mahasiswa::with('tugasAkhir.penawaranJudul.topik.bidangKeahlian.bidangMinat', 'tugasAkhir.dosenPembimbing.pegawai')->find($id_mahasiswa);

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
            $item = Mahasiswa::with('tugasAkhir.penawaranJudul.topik.bidangKeahlian.bidangMinat', 'tugasAkhir.dosenPembimbing.pegawai', 'tugasAkhir.sidang.ruangan', 'tugasAkhir.sidang.pengujiSidang')->find(Auth::user()->nomor_induk);
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
                $query->orderBy('id_pemberitahuan_mahasiswa', 'DESC');
            }))->find(Auth::user()->nomor_induk)->pemberitahuan;

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
                return Response::json(Mahasiswa::find(Auth::user()->nomor_induk));
            }
            else
            {
                return Response::json(Mahasiswa::where('aktif', '1')->get());
            }
        }
    }


    /**
     * Kelola Pembimbing
     *
     * @return View
     */
    function kelolaPembimbing()
    {
        $statusPembimbing = 'Michael Schumacher';
        View::share('statusPembimbing', $statusPembimbing);
        $daftarProdi = array(
            array('kode' => '0928019824', 'nama' => 'RPL'),
            array('kode' => '0928019824', 'nama' => 'KCV'),
            array('kode' => '0928019824', 'nama' => 'NCC')
        );
        View::share('daftarProdi', $daftarProdi);
        $daftarPembimbing = array(
            array('NIP' => '0928019824', 'nama' => 'Michael Schumacher'),
            array('NIP' => '0928019824', 'nama' => 'Kimi Schumacher'),
            array('NIP' => '0928019824', 'nama' => 'Raphael Schumacher')
        );
        View::share('daftarPembimbing', $daftarPembimbing);
        return View::make('pages.dasbor.pembimbing');
    }

    /**
     * Kelola Penguji
     *
     * @return View
     */
    function kelolaPenguji()
    {
        $statusPenguji = 'Michael Schumacher';
        View::share('statusPenguji', $statusPenguji);
        $daftarProdi = array(
            array('kode' => '0928019824', 'nama' => 'RPL'),
            array('kode' => '0928019824', 'nama' => 'KCV'),
            array('kode' => '0928019824', 'nama' => 'NCC')
        );
        View::share('daftarProdi', $daftarProdi);
        $daftarPenguji = array(
            array('NIP' => '0928019824', 'nama' => 'Michael Raikkonen'),
            array('NIP' => '0928019824', 'nama' => 'Kimi Raikkonen'),
            array('NIP' => '0928019824', 'nama' => 'Raphael Raikkonen')
        );
        View::share('daftarPenguji', $daftarPenguji);
        return View::make('pages.dasbor.penguji');
    }

    /**
     * Kelola Proposal
     *
     * @return View
     */
    function kelolaProposal()
    {
        $proposal = array(
            'nama' => 'Proposal_TA_511110000000.pdf',
            'format' => 'PDF',
            'ukuran' => 45.5
        );
        View::share('proposal', $proposal);
        return View::make('pages.dasbor.proposal');
    }

}
