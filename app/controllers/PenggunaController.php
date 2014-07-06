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
use DB;
use Hash;
use Redirect;
use Simta\Models\User;
use Simta\Models\Mahasiswa;

class PenggunaController extends BaseController {
    private $tabel_mahasiswa = '_BAHAN_MONTA_MAHASISWA';
    private $tabel_pegawai = '_BAHAN_MONTA_PEGAWAI';
    private $tabel_kuliah = '_BAHAN_MONTA_KULIAH';

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
     * Menyimpan data model Mahasiswa yang diambil dari SIAKAD
     * berdasarkan nrp_mahasiswa yang diperoleh dari Input method POST.
     *
     * Password default adalah sama dengan NRP mahasiswa.
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
            $berhasil = 0;
            foreach ($nrp_mahasiswa as $nrp) 
            {
                $result = DB::connection('sqlsrv')->select('select MA_Nrp nrp_mahasiswa, MA_Nama nama_lengkap, MA_TglMasukITS tanggal_masuk from ' . $this->tabel_mahasiswa . ' where MA_Nrp = ?', array($nrp));

                if (count($result) == 1)
                {
                    $data = $result[0];
                    Mahasiswa::create(
                        array(
                            'nrp_mahasiswa' => $data->nrp_mahasiswa,
                            'nama_lengkap' => $data->nama_lengkap,
                            'kata_sandi' => Hash::make($data->nrp_mahasiswa),
                            'angkatan' => date('Y', strtotime($data->tanggal_masuk))
                        )
                    );
                    $berhasil++;
                }
            }

            View::share('pesan', count($berhasil) . ' mahasiswa');
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
        /**
         * $l_item
         * Daftar mahasiswa yang memenuhi syarat:
         *
         * Mahasiswa Reguler
         * - lulus > 95 SKS
         * - IPK >= 2
         * - Lulus / Sedang Mengambil PEM
         * - Sedang menempuh PBS ke-2 atau lebih
         *
         * Mahasiswa Lintas Jalur
         * - Lulus matrikulasi
         * - Sedang menempuh PBS ke-1 
         * 
         * @var array
         */
        
        $l_item = DB::connection('sqlsrv')->select('select MA_Nrp nrp_mahasiswa, MA_Nama nama_mahasiswa, MA_SksLulus sks_lulus, MA_SKSTempuh sks_tempuh from ' . $this->tabel_mahasiswa . ' where ma_skslulus>95 and ma_ipk>=2');
        
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
