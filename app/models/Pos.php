<?php

/**
 * Model untuk Pos
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Pos
 *
 */

namespace Simta\Models;
use Eloquent;

class Pos extends Eloquent {
    protected $table = 'pos';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_pos";
    protected $fillable = ["judul", "isi", "apakah_terbit"];

    /**
     * Relasi many-to-one dengan tabel Pegawai
     *
     * @return Simta\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo('Simta\Models\Pegawai', 'nip_pegawai', 'nip_pegawai');
    }

    /**
     * Relasi many-to-one dengan tabel Pegawai
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_pegawai', 'nip_dosen');
    }

}
?>
