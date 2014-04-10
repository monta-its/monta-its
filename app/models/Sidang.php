<?php

class Sidang extends Eloquent {
    protected $table = 'sidang';
    public $timestamps = true;
    protected $softDelete = true;

    public function tugasAkhir()
    {
        return $this->belongsTo('TugasAkhir', 'kode_ta', 'kode_ta');
    }

    public function pengujiSidang()
    {
        return $this->belongsToMany('Dosen', 'penguji_sidang', 'kode_sidang', 'kode_sidang');
    }

}
?>
