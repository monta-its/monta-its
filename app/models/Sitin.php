<?php

/**
 * Model untuk SitIn
 * Implementasi khusus untuk Jurusan Teknik Mesin, ITS
 *
 * Keterangan Status Sit In:
 *  0 => diajukan
 *  1 => disetujui
 * -1 => dibatalkan (menunggu)
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\TeknikMesin\SitIn
 *
 */
namespace Simta\Models\TeknikMesin;
use Eloquent;
use Simta\Models\TugasAkhir;
use Simta\Models\Dosen;

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
     * Relasi many-to-one dengan tabel Topik
     *
     * @return Simta\Models\Topik
     */
    public function topik()
    {
        return $this->belongsTo('Simta\Models\Topik', 'id_topik', 'id_topik');
    }

    public function buatDataTugasAkhir()
    {
        $tugasAkhir = TugasAkhir::create(array(
            'nrp_mahasiswa' => $this->nrp_mahasiswa,
            'tanggal_mulai' => date('Y-m-d'),
            'status' => 'pengerjaan',
            'id_topik' => $this->id_topik
        ));

        $tugasAkhir->dosenPembimbing()->save($this->dosen);
    }
}
?>
