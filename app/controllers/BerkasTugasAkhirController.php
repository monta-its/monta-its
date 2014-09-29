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
        
        $mahasiswa = Mahasiswa::find(Auth::user()->person_id);
        $pesan = '';
        
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
                        $path = 'files/berkas/'.Input::get('id_tugas_akhir').'/';
                        $berkas->path = $path . $filename;
                        $berkas->nama_berkas = $filename;
                        $berkas->save();
                        
                        if (File::exists($berkas->path))
                        {
                            $pesan = 'Ada berkas dengan nama berkas yang sama. Berkas tersimpan dengan nama perubahan nama.';
                            $ekstensi = Input::file('file')->getClientOriginalExtension();
                            $filename = str_replace('.' . $ekstensi , '', $filename);
                            $filename = $filename . $berkas->created_at . '.' . $ekstensi;
                            $filename = str_replace(':', '', $filename);
                            $berkas->nama_berkas = $filename;
                            $berkas->path = $path . $filename;
                            $berkas->save();
                        }
                        else
                        {
                            $pesan = 'Berkas berhasil disimpan.';
                        }

                        // Save file to specific $path, named it with $filename
                        Input::file('file')->move($path, $filename);
                        $tugasAkhir->berkas()->save($berkas);
                    }
                    else
                    {
                        $pesan = 'Terjadi masalah saat proses pengunggahan berkas. Operasi dibatalkan.';
                    }
                }
                else
                {
                    $pesan = 'Data Tugas Akhir tidak ditemukan. Penyimpanan berkas dibatalkan.';
                }
            }
            else if(Request::isMethod('delete'))
            {
                $berkas = BerkasTugasAkhir::find(Input::get('id_berkas_tugas_akhir'));
                if ($berkas != null)
                {
                    if (File::exists($berkas->path))
                    {
                        File::delete($berkas->path);
                        $pesan = "Penghapusan berkas berhasil.";
                    }
                    else
                    {
                        $pesan = 'Berkas tidak ditemukan di sistem berkas. Data berkas telah dihapus. Namun, ada kemungkinan berkas masih tersimpan di sistem berkas.';
                    }
                    $berkas->delete();
                }
                else
                {
                    $pesan = 'Data berkas tidak ditemukan. Penghapusan berkas dibatalkan.';
                }
            }
        }
        else 
        {
            $pesan = 'Data mahasiswa tidak ditemukan. Operasi berkas dibatalkan.';
        }

        return Response::json(array('pesan' => $pesan));
    }
}
