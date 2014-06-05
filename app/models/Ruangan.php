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
use Simta\Models\Sidang;

class Ruangan extends Eloquent {
    protected $table = 'ruangan';
    public $timestamps = true;
    protected $softDelete = true;
    protected $primaryKey = "id_ruangan";
    public $incrementing = true;
    protected $fillable = ["kode_ruangan", "nama_ruangan"];

    /**
     * Cek apakah ruangan tersedia pada $tanggal & $sesi
     * @param  string $tanggal  php date format Y-m-d (yyyy-mm-dd)
     * @param  int $sesi        nomor sidang
     * @return bool
     */
    public function apakahTersediaRuangan($tanggal, $sesi)
    {
        return Sidang::where('disetujui', '=', 1)->where('tanggal', '=', $tanggal)->where('sesi', '=', $sesi)->count() == 0;
    }

}
?>
