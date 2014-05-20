<?php
/**
 * Model untuk Jenjang Pendidikan
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\JenjangPendidikan
 *
 */

namespace Simta\Models;
use Eloquent;

class JenjangPendidikan extends Eloquent {
    protected $table = 'jenjang_pendidikan';
    public $timestamps = true;
    protected $softDelete = true;
    protected $fillable = ['kode_jenjang_pendidikan', 'nama_jenjang_pendidikan'];
    protected $primaryKey = "kode_jenjang_pendidikan";
    public $incrementing = false;

    /**
     * Relasi one-to-many dengan tabel Mahasiswa
     *
     * @return Simta\Models\Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsToMany('Simta\Models\Mahasiswa', 'kode_jenjang_pendidikan', 'kode_jenjang_pendidikan');
    }

}
?>
