<?php

/**
 * Model untuk BidangKeahlian
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\BidangKeahlian
 *
 */

namespace Simta\Models;
use Eloquent;

class BidangKeahlian extends Eloquent {
    protected $table = 'bidang_keahlian';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_bidang_keahlian";
    protected $fillable = ["nama_bidang_keahlian"];

    /**
     * Relasi many-to-many dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'bidang_keahlian_dosen', 'id_bidang_keahlian', 'nip_dosen');
    }

    /**
     * Relasi many-to-many dengan tabel BidangMinat
     *
     * @return Simta\Models\BidangMinat
     */
    public function bidangMinat()
    {
        return $this->belongsToMany('Simta\Models\BidangMinat', 'bidang_keahlian_bidang_minat', 'id_bidang_keahlian', 'id_bidang_minat');
    }

}
?>
