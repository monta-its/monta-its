<?php
/**
 * BidangKeahlianController
 * Handle everything under "/bidang_keahlian" and "/dasbor/bidang_keahlian" routes
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Controllers\BidangKeahlianController
 */

namespace Simta\Controllers;
use BaseController;
use URL;
use View;
use Input;
use Redirect;
use Simta\Models\BidangKeahlian;

class BidangKeahlianController extends BaseController {


    /**
     * Tampilkan Bidang Keahlian Secara Umum
     *
     * @return View
     */
    public function lihatSemuaBidangKeahlian()
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => '', 'text' => 'Bidang Ahli')
        );

        $item = array(
            'judul_bidang_keahlian' => 'Judul Bidang Ahli',
            'id_bidang_keahlian' => 'id_bidang_keahlian',
            'cuplikan_bidang_keahlian' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
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
        return View::make('pages.bidang_keahlian.index');
    }


    /**
     * Tampilkan Isi BidangKeahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function lihatIsiBidangKeahlian($id_bidang_keahlian)
    {
        $breadcrumbs = array(
            array('link' => URL::to('/'), 'text' => 'Beranda'),
            array('link' => URL::to('/bidang_keahlian'), 'text' => 'Bidang Ahli'),
            array('link' => '', 'text' => 'Judul Bidang Ahli')
        );
        $item = array(
            'judul_bidang_keahlian' => 'Judul Bidang Ahli',
            'id_bidang_keahlian' => 'id_bidang_keahlian',
            'isi_bidang_keahlian' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in. Ini Deskripsi TA.',
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
            'topik_bidang_keahlian' => array(
                array(
                    'judul_topik'=> 'Judul Topik',
                    'id_topik'=> 'id_topik',
                    'mahasiswa_topik'=> array(
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        )
                    )
                ),
                array(
                    'judul_topik'=> 'Judul Topik',
                    'id_topik'=> 'id_topik',
                    'mahasiswa_topik'=> array(
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        )
                    )
                ),
                array(
                    'judul_topik'=> 'Judul Topik',
                    'id_topik'=> 'id_topik',
                    'mahasiswa_topik'=> array(
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        )
                    )
                ),
                array(
                    'judul_topik'=> 'Judul Topik',
                    'id_topik'=> 'id_topik',
                    'mahasiswa_topik'=> array(
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        ),
                        array(
                            'nama_mahasiswa' => 'Nama Mahasiswa',
                            'nrp_mahasiswa' => '1234567890',
                            'id_mahasiswa' => '0987654321',
                        )
                    )
                )
            )
        );

        View::share('breadcrumbs', $breadcrumbs);
        View::share('item', $item);
        return View::make('pages.bidang_keahlian.item');
    }


    /**
     * Tampilkan daftar bidang_keahlian berdasarkan kategori
     *
     * @var string id_kategori
     * @return View
     */
    function lihatBidangKeahlianDariKategori($id_kategori)
    {
        return "bidang_keahlian/kategori/id_kategori";
    }

    /* Kelompok dasbor */

    /**
     * Tampilan daftar bidang_keahlian yang dibuat pada dasbor
     * @return View
     */
    function dasborLihatDaftarBidangKeahlian()
    {
        return View::make('pages.dasbor.bidang_keahlian.index');
    }

    /**
     * Tambahkan bidang_keahlian baru. Menampilkan laman penambahan bidang_keahlian.
     *
     * @return View
     */
    function dasborTambahkanBidangKeahlian()
    {
        return View::make('pages.dasbor.bidang_keahlian.baru');
    }

    /**
     * Simpan bidang_keahlian baru.
     *
     * @return View
     */
    function dasborSimpanBidangKeahlianBaru()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/bidang_keahlian');
    }

    /**
     * Sunting bidang_keahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function dasborSuntingBidangKeahlian($id_bidang_keahlian)
    {
        return View::make('pages.dasbor.bidang_keahlian.sunting');
    }

    /**
     * Simpan bidang_keahlian yang telah disunting.
     *
     * @return View
     */
    function dasborSimpanPerubahanBidangKeahlian()
    {
        //return var_dump(Input::all());
        return Redirect::to('dasbor/bidang_keahlian');
    }

    /**
     * Hapus bidang_keahlian
     *
     * @var string $id_bidang_keahlian
     * @return View
     */
    function dasborHapusBidangKeahlian($id_bidang_keahlian)
    {
        return Redirect::to('dasbor/bidang_keahlian');
    }
}
