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
use Simta\Models\Pemberitahuan;

class SitInController extends BaseController {
    /**
     * Dasbor SitIn Mahasiswa
     *
     * @return View
     */
    public function dasborSitInMahasiswa()
    {
        if (!Mahasiswa::find(Auth::user()->person_id)->apakahLulusSyarat('pra_sit_in'))
        {
            return Redirect::to('/dasbor/terlarang')
                ->with('page_title', 'Syarat Sit In Belum Lengkap')
                ->with('message', 'Anda belum berhak mengakses laman ini karena belum melengkapi persyaratan pra sit in. Silakan lengkapi persyaratan dengan menyerahkannya ke petugas jurusan.');
                exit;
        }
        return View::make('pages.dasbor.sit_in.mahasiswa');
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

    /**
     * Memproses data Sit In ke dalam bentuk Tugas Akhir
     * Diakses oleh Mahasiswa ketika Sitin mereka disetujui
     *
     * @return JSON
     */
    public function prosesTA()
    {
        $pesan = '';
        $tugasAkhir = null;
        if(Request::isMethod('post'))
        {
            if(Auth::user()->peran == 0)
            {
                // Ambil Sitin yang sesuai untuk mahasiswa bersangkutan
                $sitIn = SitIn::where('nrp', Auth::user()->person_id)->where('status', '=', 1)->find(Input::get('id_sit_in'));
                $tugasAkhir = $sitIn->buatDataTugasAkhir();
                if ($tugasAkhir != null)
                {
                    $pesan = 'Sit In telah diproses. Anda kini telah menjadi mahasiswa bimbingan ';
                }
                else
                {
                    $pesan = 'Anda tidak memiliki sit in yang telah disetujui.';
                }
                return Response::json(array('pesan'=>$pesan, 'tugas_akhir'=>$tugasAkhir));
            }
        }
    }

    /**
     * Menyediakan layanan data Sit In dosen dan mahasiswa
     *
     * @return JSON
     */
    public function kelolaSitIn()
    {
        if (Auth::user()->peran == 0)
        {
            if (!Mahasiswa::find(Auth::user()->person_id)->apakahLulusSyarat('pra_sit_in'))
            {
                if (Request::ajax())
                {
                    return Response::json(array('galat' => 'Anda belum berhak mengakses laman ini karena belum melengkapi persyaratan pra sit in. Silakan lengkapi persyaratan dengan menyerahkannya ke petugas jurusan.'));
                    exit;

                }
                else
                {
                    return Redirect::to('/dasbor/terlarang')
                    ->with('page_title', 'Syarat Sit In Belum Lengkap')
                    ->with('message', 'Anda belum berhak mengakses laman ini karena belum melengkapi persyaratan pra sit in. Silakan lengkapi persyaratan dengan menyerahkannya ke petugas jurusan.');
                    exit;
                }
            }
        }

        if(Request::isMethod('get'))
        {
            if(Request::ajax())
            {
                
                if ($auth != null)
                {
                    $person_id = Auth::user()->person_id;
                    if (Auth::user()->peran == 0)
                    {
                        $jenis_person_id = 'nrp';
                    }
                    else
                    {
                        $jenis_person_id = 'nip';
                    }

                    return Response::json(SitIn::with('mahasiswa', 'dosen', 'dosen')->where($jenis_person_id, '=', $person_id)->get());
                }
            }
        }
        else if(Request::isMethod('post'))
        {
            $dosen = Dosen::find(Input::get('dosen.nip'));
            
            $mahasiswa = null;
            if($auth != null)
            {
                // Hanya melayani rekues dari mahasiswa
                if(Auth::user()->peran == 0)
                {
                    $mahasiswa = Mahasiswa::find(Auth::user()->person_id);
                    // Pre Insertion Detection
                    // Apakah sudah memiliki Sitin yang disetujui?
                    if(SitIn::where('nrp', Auth::user()->person_id)->where('status', '1')->get()->count() >= 1)
                    {
                        return Response::json(array('galat' => 'Anda sudah memiliki sebuah sitin yang disetujui. Untuk melakukan sitin ulang, Anda tidak dapat menambahkan/membatalkan Sitin tersebut.'));
                    }

                    // Apakah Kuota Dosen Sitin Sudah Terpenuhi
                    if($dosen->kuotaSitInSemesterIni() <= 0)
                    {
                        return Response::json(array('galat' => 'Kuota sitin dosen bersangkutan sudah habis.'));
                    }

                    // Cek berapa jumlah bimbingan dosen di semester depan

                    // Apakah ada Sitin belum status dengan dosen bersangkutan?
                    if(SitIn::where('nip', Input::get('dosen.nip'))->where('nrp', Auth::user()->person_id)->get()->count() != 0)
                    {
                        return Response::json(array('galat' => 'Anda sudah memiliki Sitin dengan dosen bersangkutan.'));
                    }

                    // Apakah Sitin sudah ada dua yang belum status
                    if(SitIn::where('nrp', Auth::user()->person_id)->get()->count() >= 2)
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
                        $pemberitahuan = new Pemberitahuan;
                        $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp." memerlukan persetujuan Anda untuk menyetujui Sitin.";
                        $pemberitahuan->save();
                        $dosen->pemberitahuan()->save($pemberitahuan);
                    }
                }
            }

        }
        else if(Request::isMethod('put'))
        {
            // Hanya bisa diakses oleh dosen
            // Digunakan untuk proses persetujuan sit in
            $sitIn = SitIn::with('mahasiswa', 'dosen')->find(Input::get('id_sit_in'));
            
            if($auth != null)
            {
                if(Auth::user()->peran == 2 || Auth::user()->peran == 3)
                {
                    $sitIn->status = 1;
                    $sitIn->save();

                    // Batalkan Sitin yang sama dari dosen lainnya
                    $sitInLainnya = Sitin::where('nrp', $sitIn->mahasiswa->nrp)->where('status', 0)->where('status', -1)->get();
                    foreach($sitInLainnya as $x)
                    {
                       $x->delete();
                    }

                    // Waktunya pemberitahuan
                    $pemberitahuan = new Pemberitahuan;
                    $mahasiswa = Mahasiswa::find($sitIn->mahasiswa->nrp);
                    $pemberitahuan->isi = "Proses sitin dari dosen ".$sitIn->dosen->nama_lengkap." telah disetujui.";
                    $pemberitahuan->save();
                    $mahasiswa->pemberitahuan()->save($pemberitahuan);
                }
            }

        }
        else if(Request::isMethod('delete'))
        {
            $sitIn = SitIn::with('dosen', 'mahasiswa')->find(Input::get('id_sit_in'));
            
            if($auth != null and $sitIn != null)
            {
                $pesan = null;
                // Jika status == diajukan
                if ($sitIn->status == 0)
                {
                    // Set status ke -1 kemudian langsung hapus
                    $sitIn->status = -1;
                    $sitIn->save();
                    $sitIn->delete();

                    // Jika dosen yang melakukan pembatalan
                    if (Auth::user()->peran == 2 || Auth::user()->peran == 3)
                    {
                        // Membuat pemberitahuan ke Mahasiswa bersangkutan
                        // bahwa dosen telah membatalkan Sit In yang belum disetujui
                        $pemberitahuan = new Pemberitahuan;
                        $mahasiswa = Mahasiswa::find($sitIn->nrp);
                        $pemberitahuan->isi = "Dosen ".$sitIn->dosen->nama_lengkap." - ".$sitIn->nip." membatalkan Sit In Anda.";
                        $pemberitahuan->save();
                        $mahasiswa->pemberitahuan()->save($pemberitahuan);

                        $pesan = "Sit In telah berhasil dibatalkan. Mahasiswa yang bersangkutan telah mendapatkan notifikasi.";
                    }
                    // Jika mahasiswa yang melakukan pembatalan
                    else if (Auth::user()->peran == 0)
                    {
                        // Membuat pemberitahuan ke Dosen bersangkutan
                        // bahwa mahasiswa telah membatalkan Sit In yang belum disetujui
                        $pemberitahuan = new Pemberitahuan;
                        $pegawai = Pegawai::find($sitIn->nip);
                        $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp." telah membatalkan Sit In yang belum Anda setujui.";
                        $pemberitahuan->save();
                        $pegawai->pemberitahuan()->save($pemberitahuan);

                        $pesan = "Sit In telah berhasil dibatalkan. Dosen yang bersangkutan telah mendapatkan notifikasi.";
                    }
                }
                // Jika status == disetujui
                else if ($sitIn->status == 1)
                {
                    // Jika dosen yang melakukan pembatalan
                    if (Auth::user()->peran == 2 || Auth::user()->peran == 3)
                    {
                        $sitIn->delete();

                        // Membuat pemberitahuan ke Mahasiswa bersangkutan
                        // bahwa dosen telah membatalkan Sit In
                        $pemberitahuan = new Pemberitahuan;
                        $mahasiswa = Mahasiswa::find($sitIn->nrp);
                        $pemberitahuan->isi = "Dosen ".$sitIn->dosen->nama_lengkap." - ".$sitIn->nip." membatalkan Sit In Anda.";
                        $pemberitahuan->save();
                        $mahasiswa->pemberitahuan()->save($pemberitahuan);

                        $pesan = "Sit In telah berhasil dibatalkan. Mahasiswa yang bersangkutan telah mendapatkan notifikasi.";
                    }
                    // Jika mahasiswa yang melakukan pembatalan
                    else if (Auth::user()->peran == 0)
                    {
                        $sitIn->status = -1;
                        $sitIn->save();

                        // Membuat pemberitahuan ke Dosen bersangkutan
                        // bahwa mahasiswa memerlukan persetujuan pembatalan Sit In
                        $pemberitahuan = new Pemberitahuan;
                        $pegawai = Pegawai::find($sitIn->nip);
                        $pemberitahuan->isi = "Mahasiswa ".$sitIn->mahasiswa->nama_lengkap." - ".$sitIn->mahasiswa->nrp." memerlukan persetujuan Anda untuk membatalkan Sit In.";
                        $pemberitahuan->save();
                        $pegawai->pemberitahuan()->save($pemberitahuan);

                        $pesan = "Permintaan pembatalan Sit In telah dikirim ke dosen bersangkutan.";
                    }
                }
                // Jika status == dibatalkan
                else if ($sitIn->status == -1)
                {
                    // Jika dosen yang melakukan pembatalan
                    if (Auth::user()->peran == 2 || Auth::user()->peran == 3)
                    {
                        $sitIn->delete();

                        // Membuat pemberitahuan ke Mahasiswa bersangkutan
                        // bahwa dosen telah membatalkan Sit In
                        $pemberitahuan = new Pemberitahuan;
                        $mahasiswa = Mahasiswa::find($sitIn->nrp);
                        $pemberitahuan->isi = "Dosen ".$sitIn->dosen->nama_lengkap." - ".$sitIn->nip." membatalkan Sit In Anda.";
                        $pemberitahuan->save();
                        $mahasiswa->pemberitahuan()->save($pemberitahuan);

                        $pesan = "Sit In telah berhasil dibatalkan. Mahasiswa yang bersangkutan telah mendapatkan notifikasi.";
                    }
                }

                return Response::json(array('pesan' => $pesan));
            }
        }
    }
}
