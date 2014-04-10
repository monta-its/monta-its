

<?php

class PemberitahuanDosen extends Eloquent {
    protected $table = 'pemberitahuan_mahasiswa';
    public $timestamps = true;
    protected $softDelete = true;


    public function mahasiswa()
    {
        return $this->hasOne('Mahasiswa', 'nrp', 'nrp_mahasiswa');
    }


}
?>
