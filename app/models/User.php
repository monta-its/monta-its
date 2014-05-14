<?php

/**
 * Implementasi Simta dari antarmuka User
 * Diambil dari templat asli Laravel app/models/User.php
 * Tanpa menggunakan Eloquent secara langsung
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Systems\User
 */

namespace Simta\Systems;

use Illuminate\Auth\UserInterface;

class User implements UserInterface {

    /**
      * Nomor induk bisa berupa NRP (Mahasiswa) atau NIP (Dosen/Pegawai)
      * @var string $nomor_induk
      */
    public $nomor_induk;

    /**
      * Kata sandi yang sudah dihash
      * @var string $kata_sandi
      */

    public $kata_sandi;

    /**
      * Memastikan peran dari pengguna ybs
      * 0 = Mahasiswa
      * 1 = Pegawai Non Dosen
      * 2 = Pegawai dan Dosen
      *
      * @var int $peran
      */
    public $peran;

    /**
    * Ambil identifikasi khusus dari pengguna
    * @return mixed
    */
    public function getAuthIdentifier()
    {
        return $this->nomor_induk;
    }

    /**
    * Ambil password autentikasi (yang sudah dihashed)
    * @return string
    */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }


}
