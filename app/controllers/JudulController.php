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

        $items = PenawaranJudul::with('bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->get();

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
        $item = PenawaranJudul::with('bidangMinat', 'tugasAkhir.mahasiswa', 'tugasAkhir.dosenPembimbing.pegawai', 'dosen.pegawai')->find($id_judul);

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

    private function cekLoginSpesial()
    {
        // apakah login
        if (Auth::check())
        {
            // apakah mahasiswa
            if (Auth::user()->peran == 0)
            {
                return true;
            }
            else
            {
                Session::set('page_title', 'Hanya Untuk Mahasiswa');
                Session::set('message', 'Anda harus login sebagai mahasiswa untuk melakukan aksi tersebut.');
                return false;
            }
        }
        else
        {
            Session::set('page_title', 'Login Dibutuhkan');
            Session::set('message', 'Anda harus login sebagai mahasiswa untuk melakukan aksi tersebut.');
            return false;
        }
    }

    /**
     * Ambil judul tertentu
     *
     * @var string id_judul
     * @return View
     */
    function ambilJudul($id_judul)
    {
        if (!$this->cekLoginSpesial())
        {
            return Redirect::to('/terlarang');
        }

        $penawaranJudul = PenawaranJudul::with('dosen')->find($id_judul);
        $nrp_mahasiswa = Auth::user()->nomor_induk;
        if ($penawaranJudul != null)
        {
            // judul tersedia
            if ($penawaranJudul->tugasAkhir == null)
            {
                $mahasiswa = Mahasiswa::with('tugasAkhir.penawaranJudul', 'tugasAkhir.dosenPembimbing')->find($nrp_mahasiswa);
                // apakah mahasiswa telah memiliki data tugas akhir atau telah bimbingan
                if ($mahasiswa->tugasAkhir->count() != 0)
                {
                    // urutkan berdasarkan tanggal mulai
                    $mahasiswa->tugasAkhir->sort(function($a, $b)
                    {
                        $a = $a->created_at;
                        $b = $b->created_at;
                        if ($a === $b) {
                            return 0;
                        }
                        return ($a > $b) ? 1 : -1;
                    });
                    $tugasAkhirTerakhir = $mahasiswa->tugasAkhir->last();

                    foreach ($tugasAkhirTerakhir->dosenPembimbing as $dosenPembimbing)
                    {
                        if ($dosenPembimbing->nip_dosen == $penawaranJudul->dosen->nip_dosen)
                        {
                            $tugasAkhirTerakhir->penawaranJudul()->associate($penawaranJudul);
                            $tugasAkhirTerakhir->save();
                            return Redirect::to('/dasbor/mahasiswa');
                        }
                    }

                    Session::set('page_title', 'Anda Tidak Berhak Mengambil Judul Tersebut');
                    Session::set('message', 'Judul yang ditawarkan bukan berasal dari dosen pembimbing Anda.');
                    return Redirect::to('/terlarang');
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
     * @var string id_judul
     * @return View
     */
    function batalkanJudul($id_judul)
    {
        if (!$this->cekLoginSpesial())
        {
            return Redirect::to('/terlarang');
        }

        $penawaranJudul = PenawaranJudul::with('tugasAkhir')->find($id_judul);
        $nrp_mahasiswa = Auth::user()->nomor_induk;
        if ($penawaranJudul != null)
        {
            if ($penawaranJudul->tugasAkhir != null)
            {
                if ($penawaranJudul->tugasAkhir->nrp_mahasiswa == $nrp_mahasiswa)
                {
                    $penawaranJudul->tugasAkhir->id_penawaran_judul = null;
                    $penawaranJudul->tugasAkhir->save();
                    return Redirect::to('/dasbor/mahasiswa');
                }
                else
                {
                    Session::set('page_title', 'Anda Tidak Berhak Melakukan Aksi Tersebut');
                    Session::set('message', 'Judul yang ditawarkan sedang diambil oleh mahasiswa lain.');
                    return Redirect::to('/terlarang');
                }
            }
            else
            {
                Session::set('page_title', 'Anda Tidak Berhak Melakukan Aksi Tersebut');
                Session::set('message', 'Judul yang ditawarkan tidak sedang Anda ambil atau sedang diambil oleh mahasiswa lain.');
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
                return Response::json(PenawaranJudul::with('dosen', 'dosen.pegawai', 'tugasAkhir', 'tugasAkhir.mahasiswa')->where('nip_dosen', $nip_dosen)->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $dosen = Dosen::find(Auth::user()->nomor_induk);
            $judul = new PenawaranJudul;
            if($dosen != null)
            {
                $judul->judul_tugas_akhir = Input::get('judul_tugas_akhir');
                $judul->deskripsi = Input::get('deskripsi');
                $judul->dosen()->associate($dosen);
                if(!$judul->save())
                {
                    return Response::json(array('error' => $judul->validatorMessage));
                }
                $pesan = "Data berhasil disimpan.";
            }
            else
            {
                $pesan = 'Dosen tidak ditemukan. Penambahan data dibatalkan.';
            }
        }
        else if(Request::isMethod('put'))
        {
            // One doesn't simply modify dosen according who login now.
            // $dosen = Dosen::find(Auth::user()->nomor_induk);
            $judul = PenawaranJudul::find(Input::get('id_penawaran_judul'));
            if($judul != null)
            {
                $judul->judul_tugas_akhir = Input::get('judul_tugas_akhir');
                $judul->deskripsi = Input::get('deskripsi');
                if(!$judul->save())
                {
                    return Response::json(array('error' => $judul->validatorMessage));
                }
                $pesan = "Perubahan data berhasil disimpan.";
            }
            else
            {
                $pesan = "Judul tidak ditemukan. Penyimpanan data dibatalkan.";
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
