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
    protected $primaryKey = "id_sidang";
    protected $fillable = ["jenis_sidang", "waktu_mulai", "waktu_selesai"];

    /**
     * Relasi many-to-one dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->belongsTo('Simta\Models\TugasAkhir', 'id_tugas_akhir', 'id_tugas_akhir');
    }

    /**
     * Relasi many-to-one dengan tabel Ruangan
     *
     * @return Simta\Models\Ruangan
     */
    public function ruangan()
    {
        return $this->belongsTo('Simta\Models\Ruangan', 'kode_ruangan', 'kode_ruangan');
    }

    /**
     * Relasi many-to-many dengan tabel Dosen
     * Tabel junction bernama "penguji_sidang"
     *
     * @return Simta\Models\Dosen
     */
    public function pengujiSidang()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'penguji_sidang', 'id_sidang', 'nip_dosen');
    }

}
?>
