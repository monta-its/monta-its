<?php

/**
 * Model untuk JadwalDosen
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\JadwalDosen
 *
 */

namespace Simta\Models;
use Eloquent;

class JadwalDosen extends Eloquent {
    protected $table = 'jadwal_dosen';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_jadwal_dosen";
    protected $fillable = ["hari", "sesi", "apakah_tersedia"];

    /**
     * Relasi many-to-one dengan tabel Pegawai
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi many-to-one dengan tabel SesiSidang
     *
     * @return Simta\Models\SesiSidang
     */
    public function sesiSidang()
    {
        return $this->belongsTo('Simta\Models\SesiSidang', 'sesi', 'sesi');
    }
}
?>
