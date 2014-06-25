<?php
/**
 * Model untuk nilai proposal, yaitu nilai setelah seminar proposal.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\NilaiProposal
 *
 */
namespace Simta\Models;
use Eloquent;


class NilaiProposal extends Eloquent {
    protected $table = 'nilai_proposal';
    protected $primaryKey = 'id_nilai_proposal';
    public $timestamps = true;
    protected $softDelete = true;
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
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen', 'nip_dosen');
    }
}
?>
