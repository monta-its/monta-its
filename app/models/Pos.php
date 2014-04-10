<?php

class Pos extends Eloquent {
    protected $table = 'pos';
    public $timestamps = true;
    protected $softDelete = true;


    public function dosen()
    {
        return $this->hasOne('Dosen', 'nip', 'nip_dosen_penulis');
    }


}
?>
