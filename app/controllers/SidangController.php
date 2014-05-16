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
use Simta\Models\Sidang;

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
     * Tampilan laman kelola sidang yang dibuat pada dasbor
     * @return View
     */
    function dasborKelolaSidang()
    {
        return View::make('pages.dasbor.sidang.index');
    }

    /**
     * Tambahkan sidang baru. Menampilkan laman penambahan sidang.
     *
     * @return View
     */
    function dasborTambahkanSidang()
    {
        return View::make('pages.dasbor.sidang.baru');
    }

    /**
     * Simpan sidang baru.
     *
     * @return View
     */
    function dasborSimpanSidangBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/sidang');
    }

    /**
     * Sunting sidang
     *
     * @var string $id_sidang
     * @return View
     */
    function dasborSuntingSidang($id_sidang)
    {
        return View::make('pages.dasbor.sidang.sunting');
    }

    /**
     * Simpan sidang yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanSidang()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/sidang');
    }

    /**
     * Hapus sidang
     *
     * @var string $id_sidang
     * @return View
     */
    function dasborHapusSidang($id_sidang)
    {
        return Redirect::to('dasbor/sidang');
    }
}
