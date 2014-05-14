<?php
/**
 * Model untuk Dosen
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Dosen
 *
 */

namespace Simta\Models;
use Eloquent;

class Dosen extends Eloquent {
    protected $table = 'dosen';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ["nidn", "gelar"];
    protected $primaryKey = "nip_dosen";
    public $incrementing = false;

    /**
     * Relasi many-to-many ke TugasAkhir
     * Dengan tabel junction bernama "dosen_pembimbing"
     *
     * @return Simta\Models\TugasAkhir
     */
    public function pembimbingTugasAkhir()
    {
        return $this->belongsToMany('Simta\Models\TugasAkhir', 'dosen_pembimbing', 'nip_dosen', 'kode_ta');
    }

    /**
     * Relasi many-to-many ke Sidang
     * Dengan tabel junction bernama "penguji_sidang"
     *
     * @return Simta\Models\Sidang
     */
    public function pengujiSidang()
    {
        return $this->belongsToMany('Simta\Models\Penguji', 'penguji_sidang', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi one-to-many ke Pos
     *
     * @return Simta\Models\Pos
     */
    public function pos()
    {
        return $this->hasMany('Simta\Models\Pos', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi one-to-many ke PemberitahuanDosen
     *
     * @return Simta\Models\PemberitahuanDosen
     */
    public function pemberitahuan()
    {
        return $this->hasMany('Simta\Models\PemberitahuanDosen', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi many-to-many ke BidangMinat
     *
     * @return Simta\Models\BidangMinat
     */
    public function bidangMinat()
    {
        return $this->belongsToMany('Simta\Models\BidangMinat', 'dosen_bidang_minat', 'nip_dosen', 'kode_bidang_minat');
    }


    /**
     * Relasi one-to-one ke Pegawai
     *
     * @return Simta\Models\Pegawai
     */

    public function pegawai()
    {
        return $this->hasOne('Simta\Models\Pegawai', 'nip_dosen', 'nip_pegawai');
    }

}
?>
