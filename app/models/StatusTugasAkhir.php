<?php

/**
 * Model untuk StatusTugasAkhir
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\StatusTugasAkhir
 *
 */

namespace Simta\Models;
use Eloquent;

class StatusTugasAkhir extends Eloquent {
    protected $table = 'status_tugas_akhir';
    protected $primaryKey = "nilai";
    public $incrementing = false;
    protected $fillable = ["nama", "nilai"];

}
