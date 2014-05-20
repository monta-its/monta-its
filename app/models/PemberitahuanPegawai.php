<?php

/**
 * Model untuk PemberitahuanPegawai
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\PemberitahuanPegawai
 *
 */
namespace Simta\Models;
use Eloquent;

class PemberitahuanPegawai extends Eloquent {
    protected $table = 'pemberitahuan_pegawai';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ["isi"];
    protected $primaryKey = 'id_pemberitahuan_pegawai';

    /**
     * Relasi many-to-one dengan tabel Pegawai
     *
     * @return Simta\Models\Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo('Simta\Models\Pegawai', 'nip_pegawai', 'nip_pegawai');
    }


}
?>
