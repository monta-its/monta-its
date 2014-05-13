<?php

/**
 * Model untuk PemberitahuanDosen
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\PemberitahuanDosen
 *
 */
namespace Simta\Models;
use Eloquent;

class PemberitahuanDosen extends Eloquent {
    protected $table = 'pemberitahuan_dosen';
    public $timestamps = true;
    protected $softDelete = true;


    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Dosen', 'nip_dosen', 'nip_dosen');
    }


}
?>
