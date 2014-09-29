<?php

/**
 * Model untuk PenawaranJudul
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\PenawaranJudul
 *
 */

namespace Simta\Models;
use EloquentValidator;

class PenawaranJudul extends EloquentValidator {
    protected $table = 'penawaran_judul';
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_penawaran_judul";
    protected $fillable = ["judul_tugas_akhir", "deskripsi"];
    protected $rules = array("judul_tugas_akhir" => "required",
                             "deskripsi" => "required");

    /**
     * Relasi one-to-one dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->hasOne('Simta\Models\TugasAkhir', 'id_penawaran_judul', 'id_penawaran_judul');
    }

    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip', 'nip');
    }

    public function bidangKeahlian()
    {
        return $this->belongsTo('Simta\Models\BidangKeahlian', 'id_bidang_keahlian', 'id_bidang_keahlian');
    }
}
?>
