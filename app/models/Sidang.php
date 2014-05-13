<?php

/**
 * Model untuk Sidang
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Sidang
 *
 */
namespace Simta\Models;
use Eloquent;

class Sidang extends Eloquent {
    protected $table = 'sidang';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "kode_sidang";
    protected $fillable = ["jenis_sidang", "waktu_mulai", "waktu_selesai"];

    /**
     * Relasi many-to-one dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->belongsTo('Simta\Models\TugasAkhir', 'kode_ta', 'kode_ta');
    }

    /**
     * Relasi many-to-many dengan tabel Dosen
     * Tabel junction bernama "penguji_sidang"
     *
     * @return Simta\Models\Dosen
     */
    public function pengujiSidang()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'penguji_sidang', 'kode_sidang', 'nip_dosen');
    }

}
?>
