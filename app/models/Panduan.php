<?php

/**
 * Model untuk Panduan
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Panduan
 *
 */

namespace Simta\Models;
use Eloquent;

class Panduan extends Eloquent {
    protected $table = 'panduan';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_panduan";
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
