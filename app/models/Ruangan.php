<?php
/**
 * Model untuk Ruangan
 *
 * @author Putu Wiramaswara Widya <wiramaswara11@mhs.if.its.ac.id>
 * @package Simta\Models\Ruangan
 *
 */
namespace Simta\Models;
use Eloquent;

class Ruangan extends Eloquent {
    protected $table = 'ruangan';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_ruangan";
    public $incrementing = false;
    protected $fillable = ["kode_ruangan", "nama_ruangan"];

}
?>
