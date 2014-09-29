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
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_jadwal_dosen";
    protected $fillable = ["hari", "sesi", "apakah_tersedia"];

    /**
     * Relasi many-to-one dengan tabel Pegawai
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip', 'nip');
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
