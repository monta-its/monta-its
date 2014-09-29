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
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_panduan";
    protected $fillable = ["judul", "isi"];

    public function person()
    {
        return $this->morphTo();
    }

    /**
     * Relasi one-to-one dengan tabel Lampiran
     *
     * @return Simta\Models\Lampiran
     */
    public function lampiran()
    {
        return $this->belongsTo('Simta\Models\Lampiran', 'id_lampiran', 'id_lampiran');
    }

}
?>
