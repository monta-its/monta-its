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
                return Response::json(SitIn::with('dosen', 'dosen.pegawai')->get());
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
                }
            }

            // Pre Insertion Detection
            // Apakah ada Sitin belum disetujui dengan dosen bersangkutan?
            if(SitIn::where('nip_dosen', Input::get('dosen.nip_dosen'))->where('disetujui', '0')->where('nrp_mahasiswa', $auth->nomor_induk)->get()->count() != 0)
            {
                return Response::json(array('galat' => 'Anda sudah memiliki Sitin dengan dosen bersangkutan yang belum disetujui'));
            }

            // Apakah Sitin sudah ada dua yang belum disetujui
            if(SitIn::where('disetujui', '0')->where('nrp_mahasiswa', $auth->nomor_induk)->get()->count() >= 2)
            {
                return Response::json(array('galat' => 'Anda sudah memiliki dua Sitin yang sudah disetujui'));
            }


            if($mahasiswa != null and $dosen != null)
            {
                $sitIn = new Sitin;
                $sitIn->dosen()->associate($dosen);
                $sitIn->mahasiswa()->associate($mahasiswa);
                $sitIn->disetujui = 0;
                $sitIn->save();

                // Membuat pemberitahuan ke Dosen bersankutan
                $pemberitahuan = new PemberitahuanPegawai;
                $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp_mahasiswa." memerlukan persetujuan Anda untuk menyetujui Sitin.";
                $pemberitahuan->pegawai()->associate($dosen->pegawai()->first());
                $pemberitahuan->save();
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
     * Dasbor SitIn Dosen berbasis REST
     *
     * @return View
     */
    public function dasborSitInDosen()
    {
        return View::make('pages.dasbor.sit_in.dosen');
    }
}
