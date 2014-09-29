<?php 
/**
 * Model Menu
 * Menyimpan link menu navbar dan sidebar.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 *
 */

namespace Simta\Models;
use Eloquent;

class Menu extends Eloquent {
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
    public $incrementing = true;
    protected $softDelete = false;
    protected $fillable = array(
        'name_menu',
        'url_menu',
        'order_menu',
        'enabled',
    );

    public $_child = null;

    public function parent()
    {
        return $this->belongsTo('Simta\Models\Menu', 'parent_id', 'id_menu');
    }

    public function child()
    {
        return $this->hasMany('Simta\Models\Menu', 'parent_id', 'id_menu');
    }

    public function group()
    {
        return $this->belongsToMany('Simta\Models\Group', 'group_menu', 'menu_id', 'group_id');
    }

}
