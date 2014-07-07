<?php

/**
 * Model untuk Topik
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Topik
 *
 */

namespace Simta\Models;
use EloquentValidator;

class Topik extends EloquentValidator {
    protected $table = 'topik';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_topik";
    protected $fillable = ["topik", "deskripsi"];
    protected $rules = array("topik" => "required", "deskripsi" => "required");

    /**
     * Relasi many-to-one dengan tabel BidangKeahlian
     *
     * @return Simta\Models\BidangKeahlian
     */
    public function bidangKeahlian()
    {
        return $this->belongsTo('Simta\Models\BidangKeahlian', 'id_bidang_keahlian', 'id_bidang_keahlian');
    }

    /**
     * Relasi one-to-many dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->hasMany('Simta\Models\TugasAkhir', 'id_topik', 'id_topik');
    }

    /**
     * Relasi one-to-many dengan tabel PenawaranJudul
     *
     * @return Simta\Models\PenawaranJudul
     */
    public function penawaranJudul()
    {
        return $this->hasMany('Simta\Models\PenawaranJudul', 'id_topik', 'id_topik');
    }

    /**
     * Relasi one-to-many dengan tabel SitIn
     *
     * @return Simta\Models\TeknikMesin\SitIn
     */
    public function sitIn()
    {
        return $this->hasMany('Simta\Models\TugasAkhir\SitIn', 'id_topik', 'id_topik');
    }
}
?>
