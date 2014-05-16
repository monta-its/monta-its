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
use Simta\Models\Pos;

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

        $items = Pos::get();
        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
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
        $item = Pos::find($id_berita);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/berita'), 'text' => 'Berita'),
            array('link' => '', 'text' => $item->judul)
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
        return Redirect::to('dasbor/pegawai/berita');
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
        return Redirect::to('dasbor/pegawai/berita');
    }

    /**
     * Hapus berita
     *
     * @var string $id_berita
     * @return View
     */
    function dasborHapusBerita($id_berita)
    {
        return Redirect::to('dasbor/pegawai/berita');
    }
}
