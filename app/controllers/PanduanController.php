<?php
/**
 * PanduanController
 * Handle everything under "/panduan" and "/dasbor/panduan" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\PanduanController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\Panduan;
use Simta\Models\Pegawai;
use Request;
use Response;
use Auth;

class PanduanController extends BaseController {


    /**
     * Tampilkan Panduan Secara Umum
     *
     * @return View
     */
    public function lihatSemuaPanduan()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Panduan')
        );

        $items = Panduan::get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.panduan.index');
    }


    /**
     * Tampilkan Isi Panduan
     *
     * @var string $id_panduan
     * @return View
     */
    function lihatIsiPanduan($id_panduan)
    {
        $item = Panduan::find($id_panduan);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('panduan'), 'text' => 'Panduan'),
            array('link' => '', 'text' => $item->judul),
        );


        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.panduan.item');
    }



    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor Panduan, berbasiskan mekanisme REST
     * @return View
     */
    function dasborPanduan()
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.panduan.index');
            }
            else
            {
                return Response::json(Panduan::with('pegawai')->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $panduan = new Panduan;
            $pegawai = Pegawai::find(Auth::User()->nomor_induk);
            if($pegawai != null)
            {
                $panduan->judul = Input::get('judul');
                $panduan->isi = Input::get('isi');
                $panduan->lampiran = Input::get('lampiran');
                $panduan->pegawai()->associate($pegawai);
                $panduan->save();
            }

        }
        else if(Request::isMethod('put'))
        {
            $panduan = Panduan::find(Input::get('id_panduan'));
            $pegawai = Pegawai::find(Auth::User()->nomor_induk);
            if($pegawai != null)
            {
                $panduan->judul = Input::get('judul');
                $panduan->isi = Input::get('isi');
                $panduan->lampiran = Input::get('lampiran');
                $panduan->pegawai()->associate($pegawai);
                $panduan->save();
            }

        }
        else if(Request::isMethod('delete'))
        {
            $panduan = Panduan::find(Input::get('id_panduan'));
            $panduan->delete();
        }
    }
}
