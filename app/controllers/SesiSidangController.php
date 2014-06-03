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
        $auth = Auth::user();
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
        else if(Request::isMethod('post') || Request::isMethod('put'))
        {
            if(Request::isMethod('post'))
            {
                $sesiSidang = new SesiSidang;
            }
            else if(Request::isMethod('put'))
            {
                $sesiSidang = SesiSidang::find(Input::get('sesi'));
            }

            $sesiSidang->fill(Input::get());
            $sesiSidang->save();
        }
        else if(Request::isMethod('delete'))
        {
            $sesiSidang = SesiSidang::find(Input::get('sesi'));
            $sesiSidang->delete();
        }
    }




}
