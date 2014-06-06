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
                if(Input::has('sesi') && Input::has('tanggal'))
                {
                    $ruangan = Ruangan::get();
                    $tanggal = Input::get('tanggal');
                    $sesi = Input::get('sesi');
                    $result = array();
                    foreach($ruangan as $r)
                    {
                        if($r->apakahTersediaRuangan($tanggal, $sesi))
                        {
                            $result[] = $r->toArray();
                        }
                    }

                    return Response::json($result);
                }
                else
                {
                    return Response::json(Ruangan::get());
                }
            }

        }
    }


}
