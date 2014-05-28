<?php
/**
 * RuanganController
 * Mengelola proses dalam rute /dasbor/pegawai/ruangan
 *
 * @author Putu Wiramaswara Widya <wiramawara11@mhs.if.its.ac.id>
 * @package Simta\Controllers\RuanganController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Auth;
use Simta\Models\Ruangan;

class RuanganController extends BaseController {
    /* Kelompok dasbor */

    /**
     * Kelola Ruangan berbasis REST
     * @return View
     */
    function dasborRuangan()
    {

        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.ruangan.index');
            }
            else
            {
                return Response::json(Ruangan::get());
            }

        }
    }


}
