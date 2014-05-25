<?php
/**
 * SyaratController
 * Mengelola persyaratan mahasiswa. Fitur ini dapat diakses oleh petugas jurusan.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\SyaratController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Syarat;
use Auth;

class SyaratController extends BaseController {
    /**
     * Cari persyaratan berdasarkan NRP Mahasiswa
     * @return View
     */
    function cariSyarat()
    {
        return View::make('pages.dasbor.syarat.cari');
    }

    /**
     * Kelola persyaratan Mahasiswa
     *
     * @var string $nrp_mahasiswa
     * @return View
     */
    function kelolaSyaratMahasiswa($nrp_mahasiswa)
    {
        return View::make('pages.dasbor.syarat.item');
    }

}
