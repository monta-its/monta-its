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
                    'bidang_keahlian' => array(
                        array(
                            'id_bidang_keahlian' => 'id_bidang_keahlian',
                            'nama_bidang_keahlian' => 'Nama Bidang Ahli'
                        ),
                        array(
                            'id_bidang_keahlian' => 'id_bidang_keahlian',
                            'nama_bidang_keahlian' => 'Nama Bidang Ahli'
                        )
                    )
                ),
                array(
                    'id_dosen' => 'id_dosen',
                    'nama_dosen' => 'Nama Dosen',
                    'bidang_keahlian' => array(
                        array(
                            'id_bidang_keahlian' => 'id_bidang_keahlian',
                            'nama_bidang_keahlian' => 'Nama Bidang Ahli'
                        ),
                        array(
                            'id_bidang_keahlian' => 'id_bidang_keahlian',
                            'nama_bidang_keahlian' => 'Nama Bidang Ahli'
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
     * Controller untuk Dasbor BidangMinat, berbasiskan mekanisme REST
     * @return View
     */
    function dasborBidangMinat()
    {
        if(Request::isMethod('get'))
        {
            if(!Request::ajax())
            {
                return View::make('pages.dasbor.prodi.index');
            }
            else
            {
                return Response::json(BidangMinat::with('dosenKoordinator', 'dosenKoordinator.pegawai')->get());
            }
        }
        else if(Request::isMethod('post'))
        {
            $bidangMinat = new BidangMinat;
            $dosenKoordinator = Dosen::find(Dosen::find(Input::get('nip_dosen')));
            if($dosenKoordinator != null)
            {
                $bidanMinat->kode_bidang_minat = Input::get('kode_bidang_minat');
                $bidanMinat->nama_bidang_minat = Input::get('nama_bidang_minat');
                $bidanMinat->dosenKoordinator()->save($dosen);
                $bidanMinat->save();
            }

        }
        else if(Request::isMethod('put'))
        {
            $bidangMinat = BidangMinat::find(Input::get('kode_bidang_minat'));
            $dosenKoordinator = Dosen::find(Dosen::find(Input::get('nip_dosen')));
            if($dosenKoordinator != null)
            {
                $bidangMinat->kode_bidang_minat = Input::get('kode_bidang_minat');
                $bidangMinat->nama_bidang_minat = Input::get('nama_bidang_minat');
                $bidangMinat->dosenKoordinator()->save($dosen);
                $bidangMinat->save();
            }

        }
        else if(Request::isMethod('post'))
        {
            BidangMinat::delete(Input::get('kode_bidang_minat'));
        }
    }
}
