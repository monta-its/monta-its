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

        $items = Panduan::get();

        View::share('breadcrumbs', $breadcrumbs);
        View::share('items', $items);
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
        $item = Panduan::find($id_panduan);

        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('panduan'), 'text' => 'Panduan'),
            array('link' => '', 'text' => $item->judul),
        );


        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.panduan.item');
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
