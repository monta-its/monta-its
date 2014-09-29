<?php
/**
 * Model untuk Mahasiswa
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Mahasiswa
 *
 */

namespace Simta\Models;
use Eloquent;

class Mahasiswa extends Eloquent {
    protected $table = 'mahasiswa';
    public $timestamps = false;
    protected $softDelete = false;
    protected $fillable = [
        'nrp',
        'nama_lengkap',
        'angkatan'
    ];
    protected $primaryKey = "nrp";
    public $incrementing = false;

    public function user()
    {
        return $this->morphOne('Simta\Models\User', 'person', 'person_type');
    }

    /**
     * Relasi one-to-many dengan tabel TugasAkhir
     *
     * @return Simta\Models\TugasAkhir
     */
    public function tugasAkhir()
    {
        return $this->hasMany('Simta\Models\TugasAkhir', 'nrp', 'nrp');
    }

    /**
     * Relasi one-to-many dengan tabel Pemberitahuan
     *
     * @return Simta\Models\Pemberitahuan
     */
    public function pemberitahuan()
    {
        return $this->morphMany('Simta\Models\Pemberitahuan', 'person', 'person_type');
    }

    /**
     * Relasi one-to-one dengan tabel JenjangPendidikan
     *
     * @return Simta\Models\JenjangPendidikan
     */
    public function jenjangPendidikan()
    {
        return $this->belongsTo('Simta\Models\JenjangPendidikan', 'kode_jenjang_pendidikan', 'kode_jenjang_pendidikan');
    }

    /**
     * Relasi one-to-one dengan tabel Syarat
     *
     * @return Simta\Models\Syarat
     */
    function syarat()
    {
        return $this->belongsToMany('Simta\Models\Syarat', 'syarat_mahasiswa', 'nrp', 'id_syarat');
    }

    /**
     * Mencari tahu apakah mahasiswa bersangkutan sudah lulus syarat tertentu
     *
     * @return Simta\Models\Syarat
     */
    function apakahLulusSyarat($waktu_syarat)
    {
        $totalSyarat = Syarat::where('waktu_syarat','=',$waktu_syarat)->count();
        if ($totalSyarat == 0)
        {
            return false;
        }
        else
        {
            $countSyarat = $this->syarat()->where('waktu_syarat','=',$waktu_syarat)->count();

            return $totalSyarat == $countSyarat;
        }
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['lolos_syarat_bimbingan'] = $this->apakahLulusSyarat('pra_bimbingan');
        $array['lolos_syarat_seminar_proposal'] = $this->apakahLulusSyarat('pra_seminar_proposal');
        $array['lolos_syarat_sidang_akhir'] = $this->apakahLulusSyarat('pra_sidang_akhir');
        return $array;
    }

}
?>
