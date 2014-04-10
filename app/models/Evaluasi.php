<?php

class Evaluasi extends Eloquent {
    protected $table = 'evaluasi';
    public $timestamps = true;
    protected $softDelete = true;

    public function tugasAkhir()
    {
        return $this->belongsTo('TugasAkhir', 'kode_ta', 'kode_ta');
    }


}
?>
