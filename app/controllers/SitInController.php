<?php
/**
 * SitInController
 * Mengelola proses dalam rute /dasbor/sit_in
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\SitInController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\SitIn;

class SitInController extends BaseController {
    /**
     * Tampilkan laman sit in
     *
     * @return View
     */
    public function lihatLamanSitIn()
    {
        $item = array(

        );
        View::share('item', $item);
        return View::make('pages.dasbor.sit_in.index');
    }    
}
