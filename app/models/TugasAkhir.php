<?php

/**
 * Model untuk TugasAkhir
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\TugasAkhir
 *
 */
namespace Simta\Models;
use Eloquent;

class TugasAkhir extends Eloquent {
    protected $table = 'tugas_akhir';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "kode_ta";


    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosenPembimbing()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'dosen_pembimbing', 'kode_ta', 'nip_dosen');
    }

    /**
     * Relasi many-to-one dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('Simta\Models\Mahasiswa', 'nrp_mahasiswa', 'nrp_mahasiswa');
    }

    /**
     * Relasi one-to-many dengan tabel Sidang
     *
     * @return Simta\Models\Sidang
     */
    public function sidang()
    {
        return $this->hasMany('Simta\Models\Sidang', 'kode_ta', 'kode_ta');
    }

    /**
     * Relasi one-to-many dengan tabel Evaluasi
     *
     * @return Simta\Models\Evaluasi
     */
    public function evaluasi()
    {
        return $this->hasMany('Simta\Models\Evaluasi', 'kode_ta', 'kode_ta');
    }
}
?>
