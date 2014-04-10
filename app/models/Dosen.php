
<?php

class Dosen extends Eloquent {
    protected $table = 'dosen';
    public $timestamps = true;
    protected $softDelete = true;

    public function pembimbingTugasAkhir()
    {
        return $this->belongsToMany('TugasAkhir', 'dosen_pembimbing', 'nip_dosen', 'nip');
    }

    public function pengujiSidang()
    {
        return $this->belongsToMany('Penguji', 'penguji_sidang', 'nip', 'nip_dosen');
    }

    public function pos()
    {
        return $this->hasMany('Pos', 'nip_dosen_penulis', 'nip');
    }

    public function pemberitahuan()
    {
        return $this->hasMany('PemberitahuanDosen', 'nip_dosen', 'nip');
    }

    public function bidangMinat()
    {
        return $this->belongsToMany('BidangMinat', 'dosen_bidang_minat', 'nip_dosen', 'nip');
    }




}
?>
