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
use Simta\Models\Lampiran;
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

        $items = Panduan::with('person')->get();

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
        $item = Panduan::with('person')->find($id_panduan);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('panduan'), 'text' => 'Panduan'),
            array('link' => '', 'text' => $item->judul_panduan),
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
                return Response::json(Panduan::with('lampiran')->where('nip', Auth::user()->person_id)->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            // https://github.com/symfony/symfony/issues/10541
            // From what I got from there, we should not use PUT for File Upload purposes.
            // Unfortunately, this is some kind of bad news from the aspect of REST-based data-editing
            //
            // "POST" normal operation with file uploading is work flawlessly, and I am kind of lazy to restructure this code,
            // So I decided to use "POST" operation also for editing/update purpose if it need to upload a file.
            //
            // Putu Wiramaswara Widya

            $permitToEdit = Input::get('_permit_to_edit');
            if($permitToEdit == true)
            {
                $panduan = Panduan::where('nip', Auth::user()->person_id)->find(Input::get('id_panduan'));
                $pegawai = Pegawai::find(Auth::user()->person_id);
                $lampiran = $panduan->lampiran()->first();
            }
            else
            {
                $panduan = new Panduan;
                $lampiran = new Lampiran;
                $pegawai = Pegawai::find(Auth::user()->person_id);
            }

            if($pegawai != null)
            {
                $panduan->judul_panduan = Input::get('judul_panduan');
                $panduan->isi_panduan = Input::get('isi_panduan');
                if(Input::file())
                {
                    // Unfortunately, multipart/form-data based form data doesn't work well in complex structure, so this is the patch-fix solution
                    $data_lampiran = json_decode(Input::get('lampiran'));
                    $lampiran->nama_lampiran = $data_lampiran->nama_lampiran;
                    $lampiran->tipe_lampiran = $data_lampiran->tipe_lampiran;
                }
                else
                {
                    $lampiran->nama_lampiran = Input::get('lampiran.nama_lampiran');
                    $lampiran->tipe_lampiran = Input::get('lampiran.tipe_lampiran');
                }

                if($lampiran->tipe_lampiran == 'url')
                {
                    $lampiran->path_lampiran = Input::get('lampiran.path_lampiran');
                }
                else if($lampiran->tipe_lampiran == 'file')
                {
                    if(Input::file('file'))
                    {
                        $filename = Input::file('file')->getClientOriginalName();
                        Input::file('file')->move('public/files/'.$pegawai->nip.'/', $filename);
                        $lampiran->path_lampiran = $filename;
                    }
                }
                $lampiran->save();
                $panduan->person()->associate($pegawai);
                $panduan->lampiran()->associate($lampiran);
                $panduan->save();

            }

        }
        else if(Request::isMethod('put'))
        {
            $panduan = Panduan::where('nip', Auth::user()->person_id)->find(Input::get('id_panduan'));
            $pegawai = Pegawai::find(Auth::user()->person_id);
            $lampiran = $panduan->lampiran()->first();
            if($pegawai != null)
            {
                $panduan->judul_panduan = Input::get('judul_panduan');
                $panduan->isi_panduan = Input::get('isi_panduan');
                $lampiran->nama_lampiran = Input::get('lampiran.nama_lampiran');
                $lampiran->tipe_lampiran = Input::get('lampiran.tipe_lampiran');
                $lampiran->path_lampiran = Input::get('lampiran.path_lampiran');
                $lampiran->save();
                $panduan->person()->associate($pegawai);
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
