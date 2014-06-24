<?php
/**
 * TerlarangController
 * Mengelola laman Terlarang.
 * 
 * Laman terlarang menampilkan pesan yang sebelumnya 
 * telah disimpan dalam Session. Oleh karena itu,
 * set variabel 'page_title' dan 'message' ke dalam
 * Session sebelum redirect ke rute yang mengarah 
 * ke class ini (/terlarang)
 * 
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\TerlarangController
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
use Session;

class TerlarangController extends BaseController {
    public function index ()
    {
        $page_title = Session::get('page_title');
        $message = Session::get('message');
        if ($page_title == null)
        {
            $page_title = 'Terlarang';            
        }
        if ($message == null)
        {
            $message = 'Anda tidak berhak mengakses laman ini.';            
        }
        View::share('page_title', $page_title);
        View::share('message', $message);
        return View::make('pages.terlarang.index');
    }

    public function dasborTerlarang ()
    {
        $page_title = Session::get('page_title');
        $message = Session::get('message');
        Session::remove('page_title', 'message');
        if ($page_title == null)
        {
            $page_title = 'Terlarang';            
        }
        if ($message == null)
        {
            $message = 'Anda tidak berhak mengakses laman ini.';            
        }
        View::share('page_title', $page_title);
        View::share('message', $message);
        return View::make('pages.dasbor.terlarang.index');
    }
}