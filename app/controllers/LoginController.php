<?php
/**
 * Mengelola proses login dan Logout
 *
 * @package Simta\Controllers\LoginController
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 */

namespace Simta\Controllers;

use Input;
use Auth;
use View;
use URL;
use Request;
use Redirect;
use BaseController;

class LoginController extends BaseController {
    /**
     * Menampilkan halaman login
     * @return View
     */
    function lihatLamanLogin()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Login')
        );

        View::share('breadcrumbs', $breadcrumbs);
        return View::make('pages.login.index');
    }

    /**
     * Melakukan proses login
     * @return View
     */
    function lakukanProsesLogin()
    {
        if(Auth::guest())
        {
            return Redirect::to('login');
        }

        $username = Input::get('username');
        $password = Input::get('password');
        if(Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            // Proses login berhasil, arahakan ke laman dasbor
            return Redirect::to('dasbor');
        }
        else
        {
            return Redirect::to('login');
        }
    }

    /**
     * Melakukan proses logout
     * @return View
     */
    function lakukanProsesLogout()
    {
        if(Auth::guest())
        {
            return Redirect::to('login');
        }
        
        Auth::logout();
        return Redirect::to('login');
    }

}
