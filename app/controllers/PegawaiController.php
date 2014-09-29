<?php
/**
 * PegawaiController
 * Mengelola fitur-fitur yang bisa diakses oleh Pegawai sebagai petugas jurusan
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\PegawaiController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Pegawai;
use Auth;

class PegawaiController extends BaseController {
    /**
     * Dasbor Pegawai
     * @return View
     */
    function dasborPegawai()
    {
        $pemberitahuan = Pegawai::with(array('pemberitahuan' => function($query)
        {
            $query->orderBy('id_pemberitahuan', 'DESC');
        }))->find(Auth::user()->person_id)->pemberitahuan;
        View::share('pemberitahuan', $pemberitahuan);

        return View::make('pages.dasbor.pegawai.index');
    }

}
