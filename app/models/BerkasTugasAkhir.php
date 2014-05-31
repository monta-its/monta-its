<?php

/**
 * Model untuk BerkasTugasAkhir
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\BerkasTugasAkhir
 *
 */

namespace Simta\Models;
use Eloquent;

class BerkasTugasAkhir extends Eloquent {
    protected $table = 'berkas_tugas_akhir';
    protected $primaryKey = "id_berkas_tugas_akhir";
    public $incrementing = true;
    protected $fillable = ["jenis_berkas", "path", "nama_berkas"];

    /**
     * Relasi many-to-one dengan TugasAkhir
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        $this->belongsTo('Simta\Models\TugasAkhir', 'id_tugas_akhir', 'id_tugas_akhir');
    }

}
