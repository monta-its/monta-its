<?php

/**
 * Model untuk Pengaturan
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Pengaturan
 *
 */

namespace Simta\Models;
use Eloquent;

class Pengaturan extends Eloquent {
    protected $table = 'pengaturan';
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "nama";
    protected $fillable = ["nama", "nilai", "deskripsi"];

}
