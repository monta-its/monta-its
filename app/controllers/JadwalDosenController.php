<?php
/**
 * Handle JadwalDosen model manipulation
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Controllers\JadwalDosenController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Dosen;
use Simta\Models\JadwalDosen;
use Auth;

class JadwalDosenController extends BaseController {
    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor JadwalDosen, berbasiskan mekanisme REST
     * Akses sudah diamankan dari rute (kecuali GET), jadi tidak perlu mekanisme filtrasi lagi pada implementasi.
     *
     * @return View
     */
    function dasborJadwalDosen()
    {
        
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.jadwal.index');
            }
            else
            {
                if(Input::has('mySelf'))
                {
                    $dosen = Dosen::find(Auth::user()->person_id);
                    return Response::json($dosen->jadwalDosen()->get());
                }
                else
                {
                    return Response::json(JadwalDosen::get());
                }
            }
        }
        else if(Request::isMethod('post') || Request::isMethod('put'))
        {
            // Insert or update?
            $dosen = Dosen::find(Auth::user()->person_id);
            $jadwalDosen = $dosen->jadwalDosen()->where('hari', Input::get('hari'))->where('sesi', Input::get('sesi'));
            if($jadwalDosen->count() == 0)
            {
                $jadwalDosen = new JadwalDosen;
            }
            else
            {
                $jadwalDosen = $jadwalDosen->first();
            }


            $jadwalDosen->dosen()->associate($dosen);
            $jadwalDosen->fill(Input::get());
            $jadwalDosen->save();
        }
        else if(Request::isMethod('delete'))
        {
            $jadwalDosen = JadwalDosen::find(Input::get('id_jadwal_dosen'));
            $jadwalDosen->delete();
        }
    }




}
