<?php
/**
 * Model untuk Pegawai
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Pegawai
 *
 */

namespace Simta\Models;
use Eloquent;

class Pegawai extends Eloquent {
    protected $table = 'pegawai';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ['nip_pegawai', 'nama_lengkap', 'kata_sandi'];

    /**
     * Relasi one-to-one ke Dosen
     *
     * @return Simta\Models\Dosen
     */

    public function dosen()
    {
        return $this->hasOne('Simta\Models\Dosen', 'nip_dosen', 'nip_pegawai');
    }
}
?>
