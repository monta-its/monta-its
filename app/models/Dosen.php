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
use DateTime;

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
        return $this->belongsToMany('Simta\Models\TugasAkhir', 'dosen_pembimbing', 'nip_dosen', 'id_tugas_akhir');
    }

    /**
     * Alias untuk pembimbingTugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->pembimbingTugasAkhir();
    }

    /**
     * Relasi one-to-many ke NilaiProposal
     *
     * @return Simta\Models\NilaiProposal
     */
    public function nilaiProposal()
    {
        return $this->hasMany('Simta\Models\NilaiProposal', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi one-to-many ke NilaiAkhir
     *
     * @return Simta\Models\NilaiAkhir
     */
    public function nilaiAkhir()
    {
        return $this->hasMany('Simta\Models\NilaiAkhir', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi one-to-many ke PenawaranJudul
     *
     * @return Simta\Models\PenawaranJudul
     */
    public function penawaranJudul()
    {
        return $this->hasMany('Simta\Models\PenawaranJudul', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi many-to-many ke Sidang
     * Dengan tabel junction bernama "penguji_sidang"
     *
     * @return Simta\Models\Sidang
     */
    public function pengujiSidang()
    {
        return $this->belongsToMany('Simta\Models\Sidang', 'penguji_sidang', 'nip_dosen', 'id_sidang');
    }

    /**
     * Alias untuk pengujiSidang
     *
     * @return Simta\Models\Sidang
     */
    public function sidang()
    {
        return $this->pengujiSidang();
    }

    /**
     * Relasi one-to-many ke Pos
     *
     * @return Simta\Models\Pos
     */
    public function pos()
    {
        return $this->hasMany('Simta\Models\Pos', 'nip_pegawai', 'nip_dosen');
    }

    /**
     * Relasi one-to-many ke Panduan
     *
     * @return Simta\Models\Panduan
     */
    public function panduan()
    {
        return $this->hasMany('Simta\Models\Panduan', 'nip_pegawai', 'nip_dosen');
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
        return $this->belongsToMany('Simta\Models\BidangMinat', 'dosen_bidang_minat', 'nip_dosen', 'id_bidang_minat');
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
     * Relasi dengan tabel SitIn
     * @return Simta\Models\TeknikMesin\SitIn
     */

    public function sitIn()
    {
        return $this->hasMany('Simta\Models\TeknikMesin\SitIn', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi dengan tabel JadwalDosen
     * @return Simta\Models\JadwalDosen
     */

    public function jadwalDosen()
    {
        return $this->hasMany('Simta\Models\JadwalDosen', 'nip_dosen', 'nip_dosen');
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

    /**
     * Mengetahui beban bimbingan TugasAkhir semester depan
     * Dengan melihat nilai tanggal target_selesai
     * Apakah ada TugasAkhir dengan status selain 'selesai' dan 'mengundurkan_diri' pada :
     * - Bulan 7 sampai 12 jika bulan saat ini 1 - 6
     * - Bulan 1 sampai 6 jika bulan saat ini 7 - 12
     *
     * @return int
    */
    public function bebanBimbinganSemesterDepan()
    {
        // Definisikan semester depan
        $now = new DateTime("today");
        $month = (int)$now->format('m');
        if($month >= 1 && $month <= 6)
        {
            $yearMin = (int) $now->format('Y');
            $monthMin = 7;
            $dateMin = new DateTime("$yearMin-$monthMin-01");

            $yearMax = (int)$now->format('Y');
            $monthMax = 12;
            $dateMax = new DateTime("$yearMax-$monthMax-31");
        }
        else if($month >= 7 && $month <= 12)
        {

            $yearMin = int($now->format('Y')) + 1;
            $monthMin = 1;
            $dateMin = new DateTime("$yearMin-$monthMin-01");

            $yearMax = int($now->format('Y')) + 1;
            $monthMax = 6;
            $dateMax = new DateTime("$yearMax-$monthMax-30");
        }
        return $this->pembimbingTugasAkhir()->where('status', '!=', 'selesai')->where('status', '!=', 'mengundurkan_diri')->whereBetween('target_selesai', array($dateMin, $dateMax))->sharedLock()->count();
    }


    /**
     * Mengetahui kuota Sitin semester ini
     * @return int
    */
    public function kuotaSitInSemesterIni()
    {
        $kuotaTotal = 10;

        // Definisikan semester ini
        $now = new DateTime("today");
        $month = (int)$now->format('m');
        if($month >= 1 && $month <= 6)
        {
            $yearMin = (int) $now->format('Y');
            $monthMin = 1;
            $dateMin = new DateTime("$yearMin-$monthMin-01");

            $yearMax = (int)$now->format('Y');
            $monthMax = 6;
            $dateMax = new DateTime("$yearMax-$monthMax-30");
        }
        else if($month >= 7 && $month <= 12)
        {

            $yearMin = int($now->format('Y'));
            $monthMin = 7;
            $dateMin = new DateTime("$yearMin-$monthMin-01");

            $yearMax = int($now->format('Y'));
            $monthMax = 12;
            $dateMax = new DateTime("$yearMax-$monthMax-31");
        }

        $sitInTerambil = $this->sitIn()->where('status', '=', '1')->whereBetween('created_at', array($dateMin, $dateMax))->sharedLock()->count();
        return $kuotaTotal - $this->bebanBimbinganSemesterDepan() - $sitInTerambil;
    }

    /**
     * Mengetahui berdasarkan JadwalDosen apakah dosen bersangkutan tersedia pada sesi dan hari dipilih
     * @return boolean
    */
    public function apakahTersediaJadwalDosen($hari, $sesi)
    {
        $jadwalDosen = $this->jadwalDosen()->where('hari', $hari)->where('sesi', $sesi);

        // Data tidak ada, anggap tersedia
        if($jadwalDosen->count() == 0)
        {
            return true;
        }

        $jadwalDosen = $jadwalDosen->first();
        if($jadwalDosen->apakah_tersedia == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['kuota_sit_in'] = $this->kuotaSitInSemesterIni();
        $array['kuota_bimbingan_semester_ini'] = $this->bebanBimbinganSaatIni();
        $array['kuota_bimbingan_semester_depan'] = $this->bebanBimbinganSemesterDepan();
        return $array;
    }
}
?>
