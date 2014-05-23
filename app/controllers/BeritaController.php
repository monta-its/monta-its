<?php
/**
 * BeritaController
 * Handle everything under "/berita" route
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
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

class BeritaController extends BaseController {
    /**
     * Tampilkan Berita Secara Umum
     *
     * @return View
     */
	public function lihatSemuaBerita()
	{
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Berita')
        );

        $items = Pos::with('pegawai')->get();
        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.berita.index');
	}


    /**
     * Tampilkan Isi Berita
     *
     * @var string $id_berita
     * @return View
     */
    function lihatIsiBerita($id_berita)
    {
        $item = Pos::with('pegawai')->find($id_berita);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/berita'), 'text' => 'Berita'),
            array('link' => '', 'text' => $item->judul)
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.berita.item');
    }


    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor Berita, berbasiskan mekanisme REST
     * @return View
     */
    function dasborBerita()
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.berita.index');
            }
            else
            {
                return Response::json(Pos::with('pegawai')->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $berita = new Pos;
            $pegawai = Pegawai::find(Auth::User()->nomor_induk);
            if($pegawai != null)
            {
                $berita->judul = Input::get('judul');
                $berita->isi = Input::get('isi');
                $berita->apakah_terbit = Input::get('apakah_terbit');
                $berita->pegawai()->associate($pegawai);
                $berita->save();
            }

        }
        else if(Request::isMethod('put'))
        {
            $berita = Pos::find(Input::get('id_pos'));
            $pegawai = Pegawai::find(Auth::User()->nomor_induk);
            if($pegawai != null)
            {
                $berita->judul = Input::get('judul');
                $berita->isi = Input::get('isi');
                $berita->apakah_terbit = Input::get('apakah_terbit');
                $berita->pegawai()->associate($pegawai);
                $berita->save();
            }

        }
        else if(Request::isMethod('delete'))
        {
            $berita = Pos::find(Input::get('id_pos'));
            $berita->delete();
        }
    }




}
