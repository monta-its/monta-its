<?php
/**
 * TerlarangController
 * Handle everything under "/berita" route
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
        return View::make('pages.dasbor.terlarang.index');
    }
}