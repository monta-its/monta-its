
<?php

class PemberitahuanDosen extends Eloquent {
    protected $table = 'pemberitahuan_dosen';
    public $timestamps = true;
    protected $softDelete = true;


    public function dosen()
    {
        return $this->hasOne('Dosen', 'nip', 'nip_dosen');
    }


}
?>
