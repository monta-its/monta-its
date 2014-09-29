<?php 
/**
 * Model Permission
 * Menyimpan route uri yang berhak diakses tiap group.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 *
 */

namespace Simta\Models;
use Eloquent;

class Permission extends Eloquent {
    protected $table = 'permission';
    protected $primaryKey = 'id_permission';
    public $timestamps = false;
    public $incrementing = true;
    protected $softDelete = false;
    protected $fillable = array(
        'route_permission',
        'enabled',
    );

    public function group()
    {
        return $this->belongsToMany('Simta\Models\Group', 'group_permission', 'permission_id', 'group_id');
    }

}
