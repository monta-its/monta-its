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
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_bidang_keahlian";
    protected $fillable = ["nama_bidang_keahlian", "deskripsi_bidang_keahlian"];
    public $incrementing = true;
    

    /**
     * Relasi many-to-many dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'bidang_keahlian_dosen', 'id_bidang_keahlian', 'nip');
    }

    /**
     * Relasi one-to-one
     *
     * @return Simta\Models\BidangMinat
     */
    public function bidangMinat()
    {
        return $this->belongsTo('Simta\Models\BidangMinat', 'id_bidang_minat', 'id_bidang_minat');
    }

    /**
     * Relasi one-to-many dengan model PenawaranJudul
     * @return Eloquent\Collection Array of PenawaranJudul
     */
    public function penawaranJudul()
    {
        return $this->hasMany('Simta\Models\PenawaranJudul', 'id_bidang_keahlian', 'id_bidang_keahlian');
    }

}
?>
