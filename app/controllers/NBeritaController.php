<?php
/**
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BeritaController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\Pos;
use Simta\Models\Pegawai;
use Auth;

class NBeritaController extends BaseController {
    public function index()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Berita')
        );

        $items = Pos::with('person')->where('apakah_terbit', '=', 1)->orderBy('updated_at')->get();
        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.n.berita.index');
    }
    public function detail($id_berita)
    {
        $item = Pos::with('person')->find($id_berita);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/berita'), 'text' => 'Berita'),
            array('link' => '', 'text' => $item->judul)
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.n.berita.detail');
    }
    public function manage()
    {
    }
    public function create()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
