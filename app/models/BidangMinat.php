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
    protected $fillable = ['kode_bidang_minat', "nama_bidang_minat", "deskripsi_bidang_minat", "nip_dosen_koordinator"];
    protected $primaryKey = "id_bidang_minat";
    public $incrementing = true;

    /**
     * Relasi one-to-many dengan tabel Dosen
     * Tabel junction bernama "dosen_bidang_minat"
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->hasMany('Simta\Models\Dosen', 'id_bidang_minat', 'id_bidang_minat');
    }

    /**
     * Relasi one-to-one dengan tabel Dosen
     * Untuk dosen koordinator
     *
     * @return Simta\Models\Dosen
     */
    public function dosenKoordinator()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen_koordinator', 'nip_dosen');
    }

    /**
     * Relasi many-to-many dengan BidangKeahlian
     *
     * @return Simta\Models\BidangKeahlian
     */
    public function bidangKeahlian()
    {
        return $this->hasMany('Simta\Models\BidangKeahlian', 'id_bidang_minat', 'id_bidang_minat');
    }

}
?>
