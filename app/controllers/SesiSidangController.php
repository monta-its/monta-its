<?php
/**
 * Handle SesiSidang model manipulation
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Controllers\SesiSidangController
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
use Simta\Models\SesiSidang;
use Auth;

class SesiSidangController extends BaseController {
    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor SesiSidang, berbasiskan mekanisme REST
     * Akses sudah diamankan dari rute (kecuali GET), jadi tidak perlu mekanisme filtrasi lagi pada implementasi.
     *
     * @return View
     */
    function dasborSesiSidang()
    {
        
        $pesan = '';
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.sesi_sidang.index');
            }
            else
            {
                return Response::json(SesiSidang::get());
            }
        }
        else if(Request::isMethod('post'))
        {
            if (SesiSidang::find(Input::get('sesi')) == null)
            {
                $sesiSidang = new SesiSidang;
                $sesiSidang->fill(Input::get());
                $sesiSidang->save();
                $pesan = 'Penambahan data berhasil.';
            }
            else
            {
                $pesan = 'Nomor sesi sudah ada. Penyimpanan data dibatalkan.';
            }
            
        }
        else if(Request::isMethod('put'))
        {
            $sesiSidang = SesiSidang::find(Input::get('sesi'));
            if ($sesiSidang != null)
            {
                $sesiSidang->fill(Input::get());
                $sesiSidang->save();
                $pesan = 'Perubahan data berhasil disimpan.';
            }
            else
            {
                $pesan = 'Data Sesi Sidang tidak ditemukan. Penyimpanan data dibatalkan.';
            }
        }
        else if(Request::isMethod('delete'))
        {
            $sesiSidang = SesiSidang::find(Input::get('sesi'));
            if ($sesiSidang != null)
            {
                $sesiSidang->forceDelete();
                $pesan = 'Penghapusan data berhasil.';
            }
            else
            {
                $pesan = 'Data Sesi Sidang tidak ditemukan. Penghapusan data dibatalkan.';
            }
        }
        return Response::json(array('pesan' => $pesan));
    }
}
