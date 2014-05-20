<?php

/**
 * Model untuk SitIn
 * Implementasi khusus untuk Jurusan Teknik Mesin, ITS
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\TeknikMesin\SitIn
 *
 */
namespace Simta\Models\TeknikMesin;
use Eloquent;

class SitIn extends Eloquent {
    protected $table = 'sit_in';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_sit_in";

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
}
?>
