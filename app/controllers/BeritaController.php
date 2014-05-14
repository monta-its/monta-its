<?php
/**
 * BeritaController
 * Handle everything under "/berita" route
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BeritaController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
class BeritaController extends BaseController {


    /**
     * Tampilkan Berita Secara Umum
     *
     * @return View
     */
	public function lihatSemuaBerita()
	{
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Berita')
        );

        $item = array(
            'judul_berita' => 'Judul Berita',
            'id_berita' => 'id_berita',
            'cuplikan_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'waktu' => '11 Januari 2014 13:00AM',
            'nama_dosen' => 'Nama Penulis',
            'id_dosen' => 'id_dosen',
            'nama_kategori' => 'Nama Kategori',
            'id_kategori' => 'id_kategori'
        );

        $l_item = array();
        array_push($l_item, $item);

        array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.berita.index');
	}


    /**
     * Tampilkan Isi Berita
     *
     * @var string $id_berita
     * @return View
     */
    function lihatIsiBerita($id_berita)
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Berita')
        );

        $item = array(
            'judul_berita' => 'Judul Berita',
            'id_berita' => 'id_berita',
            'isi_berita' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'waktu' => '11 Januari 2014 13:00AM',
            'nama_dosen' => 'Nama Penulis',
            'id_dosen' => 'id_dosen',
            'nama_kategori' => 'Nama Kategori',
            'id_kategori' => 'id_kategori'
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.berita.item');
    }


    /**
     * Tampilkan daftar berita berdasarkan kategori
     *
     * @var string id_kategori
     * @return View
     */
    function lihatBeritaDariKategori($id_kategori)
    {
        return "berita/kategori/id_kategori";
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar berita yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarBerita()
    {
        return View::make('pages.dasbor.berita.index');
    }

    /**
     * Tambahkan berita baru. Menampilkan laman penambahan berita.
     *
     * @return View
     */
    function dasborTambahkanBerita()
    {
        return View::make('pages.dasbor.berita.baru');
    }

    /**
     * Simpan berita baru.
     *
     * @return View
     */
    function dasborSimpanBeritaBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/berita');
    }

    /**
     * Sunting berita
     *
     * @var string $id_berita
     * @return View
     */
    function dasborSuntingBerita($id_berita)
    {
        return View::make('pages.dasbor.berita.sunting');
    }

    /**
     * Simpan berita yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanBerita()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/berita');
    }

    /**
     * Hapus berita
     *
     * @var string $id_berita
     * @return View
     */
    function dasborHapusBerita($id_berita)
    {
        return Redirect::to('dasbor/berita');
    }
}
