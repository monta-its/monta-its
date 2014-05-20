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
    protected $fillable = ["nidn", "gelar_depan", "gelar_belakang", "hak_akses_pegawai"];
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
     * Relasi one-to-many ke Panduan
     *
     * @return Simta\Models\Panduan
     */
    public function panduan()
    {
        return $this->hasMany('Simta\Models\Panduan', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi one-to-one ke BidangMinat
     * Sebagai Dosen Koordinator dari BidangMinat bersangkutan
     *
     * @return Simta\Models\BidangMinat
     */
    public function koordinatorBidangMinat()
    {
        return $this->hasOne('Simta\Models\Dosen', 'nip_dosen_koordinator', 'nip_dosen');
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
        return $this->belongsTo('Simta\Models\Pegawai', 'nip_dosen', 'nip_pegawai');
    }

    /**
     * Relasi many-to-many dengan tabel BidangKeahlian
     *
     * @return Simta\Models\BidangKeahlian
     */
    public function bidangKeahlian()
    {
        return $this->belongsToMany('Simta\Models\BidangKeahlian', 'bidang_keahlian_dosen', 'nip_dosen', 'id_bidang_keahlian');
    }

    /**
     * Mengetahui beban bimbingan TugasAkhir yang dilakukan oleh Dosen sebagai Pembimbing saat ini
     * Dilakukan dengan perhitungan pembimbingTugasAkhir pada tugasAkhir dengan status tidak sama dengan 'selesai' dan 'mengundurkan diri'
     *
     * @return int
    */
    public function bebanBimbinganSaatIni()
    {
        return $this->pembimbingTugasAkhir()->where('status', '!=', 'selesai')->where('status', '!=', 'mengundurkan_diri')->count();
    }

}
?>
