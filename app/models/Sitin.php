<?php

/**
 * Model untuk SitIn
 * Implementasi khusus untuk Jurusan Teknik Mesin, ITS
 *
 * Keterangan Status Sit In:
 *  0 => diajukan
 *  1 => disetujui
 * -1 => dibatalkan (menunggu)
 *  2 => bimbingan (sit in telah menjadi bimbingan)
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\TeknikMesin\SitIn
 *
 */
namespace Simta\Models\TeknikMesin;
use Eloquent;
use Simta\Models\TugasAkhir;
use Simta\Models\Dosen;
use Simta\Models\Mahasiswa;

class SitIn extends Eloquent {
    protected $table = 'sit_in';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_sit_in";
    protected $fillable = ["status"];

    /**
     * Relasi many-to-one dengan tabel Dosen
     *
     * @return Simta\Models\Dosen
     */
    public function dosen()
    {
        return $this->belongsTo('Simta\Models\Dosen', 'nip_dosen', 'nip_dosen');
    }

    /**
     * Relasi many-to-one dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('Simta\Models\Mahasiswa', 'nrp_mahasiswa', 'nrp_mahasiswa');
    }

    /**
     * Buat data Tugas Akhir dari SitIn ini jika sudah disetujui
     *
     * @return Simta\Models\TugasAkhir
     */
    public function buatDataTugasAkhir()
    {
        if($this->status == 1)
        {
            $tugasAkhir = new TugasAkhir;
            $mahasiswa = Mahasiswa::find($this->nrp_mahasiswa);
            $tugasAkhir->mahasiswa()->associate($mahasiswa);
            $tugasAkhir->tanggal_mulai = date('Y-m-d');
            $tugasAkhir->status = "pengerjaan";
            $tugasAkhir->save();

            $tugasAkhir->dosenPembimbing()->save($this->dosen()->first());

            $this->status = 2;
            $this->save();
            return $tugasAkhir;
        }
        else
        {
            return null;
        }
    }
}
?>
