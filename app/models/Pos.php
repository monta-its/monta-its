<?php

/**
 * Model untuk Pos
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Pos
 *
 */

namespace Simta\Models;
use EloquentValidator;

class Pos extends EloquentValidator {
    protected $table = 'pos';
    public $timestamps = false;
    protected $softDelete = false;
    protected $primaryKey = "id_pos";
    protected $fillable = ["judul", "isi", "apakah_terbit"];
    protected $rules = array("judul" => "required",
                             "isi" => "required",
                             "apakah_terbit" => "required");

    public function person()
    {
        return $this->morphTo();
    }

}
?>
