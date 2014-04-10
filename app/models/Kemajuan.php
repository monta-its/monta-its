
<?php

class Kemajuan extends Eloquent {
    protected $table = 'kemajuan';
    public $timestamps = true;
    protected $softDelete = true;

    public function tugasAkhir()
    {
        return $this->belongsTo('TugasAkhir', 'kode_ta', 'kode_ta');
    }


}
?>
