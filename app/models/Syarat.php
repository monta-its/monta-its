<?php

/**
 * Model untuk Syarat
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Syarat
 *
 */

namespace Simta\Models;
use Eloquent;

class Syarat extends Eloquent {
    protected $table = 'syarat';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_syarat";
    protected $fillable = ["kode_syarat", "nama_syarat", "waktu_syarat", "jenis_mahasiswa"];


    /**
     * Relasi many-to-many dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    function mahasiswa()
    {
        return $this->belongsToMany('Simta\Models\Mahasiswa', 'syarat_mahasiswa', 'id_syarat', 'nrp_mahasiswa')->withPivot('status');
    }
}
