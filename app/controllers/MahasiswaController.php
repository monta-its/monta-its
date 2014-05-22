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
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/mahasiswa'), 'text' => 'Mahasiswa'),
            array('link' => '', 'text' => 'Profil')
        );

        $item = array(
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'nrp_mahasiswa' => '1234567890',
            'id_mahasiswa' => '0987654321',
            'nama_dosen' => 'Nama Dosen Pembimbing',
            'id_dosen' => 'id_dosen',
            'judul_topik' => 'Judul Topik TA',
            'id_topik' => 'id_topik',
            'judul_judul' => 'Judul Judul TA',
            'id_judul' => 'id_judul'
        );
        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.mahasiswa.item');
    }

    /* Kelompok dasbor */

    /**
     * Tampilan laman dasbor awal untuk mahasiswa.
     * @return View
     */
    function dasborMahasiswa()
    {
        $item = Mahasiswa::with('tugasAkhir.penawaranJudul.topik.bidangKeahlian.bidangMinat', 'tugasAkhir.dosenPembimbing.pegawai', 'tugasAkhir.sidang.ruangan', 'tugasAkhir.sidang.pengujiSidang')->find(Auth::user()->nomor_induk);
        $tugasAkhir = null;
        $sidang = null;
        $pemberitahuan = null;

        if ($item->tugasAkhir != null)
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
        return View::make('pages.dasbor.index');
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
