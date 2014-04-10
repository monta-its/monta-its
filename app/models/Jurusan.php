<?php

class Jurusan extends Eloquent {
    protected $table = 'jurusan';
    public $timestamps = true;
    protected $softDelete = true;


    public function mahasiswa()
    {
        return $this->hasMany('Mahasiswa', 'kode_jurusan', 'kode_jurusan');
    }

    public function ruangan()
    {
        return $this->hasMany('Ruangan', 'kode_jurusan', 'kode_jurusan');
    }
}
?>
