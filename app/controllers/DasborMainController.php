<?php
/**
 * Controller pada /dasbor
 * Hanya menentukan apakah akan masuk /dasbor/mahasiswa, /dasbor/pegawai atau /dasbor/dosen
 *
 * @package Simta\Controllers\DasborMainController
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 */

namespace Simta\Controllers;

use Redirect;
use Auth;
use BaseController;
class DasborMainController extends BaseController {
    /**
     * Penentu masuknya dasbor sesuai peran
     *
     * @return Redirect
     */
    function tentukanDasborMana()
    {
        $user = Auth::user();
        if($user->peran == 0)
        {
            return Redirect::to('dasbor/mahasiswa');
        }
        else if($user->peran == 1)
        {
            return Redirect::to('dasbor/pegawai');
        }
        else if($user->peran == 2)
        {
            return Redirect::to('dasbor/dosen');
        }
    }
}
