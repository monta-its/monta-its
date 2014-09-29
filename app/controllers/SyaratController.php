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
use Simta\Models\Mahasiswa;
use Auth;

class SyaratController extends BaseController {
    /**
     * Dasbor Centang Syarat Mahasiswa
     * Penentuan apakah syarat mahasiswa bersangkutan telah dipenuhi
     * @return View
     */
    function dasborCentangSyarat($nrp = null)
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.syarat_mahasiswa.index');
            }
            else
            {
                if($nrp)
                {
                    $syarat = Mahasiswa::with('syarat')->where('mahasiswa.nrp', $nrp)->first();
                    return Response::json($syarat);
                }
                else
                {
                    return Response::json(array());
                }
            }
        }
        else if(Request::isMethod('post') || Request::isMethod('put'))
        {
            // Post/Put means check
            $mahasiswa = Mahasiswa::with('syarat')->find($nrp);
            if($mahasiswa != null)
            {
                if(!$mahasiswa->syarat->contains(Input::get('id_syarat')))
                {
                    $mahasiswa->syarat()->attach(Input::get('id_syarat'));
                }
            }
        }
        else if(Request::isMethod('delete'))
        {

            // Delete means uncheck
            $mahasiswa = Mahasiswa::with('syarat')->find($nrp);
            if($mahasiswa != null)
            {
                if($mahasiswa->syarat->contains(Input::get('id_syarat')))
                {
                    $mahasiswa->syarat()->detach(Input::get('id_syarat'));
                }
            }
        }
    }


    /**
     * Dasbor Kelola Daftar Syarat yang tersedia
     *
     * @return View
     */
    public function dasborKelolaSyarat()
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.syarat.index');
            }
            else
            {
                return Response::json(Syarat::get());
            }
        }
        else if(Request::isMethod('post') || Request::isMethod('put'))
        {
           if(Request::isMethod('post'))
           {
               $syarat = new Syarat;
           }
           else
           {
               $syarat = Syarat::find(Input::get('id_syarat'));
           }

           $syarat->fill(Input::get());
           $syarat->save();
        }
        else if(Request::isMethod('delete'))
        {
           $syarat = Syarat::find(Input::get('id_syarat'));
           $syarat->delete();
        }
    }


}
