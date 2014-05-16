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

        $item = array(
            'judul_panduan' => 'Judul Panduan',
            'id_panduan' => 'id_panduan',
            'cuplikan_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'waktu' => '11 Januari 2014 13:00AM',
            'nama_dosen' => 'Nama Penulis',
            'id_dosen' => 'id_dosen',
            'tautan_lampiran' => 'tautan/ke/berkas.ext',
            'nama_lampiran' => 'Nama File.ext'
        );

        $l_item = array();
        array_push($l_item, $item);
        $item['tautan_lampiran'] = '';
        $item['nama_lampiran'] = '';
        array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
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
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('panduan'), 'text' => 'Panduan'),
            array('link' => '', 'text' => 'Judul Panduan'),
        );

        $item = array(
            'judul_panduan' => 'Judul Panduan',
            'id_panduan' => 'id_panduan',
            'isi_panduan' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'waktu' => '11 Januari 2014 13:00AM',
            'nama_dosen' => 'Nama Penulis',
            'id_dosen' => 'id_dosen',
            'tautan_lampiran' => 'tautan/ke/berkas.ext',
            'nama_lampiran' => 'Nama File.ext'
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.panduan.item');
    }


    /**
     * Tampilkan daftar panduan berdasarkan kategori
     *
     * @var string id_kategori
     * @return View
     */
    function lihatPanduanDariKategori($id_kategori)
    {
        return "panduan/kategori/id_kategori";
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar panduan yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarPanduan()
    {
        return View::make('pages.dasbor.panduan.index');
    }

    /**
     * Tambahkan panduan baru. Menampilkan laman penambahan panduan.
     *
     * @return View
     */
    function dasborTambahkanPanduan()
    {
        return View::make('pages.dasbor.panduan.baru');
    }

    /**
     * Simpan panduan baru.
     *
     * @return View
     */
    function dasborSimpanPanduanBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/panduan');
    }

    /**
     * Sunting panduan
     *
     * @var string $id_panduan
     * @return View
     */
    function dasborSuntingPanduan($id_panduan)
    {
        return View::make('pages.dasbor.panduan.sunting');
    }

    /**
     * Simpan panduan yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanPanduan()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/panduan');
    }

    /**
     * Hapus panduan
     *
     * @var string $id_panduan
     * @return View
     */
    function dasborHapusPanduan($id_panduan)
    {
        return Redirect::to('dasbor/pegawai/panduan');
    }
}
