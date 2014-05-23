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
use Request;
use Response;
use Auth;
use Simta\Models\TeknikMesin\SitIn;
use Simta\Models\Mahasiswa;
use Simta\Models\Dosen;
use Simta\Models\Pegawai;
use Simta\Models\PemberitahuanPegawai;
use Simta\Models\PemberitahuanMahasiswa;

class SitInController extends BaseController {
    /**
     * Dasbor SitIn Mahasiswa berbasis REST
     *
     * @return View
     */
    public function dasborSitInMahasiswa()
    {

        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.sit_in.mahasiswa');
            }
            else
            {
                return Response::json(SitIn::with('mahasiswa', 'dosen', 'dosen.pegawai')->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $dosen = Dosen::find(Input::get('dosen.nip_dosen'));
            $auth = Auth::user();
            $mahasiswa = null;
            if($auth != null)
            {
                if($auth->peran == 0)
                {
                    $mahasiswa = Mahasiswa::find($auth->nomor_induk);
                    // Pre Insertion Detection
                    // Apakah sudah memiliki Sitin yang disetujui?
                    if(SitIn::where('nrp_mahasiswa', $auth->nomor_induk)->where('status', '1')->get()->count() >= 1)
                    {
                        return Response::json(array('galat' => 'Anda sudah memiliki sebuah sitin yang disetujui. Untuk melakukan sitin ulang, Anda tidak dapat menambahkan/membatalkan Sitin tersebut.'));
                    }

                    // Apakah ada Sitin belum status dengan dosen bersangkutan?
                    if(SitIn::where('nip_dosen', Input::get('dosen.nip_dosen'))->where('nrp_mahasiswa', $auth->nomor_induk)->get()->count() != 0)
                    {
                        return Response::json(array('galat' => 'Anda sudah memiliki Sitin dengan dosen bersangkutan.'));
                    }

                    // Apakah Sitin sudah ada dua yang belum status
                    if(SitIn::where('nrp_mahasiswa', $auth->nomor_induk)->get()->count() >= 2)
                    {
                        return Response::json(array('galat' => 'Anda sudah memiliki dua Sitin.'));
                    }


                    if($mahasiswa != null and $dosen != null)
                    {
                        $sitIn = new Sitin;
                        $sitIn->dosen()->associate($dosen);
                        $sitIn->mahasiswa()->associate($mahasiswa);
                        $sitIn->status = 0;
                        $sitIn->save();

                        // Membuat pemberitahuan ke Dosen bersankutan
                        $pemberitahuan = new PemberitahuanPegawai;
                        $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp_mahasiswa." memerlukan persetujuan Anda untuk menyetujui Sitin.";
                        $pemberitahuan->pegawai()->associate($dosen->pegawai()->first());
                        $pemberitahuan->save();
                    }
                }
            }

        }
        else if(Request::isMethod('put'))
        {
            // Hanya bisa diakses oleh dosen
            // Digunakan untuk proses persetujuan
            $sitIn = SitIn::with('mahasiswa', 'dosen')->find(Input::get('id_sit_in'));
            $auth = Auth::user();
            if($auth != null)
            {
                if($auth->peran == 2 || $auth->peran == 3)
                {
                    $sitIn->status = 1;
                    $sitIn->save();

                    // Batalkan Sitin yang sama dari dosen lainnya
                    $sitInLainnya = Sitin::where('nrp_mahasiswa', $sitIn->mahasiswa->nrp_mahasiswa)->where('status', 0)->where('status', -1)->get();
                    foreach($sitInLainnya as $x)
                    {
                       $x->delete();
                    }

                    // Waktunya pemberitahuan
                    $pemberitahuan = new PemberitahuanMahasiswa;
                    $mahasiswa = Mahasiswa::find($sitIn->mahasiswa->nrp_mahasiswa);
                    $pemberitahuan->isi = "Proses sitin dari dosen ".$sitIn->dosen->pegawai->nama_lengkap." telah disetujui.";
                    $pemberitahuan->mahasiswa()->associate($mahasiswa);
                    $pemberitahuan->save();
                }
            }

        }
        else if(Request::isMethod('delete'))
        {
            // Ada dua objektif
            // 1. Mahasiswa hanya bisa menotifikasi dosen bersangkutan
            // 2. Dosen bersangkutan yang berhak melakukan mekanisme ini
            $sitIn = SitIn::with('dosen', 'mahasiswa')->find(Input::get('id_sit_in'));
            $auth = Auth::user();
            if($auth != null and $sitIn != null)
            {
                if($auth->peran == 2 || $auth->peran == 3)
                {
                    if($auth->nomor_induk == $sitIn->dosen->nip_dosen)
                    {
                        $sitIn->delete();
                    }
                }
                else if($auth->peran == 0)
                {
                    // Set status ke -1
                    $sitIn->status = -1;
                    $sitIn->save();

                    // Membuat pemberitahuan ke Dosen bersankutan
                    $pemberitahuan = new PemberitahuanPegawai;
                    $pegawai = Pegawai::find($sitIn->dosen->nip_dosen);
                    $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp_mahasiswa." memerlukan persetujuan Anda untuk membatalkan Sitin.";
                    $pemberitahuan->pegawai()->associate($pegawai);
                    $pemberitahuan->save();
                }
            }
        }
    }

    /**
     * Dasbor SitIn Dosen
     *
     * @return View
     */
    public function dasborSitInDosen()
    {
        return View::make('pages.dasbor.sit_in.dosen');
    }
}
