<?php

class BidangMinat extends Eloquent {
    protected $table = 'bidang_minat';
    public $timestamps = true;
    protected $softDelete = true;

    public function jurusan()
    {
        return $this->belongsTo('Jurusan', 'kode_jurusan', 'kode_jurusan');
    }

    public function dosen()
    {
        return $this->belongsToMany('Dosen', 'dosen_bidang_minat', 'kode_bidang_minat', 'kode_bidang_minat');
    }

    public function dosenKoordinator()
    {
        return $this->hasOne('Dosen', 'nip', 'nip_dosen');
    }

}
?>
