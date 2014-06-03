<?php

/**
 * Model untuk SesiSidang
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\SesiSidang
 *
 */

namespace Simta\Models;
use Eloquent;

class SesiSidang extends Eloquent {
    protected $table = 'sesi_sidang';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "sesi";
    public $incrementing = false;
    protected $fillable = ["sesi", "waktu_mulai", "waktu_selesai"];

}
?>
