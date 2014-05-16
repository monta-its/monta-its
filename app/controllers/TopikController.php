<?php
/**
 * TopikController
 * Handle everything under "/topik" and "/dasbor/pegawai/topik" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\TopikController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\Topik;

class TopikController extends BaseController {


    /**
     * Tampilkan Topik Secara Umum
     *
     * @return View
     */
    public function lihatSemuaTopik()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Topik TA')
        );

        $item = array(
            'judul_topik' => 'Judul Topik TA',
            'id_topik' => 'id_topik',
            'cuplikan_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'nama_prodi' => 'NCC',
            'id_prodi' => 'id_prodi',
            'id_bidang_keahlian' => 'id_bidang_keahlian',
            'nama_bidang_keahlian' => 'Nama Bidang Ahli',
            'label_prodi' => 'Laboratorium',
            'status_terambil' => true,
            'waktu_mulai' => '10 Januari 2013',
            'waktu_akhir' => '30 Desember 2014',
            'penulis' => array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen'
            )
        );

        $l_item = array();
        array_push($l_item, $item);
        $item['status_terambil'] = false;
        $item['nama_prodi'] = 'RPL';
        array_push($l_item, $item);

        View::share('breadcrumbs', $breadcrumbs);
        View::share('l_item', $l_item);
        return View::make('pages.topik.index');
    }


    /**
     * Tampilkan Isi Topik
     *
     * @var string $id_topik
     * @return View
     */
    function lihatIsiTopik($id_topik)
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/topik'), 'text' => 'Topik TA'),
            array('link' => '', 'text' => 'Judul Topik TA')
        );
        $item = array(
            'judul_topik' => 'Judul Topik TA',
            'id_topik' => 'id_topik',
            'isi_topik' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
            'nama_prodi' => 'NCC',
            'id_prodi' => 'id_prodi',
            'label_prodi' => 'Laboratorium',
            'id_bidang_keahlian' => 'id_bidang_keahlian',
            'nama_bidang_keahlian' => 'Nama Bidang Ahli',
            'status_terambil' => false,
            'waktu_mulai' => '10 Januari 2013',
            'waktu_akhir' => '30 Desember 2014',
            'penulis' => array(
                'id_dosen' => 'id_dosen',
                'nama_dosen' => 'Nama Dosen'
            ),
            'mahasiswa_judul' => array(
                array(
                    'judul_judul' => 'Judul Judul TA',
                    'id_judul' => 'id_judul',
                    'nama_mahasiswa' => 'Nama Mahasiswa',
                    'nrp_mahasiswa' => '1234567890',
                    'id_mahasiswa' => '0987654321'
                ),
                array(
                    'judul_judul' => 'Judul Judul TA',
                    'id_judul' => 'id_judul',
                    'nama_mahasiswa' => 'Nama Mahasiswa',
                    'nrp_mahasiswa' => '1234567890',
                    'id_mahasiswa' => '0987654321'
                ),
                array(
                    'judul_judul' => 'Judul Judul TA',
                    'id_judul' => 'id_judul',
                    'nama_mahasiswa' => 'Nama Mahasiswa',
                    'nrp_mahasiswa' => '1234567890',
                    'id_mahasiswa' => '0987654321'
                )
            )
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.topik.item');
    }


    /**
     * Tampilkan daftar topik berdasarkan kategori
     *
     * @var string id_kategori
     * @return View
     */
    function lihatTopikDariKategori($id_kategori)
    {
        return "topik/kategori/id_kategori";
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar topik yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarTopik()
    {
        return View::make('pages.dasbor.topik.index');
    }

    /**
     * Tambahkan topik baru. Menampilkan laman penambahan topik.
     *
     * @return View
     */
    function dasborTambahkanTopik()
    {
        return View::make('pages.dasbor.topik.baru');
    }

    /**
     * Simpan topik baru.
     *
     * @return View
     */
    function dasborSimpanTopikBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/topik');
    }

    /**
     * Sunting topik
     *
     * @var string $id_topik
     * @return View
     */
    function dasborSuntingTopik($id_topik)
    {
        return View::make('pages.dasbor.topik.sunting');
    }

    /**
     * Simpan topik yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanTopik()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/pegawai/topik');
    }

    /**
     * Hapus topik
     *
     * @var string $id_topik
     * @return View
     */
    function dasborHapusTopik($id_topik)
    {
        return Redirect::to('dasbor/pegawai/topik');
    }
}
