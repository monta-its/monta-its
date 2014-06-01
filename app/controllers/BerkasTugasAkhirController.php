<?php
/**
 * BerkasTugasAkhirController
 * Mengelola proses dalam rute /dasbor/mahasiswa/berkas
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Controllers\BerkasTugasAkhirController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use File;
use Input;
use Redirect;
use Request;
use Response;
use Simta\Models\BerkasTugasAkhir;
use Simta\Models\TugasAkhir;
use Simta\Models\Mahasiswa;
use Auth;

class BerkasTugasAkhirController extends BaseController {

    /* Kelompok dasbor */

    /**
     * Kelola BerkasTugasAkhir berbasis REST
     * @return View
     */
    function kelolaBerkasTugasAkhir()
    {
        $auth = Auth::user();
        $mahasiswa = Mahasiswa::find($auth->nomor_induk);


        // GET: Mengambil daftar berkas tugas akhir dari mahasiswa bersangkutan
        if($mahasiswa != null)
        {
            if(Request::isMethod('get'))
            {
                if(!Request::ajax())
                {
                    return View::make('pages.dasbor.berkas.index');
                }
                else
                {
                    $tugasAkhir = $mahasiswa->tugasAkhir()->get();
                    $berkas = array();
                    foreach($tugasAkhir as $ta)
                    {
                        foreach($ta->berkas()->get() as $b)
                        {
                            $berkas[] = $b->toArray();
                        }
                    }
                    return Response::json($berkas);
                }

            }
            else if(Request::isMethod('post'))
            {
                $tugasAkhir = $mahasiswa->tugasAkhir()->find(Input::get('id_tugas_akhir'));
                if($tugasAkhir != null)
                {
                    $berkas = new BerkasTugasAkhir;
                    $berkas->jenis_berkas = Input::get('jenis_berkas');
                    if(Input::file('file'))
                    {
                        $filename = Input::file('file')->getClientOriginalName();
                        $path = 'public/files/berkas/'.Input::get('id_tugas_akhir').'/';
                        Input::file('file')->move($path, $filename);
                        $berkas->nama_berkas = $filename;
                        $berkas->path = 'files/berkas/'.Input::get('id_tugas_akhir').'/'.$filename;
                        $berkas->save();
                        $tugasAkhir->berkas()->save($berkas);
                    }

                }

            }
            else if(Request::isMethod('delete'))
            {
                $berkas = BerkasTugasAkhir::find(Input::get('id_berkas_tugas_akhir'));
                File::delete('public/'.$berkas->path);
                $berkas->delete();
            }
        }
    }


}
