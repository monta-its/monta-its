<?php
/**
 * DosenController
 * Mengelola proses dalam rute /dosen dan /dasbor/dosen
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\DosenController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\Dosen;

class DosenController extends BaseController {
    /**
     * Tampilkan Dosen Secara Umum
     *
     * @return View
     */
    public function lihatSemuaDosen()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Dosen')
        );

        $l_item = array();
        // array_push($l_item, $item);
        // array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.dosen.index');
    }


    /**
     * Tampilkan Profil Dosen
     *
     * @var string $id_dosen
     * @return View
     */
    function lihatProfilDosen($id_dosen)
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/dosen'), 'text' => 'Dosen'),
            array('link' => '', 'text' => 'Profil')
        );
        View::share('breadcrumbs', $breadcrumbs);
        return View::make('pages.dosen.item');
    }

    /* Kelompok dasbor */

    /**
     * Tampilan laman dasbor awal untuk dosen.
     * @return View
     */
    function dasborDosen()
    {
        return View::make('pages.dasbor.dosen.index');
    }

    /**
     * Tambahkan dosen baru. Menampilkan laman penambahan dosen.
     *
     * @return View
     */
    function dasborTambahkanDosen()
    {
        return View::make('pages.dasbor.dosen.baru');
    }

    /**
     * Simpan dosen baru.
     *
     * @return View
     */
    function dasborSimpanDosenBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/dosen');
    }

    /**
     * Sunting dosen
     *
     * @var string $id_dosen
     * @return View
     */
    function dasborSuntingDosen($id_dosen)
    {
        return View::make('pages.dasbor.dosen.sunting');
    }

    /**
     * Simpan dosen yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanDosen()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/dosen');
    }

    /**
     * Hapus dosen
     *
     * @var string $id_dosen
     * @return View
     */
    function dasborHapusDosen($id_dosen)
    {
        return Redirect::to('dasbor/dosen');
    }
}
