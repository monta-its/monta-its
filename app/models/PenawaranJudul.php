<?php

/**
 * Model untuk PenawaranJudul
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\PenawaranJudul
 *
 */

namespace Simta\Models;
use Eloquent;

class PenawaranJudul extends Eloquent {
    protected $table = 'penawaran_judul';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_penawaran_judul";
    protected $fillable = ["judul", "deskripsi"];

    /**
     * Relasi many-to-one dengan tabel Topik
     *
     * @return Simta\Models\Topik
     */
    public function topik()
    {
        return $this->belongsTo('Simta\Models\Topik', 'id_topik', 'id_topik');
    }

    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen', 'nip_dosen');
    }
}
?>
