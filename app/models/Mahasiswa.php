<?php

class Mahasiswa extends Eloquent {
    protected $table = 'mahasiswa';
    public $timestamps = true;
    protected $softDelete = true;

    public function jurusan()
    {
        return $this->belongsTo('Jurusan', 'kode_jurusan');
    }

    public function tugasAkhir()
    {
        return $this->hasMany('TugasAkhir', 'nrp', 'nrp');
    }

    public function notifikasi()
    {
        return $this->hasMany('NotifikasiMahasiswa', 'nrp_mahasiswa', 'nrp');
    }

}
?>
