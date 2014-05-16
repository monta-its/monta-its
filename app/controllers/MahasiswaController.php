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
        $status = array(
            'TA' => 'MAJU SIDANG',
            'Prodi' => 'REKAYASA PERANGKAT LUNAK',
        );

        $profil = array(
            'Nama' => 'Michael Schumacher',
            'NRP' => '5111100000',
            'TopikTA' => 'Simulasi',
            'JudulTA' => 'Aplikasi Simulasi Pembalap F1',
            'DeskripsiTA' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in',
            'Pembimbing' => 'Kimi Räikkönen',
            'Penguji' => 'Fernando Alonso',
            'Mulai' => '1 Januari 2013',
            'Selesai' => '2 Januari 2013',

        );

        View::share('status', $status);
        View::share('profil', $profil);
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
