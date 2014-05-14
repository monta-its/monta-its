<?php
/**
 * Implementasi Simta dari UserProvider
 * Menggunakan dua kelas Eloquent untuk Autentikasi: Mahasiswa dan Pegawai
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Systems\UserProvider
 */

namespace Simta\Systems;
use Illuminate\Auth\UserProviderInterface,
    Illuminate\Auth\GenericUser,
    Illuminate\Auth\UserInterface,
    Simta\Systems\User,
    Simta\Models\Mahasiswa,
    Simta\Models\Pegawai,
    Hash;

class UserProvider implements UserProviderInterface {
    /**
     * Cek dan kembalikan User jika $identifier berupa NIP/NRP ada
     *
     * @var string $identifier
     * @return Simta\Systems\User|null
     */

    public function retrieveById($identifier)
    {
        $user = new User();

        // Cari tahu apakah dia mahasiswa atau pegawai
        $mahasiswa = Mahasiswa::find($identifier);
        if($mahasiswa != NULl)
        {
            $user->nomor_induk = $mahasiswa->nrp_mahasiswa;
            $user->kata_sandi = $mahasiswa->kata_sandi;
            $user->peran = 0;

            return $user;
        }

       $pegawai = Pegawai::find($identifier);
       if($pegawai != NULL)
       {
           $user->nomor_induk = $pegawai->nip_pegawai;
           $user->kata_sandi = $pegawai->kata_sandi;
           if($user->apakahDosen())
           {
               $user->peran = 2;
           }
           else
           {
               $user->peran = 1;
           }

           return $user;
       }

       return null;

    }

    /**
     * Cek login dari data kredensial yang diberikan pada Auth::attempt
     *
     * @var array $credentials
     * @return Simta\Systems\User|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->retrieveById($credentials['username']);
    }

    /**
     * Pastikan login sudah benar
     *
     * @var UserInterface $user
     * @var array $credentials
     * @return Simta\Systems\User|null
     */
    public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
    {
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}
