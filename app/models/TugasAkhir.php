
<?php

class TugasAkhir extends Eloquent {
    protected $table = 'tugas_akhir';
    public $timestamps = true;
    protected $softDelete = true;

    public function dosenPembimbing()
    {
        return $this->belongsToMany('Dosen', 'dosen_pembimbing', 'kode_ta', 'kode_ta');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('Mahasiswa', 'nrp_mahasiswa');
    }

    public function sidang()
    {
        return $this->hasMany('Sidang', 'kode_ta', 'kode_ta');
    }

    public function kemajuan()
    {
        return $this->hasMany('Kemajuan', 'kode_ta', 'kode_ta');
    }

}
?>
