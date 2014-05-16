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
use Redirect;
use Simta\Models\Judul;

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
            array('link' => '', 'text' => 'Judul TA')
        );

        $item = array(
            'judul_judul' => 'Judul Judul TA',
            'id_judul' => 'id_judul',
            'cuplikan_judul' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'nama_prodi' => 'NCC',
            'id_prodi' => 'id_prodi',
            'id_topik' => 'id_topik',
            'nama_topik' => 'Nama Topik',
            'label_prodi' => 'Laboratorium',
            'status_terambil' => true,
            'waktu_mulai' => '10 Januari 2013',
            'waktu_akhir' => '30 Desember 2014',
            'pembimbing' => array(
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen'
                ),
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen'
                )
            )
        );

        $l_item = array();
        array_push($l_item, $item);
        $item['status_terambil'] = false;
        $item['nama_prodi'] = 'RPL';
        array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
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
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/judul'), 'text' => 'Judul TA'),
            array('link' => '', 'text' => 'Judul Judul TA')
        );
        $item = array(
            'judul_judul' => 'Judul Judul TA',
            'id_judul' => 'id_judul',
            'isi_judul' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'nama_prodi' => 'NCC',
            'id_prodi' => 'id_prodi',
            'label_prodi' => 'Laboratorium',
            'id_topik' => 'id_topik',
            'nama_topik' => 'Nama Topik',
            'status_terambil' => false,
            'waktu_mulai' => '10 Januari 2013',
            'waktu_akhir' => '30 Desember 2014',
            'pembimbing' => array(
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen'
                ),
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen'
                )
            )
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.judul.item');
    }


    /**
     * Tampilkan daftar judul berdasarkan kategori
     *
     * @var string id_kategori
     * @return View
     */
    function lihatJudulDariKategori($id_kategori)
    {
        return "judul/kategori/id_kategori";
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar judul yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarJudul()
    {
        return View::make('pages.dasbor.judul.index');
    }

    /**
     * Tambahkan judul baru. Menampilkan laman penambahan judul.
     *
     * @return View
     */
    function dasborTambahkanJudul()
    {
        return View::make('pages.dasbor.judul.baru');
    }

    /**
     * Simpan judul baru.
     *
     * @return View
     */
    function dasborSimpanJudulBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/judul');
    }

    /**
     * Sunting judul
     *
     * @var string $id_judul
     * @return View
     */
    function dasborSuntingJudul($id_judul)
    {
        return View::make('pages.dasbor.judul.sunting');
    }

    /**
     * Simpan judul yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanJudul()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/judul');
    }

    /**
     * Hapus judul
     *
     * @var string $id_judul
     * @return View
     */
    function dasborHapusJudul($id_judul)
    {
        return Redirect::to('dasbor/judul');
    }
}
