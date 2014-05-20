<?php

/**
 * Model untuk PemberitahuanMahasiswa
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\PemberitahuanMahasiswa
 *
 */
namespace Simta\Models;
use Eloquent;

class PemberitahuanMahasiswa extends Eloquent {
    protected $table = 'pemberitahuan_mahasiswa';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ["isi"];
    protected $primaryKey = 'id_pemberitahuan_mahasiswa';

    /**
     * Relasi many-to-one dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('Simta\Models\Mahasiswa', 'nrp_mahasiswa', 'nrp_mahasiswa');
    }


}
?>
