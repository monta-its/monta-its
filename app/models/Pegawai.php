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
    protected $fillable = ['nip_pegawai', 'nama_lengkap', 'kata_sandi', 'gelar_depan', 'gelar_belakang'];
    protected $hidden = ['kata_sandi'];
    protected $primaryKey = "nip_pegawai";
    public $incrementing = false;

    /**
     * Relasi one-to-one ke Dosen
     *
     * @return Simta\Models\Dosen
     */

    public function dosen()
    {
        return $this->hasOne('Simta\Models\Dosen', 'nip_dosen', 'nip_pegawai');
    }

    /**
     * Mengetahui apakah seorang Pegawai merupakan Seorang Dosen
     * Dilakukan dengan pengecekan adanya Dosen dengan NIP dari Pegawai tersebut
     *
     * @return boolean
     */
    public function apakahDosen()
    {
        if($this->dosen()->count() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
?>
