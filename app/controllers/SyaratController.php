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
     * Dasbor Syarat
     * Penentuan apakah syarat mahasiswa bersangkutan telah dipenuhi
     * @return View
     */
    function dasborSyarat($nrp_mahasiswa = null)
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.syarat.index');
            }
            else
            {
                if($nrp_mahasiswa)
                {
                    $syarat = Mahasiswa::with('syarat')->where('mahasiswa.nrp_mahasiswa', $nrp_mahasiswa)->first();
                    return Response::json($syarat);
                }
                else
                {
                    $syarat = Syarat::get();
                    return Response::json($syarat);
                }
            }
        }
        else if(Request::isMethod('post') || Request::isMethod('put'))
        {
            // Post/Put means check
            $mahasiswa = Mahasiswa::with('syarat')->find($nrp_mahasiswa);
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
            $mahasiswa = Mahasiswa::with('syarat')->find($nrp_mahasiswa);
            if($mahasiswa != null)
            {
                if($mahasiswa->syarat->contains(Input::get('id_syarat')))
                {
                    $mahasiswa->syarat()->detach(Input::get('id_syarat'));
                }
            }
        }
    }


}
