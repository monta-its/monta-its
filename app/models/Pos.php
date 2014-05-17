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
    protected $primaryKey = "id_post";
    protected $fillable = ["judul", "isi"];

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
