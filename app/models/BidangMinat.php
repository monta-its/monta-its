<?php

/**
 * Model untuk BidangMinat
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\BidangMinat
 *
 */
namespace Simta\Models;
use Eloquent;

class BidangMinat extends Eloquent {
    protected $table = 'bidang_minat';
    public $timestamps = true;
    protected $softDelete = true;


    /**
     * Relasi many-to-many dengan tabel Dosen
     * Tabel junction bernama "dosen_bidang_minat"
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsToMany('Dosen', 'dosen_bidang_minat', 'kode_bidang_minat', 'kode_bidang_minat');
    }

    /**
     * Relasi one-to-one dengan tabel Dosen
     * Untuk dosen koordinator
     *
     * @return Simta\Models\Dosen
     */
    public function dosenKoordinator()
    {
        return $this->hasOne('Dosen', 'nip_dosen_koordinator', 'nip_dosen');
    }

}
?>
