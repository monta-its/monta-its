<?php
/**
 * Model untuk Mahasiswa
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Mahasiswa
 *
 */

namespace Simta\Models;
use Eloquent;

class Mahasiswa extends Eloquent {
    protected $table = 'mahasiswa';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ['nrp_mahasiswa', 'nama_lengkap', 'kata_sandi', 'angkatan'];
    protected $hidden = ['kata_sandi'];
    protected $primaryKey = "nrp_mahasiswa";
    public $incrementing = false;


    /**
     * Relasi one-to-many dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->hasMany('TugasAkhir', 'nrp_mahasiswa', 'nrp_mahasiswa');
    }

    /**
     * Relasi one-to-many dengan tabel PemberitahuanMahasiswa
     *
     * @return Simta\Models\PemberitahuanMahasiswa
     */
    public function pemberitahuan()
    {
        return $this->hasMany('Simta\Models\PemberitahuanMahasiswa', 'nrp_mahasiswa', 'nrp_mahasiswa');
    }

}
?>
