<?php

/**
 * Model untuk TugasAkhir
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\TugasAkhir
 *
 */
namespace Simta\Models;
use Eloquent;

class TugasAkhir extends Eloquent {
    protected $table = 'tugas_akhir';
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_tugas_akhir";
    protected $fillable = ["tanggal_mulai", "tanggal_selesai", "target_selesai", "status"];

    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosenPembimbing()
    {
        return $this->belongsToMany('Simta\Models\Dosen', 'dosen_pembimbing', 'id_tugas_akhir', 'nip');
    }

    /**
     * Alias untuk dosenPembimbing
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->dosenPembimbing();
    }

    /**
     * Relasi many-to-one dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('Simta\Models\Mahasiswa', 'nrp', 'nrp');
    }

    /**
     * Relasi one-to-many dengan tabel Sidang
     *
     * @return Simta\Models\Sidang
     */
    public function sidang()
    {
        return $this->hasMany('Simta\Models\Sidang', 'id_tugas_akhir', 'id_tugas_akhir');
    }

    /**
     * Relasi one-to-many ke NilaiProposal
     *
     * @return Simta\Models\NilaiProposal
     */
    public function nilaiProposal()
    {
        return $this->hasMany('Simta\Models\NilaiProposal', 'id_tugas_akhir', 'id_tugas_akhir');
    }

    /**
     * Relasi one-to-many ke NilaiAkhir
     *
     * @return Simta\Models\NilaiAkhir
     */
    public function nilaiAkhir()
    {
        return $this->hasMany('Simta\Models\NilaiAkhir', 'id_tugas_akhir', 'id_tugas_akhir');
    }

    /**
     * Relasi one-to-one dengan PenawaranJudul
     *
     * @return Simta\Models\PenawaranJudul
     */
    public function penawaranJudul()
    {
        return $this->belongsTo('Simta\Models\PenawaranJudul', 'id_penawaran_judul', 'id_penawaran_judul');
    }

    /**
     * Relasi many-to-one dengan StatusTugasAkhir
     *
     * @return Simta\Models\StatusTugasAkhir
     */

    public function statusTugasAkhir()
    {
        return $this->belongTo('Simta\Models\StatusTugasAkhir', 'nilai', 'status');
    }

    /**
     * Relasi one-to-many dengan Berkas
     * @return Simta\Models\Berkas
     */
    public function berkas()
    {
        return $this->hasMany('Simta\Models\BerkasTugasAkhir', 'id_tugas_akhir', 'id_tugas_akhir');
    }
}
?>
