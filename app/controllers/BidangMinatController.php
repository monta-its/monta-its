<?php
/**
 * BidangMinatController
 * Menangani semua proses yang berkaitan dengan bidang minat, baik di halaman umum maupun dasbor
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BidangMinatController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\BidangMinat;

class BidangMinatController extends BaseController {

    /**
     * Tampilan bidang minat secara umum.
     *
     * @return View
     */
    public function lihatSemuaBidangMinat()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Prodi')
        );

        $item = array(
            'nama_prodi' => 'Nama Program Studi',
            'id_prodi' => 'id_prodi',
            'cuplikan_prodi' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'singkatan_prodi' => 'NPS',
            'label_prodi' => 'KBK'
        );

        $l_item = array();
        array_push($l_item, $item);
        array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);

        return View::make('pages.prodi.index');
    }

    /**
     * Tampilan laman rincian bidang minat.
     *
     * @return View
     */
    public function lihatRincianBidangMinat($id_prodi)
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/prodi'), 'text' => 'Prodi'),
            array('link' => '', 'text' => 'Nama Program Studi (NPS)'),
        );

        $item = array(
            'nama_prodi' => 'Nama Program Studi',
            'id_prodi' => 'id_prodi',
            'deskripsi_prodi' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'singkatan_prodi' => 'NPS',
            'label_prodi' => 'KBK',
            'dosen_prodi' => array(
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen',
                    'bidang_ahli' => array(
                        array(
                            'id_bidang_ahli' => 'id_bidang_ahli',
                            'nama_bidang_ahli' => 'Nama Bidang Ahli'
                        ),
                        array(
                            'id_bidang_ahli' => 'id_bidang_ahli',
                            'nama_bidang_ahli' => 'Nama Bidang Ahli'
                        )
                    )
                ),
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen',
                    'bidang_ahli' => array(
                        array(
                            'id_bidang_ahli' => 'id_bidang_ahli',
                            'nama_bidang_ahli' => 'Nama Bidang Ahli'
                        ),
                        array(
                            'id_bidang_ahli' => 'id_bidang_ahli',
                            'nama_bidang_ahli' => 'Nama Bidang Ahli'
                        )
                    )
                )
            )
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);

        return View::make('pages.prodi.item');
    }

    /* Kelompok dasbor */

    /**
     * Tampilkan laman dasbor kelola bidang minat yang hanya bisa diakses oleh dosen.
     *
     * @return View
     */
    public function dasborKelolaBidangMinat()
    {
        return View::make('pages.dasbor.prodi.index');
    }

    /**
     * Tambahkan bidang minat baru. Menampilkan laman penambahan bidang minat.
     *
     * @return View
     */
    function dasborTambahkanBidangMinat()
    {
        return View::make('pages.dasbor.prodi.baru');
    }

    /**
     * Simpan bidang minat baru.
     *
     * @return View
     */
    function dasborSimpanBidangMinatBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/prodi');
    }

    /**
     * Sunting bidang minat
     *
     * @var string $id_prodi
     * @return View
     */
    function dasborSuntingBidangMinat($id_prodi)
    {
        return View::make('pages.dasbor.prodi.sunting');
    }

    /**
     * Simpan bidang minat yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanBidangMinat()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/prodi');
    }

    /**
     * Hapus bidang minat
     *
     * @var string $id_prodi
     * @return View
     */
    function dasborHapusBidangMinat($id_prodi)
    {
        return Redirect::to('dasbor/prodi');
    }
}
