<?php

/**
 * Model untuk Lampiran
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 * @package Simta\Models\Lampiran
 *
 */

namespace Simta\Models;
use Eloquent;

class Lampiran extends Eloquent {
    protected $table = 'Lampiran';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_lampiran";
    protected $fillable = ["nama_lampiran", "tipe_lampiran", "path_lampiran"];

    /**
     * Relasi one-to-one dengan tabel Panduan
     *
     * @return Simta\Models\Panduan
     */
    public function panduan()
    {
        return $this->hasOne('Simta\Models\Panduan', 'id_lampiran', 'id_lampiran');
    }
}
?>
