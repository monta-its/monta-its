<?php
/**
 * JudulController
 * Handle everything under "/judul" and "/dasbor/judul" routes
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
use Simta\Models\PenawaranJudul;
use Simta\Models\Topik;

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
        return 'Ambil judul kemudian redirect ke laman profil TA yang memuat informasi pengambilan';
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
            if($dosen != null and $topik != null)
            {
                $judul->judul_tugas_akhir = Input::get('judul_tugas_akhir');
                $judul->deskripsi = Input::get('deskripsi');
                $judul->dosen()->associate($dosen);
                $judul->topik()->associate($topik);
                $judul->save();
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
            }
        }
        else if(Request::isMethod('delete'))
        {
            $judul = PenawaranJudul::find(Input::get('id_penawaran_judul'));
            $judul->delete();
        }
    }
}
