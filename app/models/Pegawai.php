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
    public $timestamps = false;
    protected $softDelete = false;
    protected $fillable = array(
        'nip',
        'nama_lengkap',
    );
    protected $primaryKey = "nip";
    public $incrementing = false;

    public function user()
    {
        return $this->morphOne('Simta\Models\User', 'person', 'person_type');
    }

    public function pos()
    {
        return $this->hasMany('Simta\Models\Pos', 'person_id', 'person_type');
    }

    public function panduan()
    {
        return $this->hasMany('Simta\Models\Panduan', 'person_id', 'person_type');
    }

    public function pemberitahuan()
    {
        return $this->morphMany('Simta\Models\Pemberitahuan', 'person', 'person_type');
    }

    /**
     * Relasi one-to-many ke Lampiran
     *
     * @return Simta\Models\Lampiran
     */
    public function lampiran()
    {
        return $this->hasMany('Simta\Models\Lampiran', 'nip', 'nip');
    }
}
?>
