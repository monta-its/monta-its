<?php
/**
 * Model untuk nilai akhir, yaitu nilai setelah sidang akhir.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\NilaiAkhir
 *
 */
namespace Simta\Models;
use Eloquent;


class NilaiAkhir extends Eloquent {
    protected $table = 'nilai_akhir';
    protected $primaryKey = 'id_nilai_akhir';
    public $timestamps = false;
    protected $softDelete = false;
    protected $fillable = ["nilai"];

    /**
     * Relasi many-to-one ke TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->belongsTo('Simta\Models\TugasAkhir', 'id_tugas_akhir', 'id_tugas_akhir');
    }

    /**
     * Relasi many-to-one ke Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip', 'nip');
    }
}
?>
