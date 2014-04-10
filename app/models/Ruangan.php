
<?php

class Ruangan extends Eloquent {
    protected $table = 'ruangan';
    public $timestamps = true;
    protected $softDelete = true;


    public function jurusan()
    {
        return $this->belongsTo('Jurusan', 'kode_jurusan');
    }



}
?>
