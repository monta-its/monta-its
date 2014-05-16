<?php
/**
 * PenggunaController
 * Handle everything under "/judul" and "/dasbor/judul" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\PenggunaController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\User;

class PenggunaController extends BaseController {
    /**
     * Tampilkan Pengguna Mahasiswa Secara Umum
     *
     * @return View
     */
    public function borangTambahPenggunaMahasiswa()
    {
        return View::make('pages.dasbor.pengguna.mahasiswa.tambah');
    }

    /**
     * Tampilkan borang penambahan pengguna mahasiswa
     *
     * @return View
     */
    public function tambahPenggunaMahasiswa()
    {
        $nrp_mahasiswa = Input::get ('nrp_mahasiswa');
        $nama_mahasiswa = '';
        if (!is_array($nrp_mahasiswa))
        {
            $nama_mahasiswa = Input::get ('nama_mahasiswa');
            View::share('pesan', $nama_mahasiswa . ' (' . $nrp_mahasiswa . ')');
        }
        else
        {
            View::share('pesan', count($nrp_mahasiswa) . ' mahasiswa');
        }

        return View::make('pages.dasbor.pengguna.mahasiswa.tambah_sukses');
    }

    /**
     * Tampilkan Daftar Calon Pengguna Mahasiswa yang telah memenuhi syarat untuk masuk ke SIMTA
     *
     * @return View
     */
    public function lihatSemuaCalonPenggunaMahasiswa()
    {
        $l_item = array(
            array(
                'nrp_mahasiswa' => '1234567890',
                'nama_mahasiswa' => 'Nama Calon Mahasiswa',
                'sks_lulus' => 'xx',
                'sks_tempuh' => 'yy'
            ),
            array(
                'nrp_mahasiswa' => '1234567890',
                'nama_mahasiswa' => 'Nama Calon Mahasiswa',
                'sks_lulus' => 'xx',
                'sks_tempuh' => 'yy'
            ),
            array(
                'nrp_mahasiswa' => '1234567890',
                'nama_mahasiswa' => 'Nama Calon Mahasiswa',
                'sks_lulus' => 'xx',
                'sks_tempuh' => 'yy'
            )
        );
        View::share('l_item', $l_item);
        return View::make('pages.dasbor.pengguna.mahasiswa.calon');
    }

    /**
     * Tampilkan Hasil Pencarian Calon Pengguna Mahasiswa yang telah memenuhi syarat untuk masuk ke SIMTA
     *
     * @return View
     */
    public function lihatHasilPencarianCalonPenggunaMahasiswa()
    {
        $item = array(
            'nama_mahasiswa' => 'Nama Mahasiswa',
            'nrp_mahasiswa' => '1234567890',
            'id_mahasiswa' => '0987654321',
            'nama_dosen_wali' => 'Nama Dosen Wali',
            'id_dosen_wali' => 'id_dosen',
            'sks_lulus' => '82',
            'sks_tempuh' => '100'
        );
        View::share('item', $item);
        return View::make('pages.dasbor.pengguna.mahasiswa.cari');
    }
}
