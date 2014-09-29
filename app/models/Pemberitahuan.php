<?php

/**
 * Model untuk Pemberitahuan
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\Pemberitahuan
 *
 */
namespace Simta\Models;
use Eloquent;

class Pemberitahuan extends Eloquent {
    protected $table = 'pemberitahuan';
    protected $fillable = ["isi"];
    protected $primaryKey = 'id_pemberitahuan';
    public $timestamps = false;
    protected $softDelete = false;
    public $incrementing = true;

    /**
     * Relasi many-to-one dengan model Mahasiswa, Dosen, atau Pegawai
     *
     * @return Simta\Models\Mahasiswa or Simta\Models\Dosen or Simta\Models\Pegawai
     */
    public function person()
    {
        return $this->morphTo();
    }


}
?>
