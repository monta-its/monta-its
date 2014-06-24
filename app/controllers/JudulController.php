<?php
/**
 * JudulController
 * Handle everything about Penawaran Judul, under "/judul" and "/dasbor/judul" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\JudulController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Request;
use Response;
use Redirect;
use Auth;
use Session;
use Simta\Models\PenawaranJudul;
use Simta\Models\Topik;
use Simta\Models\Dosen;
use Simta\Models\Mahasiswa;
use Simta\Models\TugasAkhir;

class JudulController extends BaseController {
    /**
     * Tampilkan Judul Secara Umum
     *
     * @return View
     */
    public function lihatSemuaJudul()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Penawaran Judul')
        );

        $items = PenawaranJudul::with('topik.bidangKeahlian.bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
        return View::make('pages.judul.index');
    }


    /**
     * Tampilkan Isi Judul
     *
     * @var string $id_judul
     * @return View
     */
    function lihatIsiJudul($id_judul)
    {
        $item = PenawaranJudul::with('topik.bidangKeahlian.bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->find($id_judul);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/judul'), 'text' => 'Penawaran Judul'),
            array('link' => '', 'text' => $item->judul_tugas_akhir)
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.judul.item');
    }

    /**
     * Tampilkan daftar judul berdasarkan bidang minat
     *
     * @var string id_prodi
     * @return View
     */
    function lihatJudulDariBidangMinat($id_prodi)
    {
        return 'Halaman memuat judul-judul yang dengan filter bidang minat tertentu';
    }

    /**
     * Tampilkan daftar judul berdasarkan bidang keahlian
     *
     * @var string id_bidang_keahlian
     * @return View
     */
    function lihatJudulDariBidangKeahlian($id_bidang_keahlian)
    {
        return 'Halaman memuat judul-judul yang dengan filter bidang keahlian tertentu';
    }

    /**
     * Tampilkan daftar judul berdasarkan topik
     *
     * @var string id_topik
     * @return View
     */
    function lihatJudulDariTopik($id_topik)
    {
        return 'Halaman memuat judul-judul yang dengan filter topik tertentu';
    }

    /**
     * Ambil judul tertentu
     *
     * @var string id_judul
     * @return View
     */
    function ambilJudul($id_judul)
    {
        // apakah login
        if (Auth::check())
        {
            // apakah mahasiswa
            if (Auth::user()->peran == 0)
            {
                // do nothing, proceed next outer code :D
            }
            else
            {
                Session::set('page_title', 'Hanya Untuk Mahasiswa');
                Session::set('message', 'Anda harus login sebagai mahasiswa untuk melakukan aksi tersebut.');
                return Redirect::to('/terlarang');
            }
        }
        else
        {
            Session::set('page_title', 'Login Dibutuhkan');
            Session::set('message', 'Anda harus login sebagai mahasiswa untuk melakukan aksi tersebut.');
            return Redirect::to('/terlarang');
        }

        $penawaranJudul = PenawaranJudul::find($id_judul);
        $nrp_mahasiswa = Auth::user()->nomor_induk;
        if ($penawaranJudul != null)
        {
            // judul tersedia
            if ($penawaranJudul->tugasAkhir == null)
            {
                $mahasiswa = Mahasiswa::with('tugasAkhir')->find($nrp_mahasiswa);return var_dump($mahasiswa->tugasAkhir);
                // apakah mahasiswa telah memiliki data tugas akhir atau telah bimbingan
                if ($mahasiswa->tugasAkhir != null)
                {
                    /**
                     * TODO:
                     * - ambil data TA terkahir, yaitu data TA pada periode yang sama
                     * dengan periode aktif.
                     * - perhatikan kondisi untuk mahasiswa yang pernah mengambil TA di 
                     * sebelumnya namun tidak lulus.
                     */
                    return "Lihat bagian TODO di JudulController line 142";
                    $mahasiswa->tugasAkhir->penawaranJudul()->associate($penawaranJudul);
                    $mahasiswa->tugasAkhir->save();
                    return Redirect::to('/dasbor/mahasiswa');    
                }
                else
                {
                    Session::set('page_title', 'Data Tugas Akhir Tidak Ditemukan');
                    Session::set('message', 'Anda belum berhak melakukan aksi tersebut karena Anda belum tercatat sebagai mahasiswa bimbingan. Silakan selesaikan kewajiban sit in Anda.');
                    return Redirect::to('/terlarang');
                }
            }
            {
                Session::set('page_title', 'Judul Tidak Tersedia');
                Session::set('message', 'Judul yang hendak Anda ambil tidak tersedia atau sudah diambil oleh mahasiswa lainnya. Jika ini merupakan suatu kesalahan, silakan laporkan hal ini ke dosen pembimbing Anda.');
                return Redirect::to('/terlarang');
            }
        }
        else 
        {
            Session::set('page_title', 'Tidak Ditemukan');
            Session::set('message', 'Data penawaran judul yang Anda maksudkan tidak ditemukan.');
            return Redirect::to('/terlarang');
        }
    }

    /**
     * Batalkan judul yang sedang diambil
     *
     * @return View
     */
    function batalkanJudul()
    {
        return 'Batalkan judul yang sedang diambil';
    }

    /* Kelompok dasbor */

    /**
     * Controller untuk Dasbor Judul (PenawaranJudul), berbasiskan mekanisme REST
     * @return View
     */
    function dasborJudul()
    {
        $pesan = "";
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.judul.index');
            }
            else
            {
                $nip_dosen = Auth::user()->nomor_induk;
                return Response::json(PenawaranJudul::with('dosen', 'dosen.pegawai', 'tugasAkhir', 'tugasAkhir.mahasiswa', 'topik')->where('nip_dosen', $nip_dosen)->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $dosen = Dosen::find(Auth::user()->nomor_induk);
            $topik = Topik::find(Input::get('topik.id_topik'));
            $judul = new PenawaranJudul;
            if($dosen != null && $topik != null)
            {
                $judul->judul_tugas_akhir = Input::get('judul_tugas_akhir');
                $judul->deskripsi = Input::get('deskripsi');
                $judul->dosen()->associate($dosen);
                $judul->topik()->associate($topik);
                $judul->save();
                $pesan = "Data berhasil disimpan.";
            }
            else
            {
                $pesan = 'Dosen atau topik tidak ditemukan. Penambahan data dibatalkan.';
            }
        }
        else if(Request::isMethod('put'))
        {
            // One doesn't simply modify dosen according who login now.
            // $dosen = Dosen::find(Auth::user()->nomor_induk);
            $topik = Topik::find(Input::get('topik.id_topik'));
            $judul = PenawaranJudul::find(Input::get('id_penawaran_judul'));
            if($topik != null)
            {
                $judul->judul_tugas_akhir = Input::get('judul_tugas_akhir');
                $judul->deskripsi = Input::get('deskripsi');
                $judul->topik()->associate($topik);
                $judul->save();
                $pesan = "Perubahan data berhasil disimpan.";
            }
            else
            {
                $pesan = "Topik tidak ditemukan. Penyimpanan data dibatalkan.";                
            }
        }
        else if(Request::isMethod('delete'))
        {
            $judul = PenawaranJudul::find(Input::get('id_penawaran_judul'));
            if ($judul != null) 
            {
                $judul->delete();
                $pesan = "Penghapusan data berhasil.";    
            }
            else
            {
                $pesan = "Penawaran Judul tidak ditemukan.";
            }
        }
        return Response::json(array('pesan' => $pesan));
    }
}
