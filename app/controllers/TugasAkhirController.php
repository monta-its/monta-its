<?php
/**
 * TugasAkhirController
 * Mengelola Tugas Akhir dan relasinya terhadap Dosen dan Mahasiswa
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\TugasAkhirController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;
use Simta\Models\Dosen;
use Auth;

class TugasAkhirController extends BaseController {
    /**
     * Mengelola data Tugas Akhir yang dibimbing oleh Dosen tertentu.
     *
     * @return View
     */
    function bimbingan()
    {
        return View::make('pages.dasbor.bimbingan.index');
    }

    /**
     * Menampilkan profil Tugas Akhir mahasiswa
     *
     * @var string $id_tugas_akhir
     * @return View
     */
    function profilBimbingan($id_tugas_akhir)
    {
        return View::make('pages.dasbor.bimbingan.item');
    }
}