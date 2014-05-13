<?php
/**
 * Model untuk Evaluasi
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Evaluasi
 *
 */
namespace Simta\Models;
use Eloquent;


class Evaluasi extends Eloquent {
    protected $table = 'evaluasi';
    public $timestamps = true;
    protected $softDelete = true;

    /**
     * Relasi many-to-one ke TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->belongsTo('Simta\Models\TugasAkhir', 'kode_ta', 'kode_ta');
    }

    /**
     * Relasi many-to-one ke Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen', 'nip_dosen');
    }


}
?>
