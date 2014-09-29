<?php 
/**
 * Model User
 * Model yang digunakan untuk autentikasi.
 *
 * @author Ifan Iqbal <ifaniqbal.com@gmail.com>
 *
 */

namespace Simta\Models;
use Eloquent;

class Group extends Eloquent {
    protected $table = 'group';
    protected $primaryKey = 'id_group';
    public $timestamps = false;
    public $incrementing = true;
    protected $softDelete = false;
    protected $fillable = array(
        'name_group',
        'level_group',
        'enabled'
    );

    public function user()
    {
        return $this->belongsToMany('Simta\Models\User', 'user_group', 'group_id', 'user_id');
    }

    public function menu()
    {
        return $this->belongsToMany('Simta\Models\Menu', 'group_menu', 'group_id', 'menu_id');
    }

    public function permission()
    {
        return $this->belongsToMany('Simta\Models\Permission', 'group_permission', 'group_id', 'permission_id');
    }

    public function addMenu($menu)
    {
        if (!$this->inMenu($menu))
        {
            $this->menu()->attach($menu);
        }
        return true;
    }

    public function removeMenu($menu)
    {
        if ($this->inMenu($menu))
        {
            $this->menu()->detach($menu);
        }
        return true;
    }

    public function clearMenu()
    {
        foreach ($this->menu()->get() as $menu)
        {
            $this->menu()->detach($menu);
        }
    }

    public function inMenu($menu)
    {
        foreach ($this->menu()->get() as $_menu)
        {
            if ($_menu->id_menu == $menu->id_menu)
            {
                return true;
            }
        }
        return false;
    }

    public function setMenuByIds($menu_ids)
    {
        if (is_array($menu_ids))
        {
            $this->clearMenu();
            foreach ($menu_ids as $menu_id) {
                $menu = Menu::find($menu_id);
                if ($menu != null)
                {
                    $this->addMenu($menu);
                }
            }
            return true;
        }
        return false;
    }

    public function addPermission($permission)
    {
        if (!$this->inPermission($permission))
        {
            $this->permission()->attach($permission);
        }
        return true;
    }

    public function removePermission($permission)
    {
        if ($this->inPermission($permission))
        {
            $this->permission()->detach($permission);
        }
        return true;
    }

    public function clearPermission()
    {
        foreach ($this->permission()->get() as $permission)
        {
            $this->permission()->detach($permission);
        }
    }

    public function inPermission($permission)
    {
        foreach ($this->permission()->get() as $_permission)
        {
            if ($_permission->id_permission == $permission->id_permission)
            {
                return true;
            }
        }
        return false;
    }

    public function setPermissionByIds($permission_ids)
    {
        if (is_array($permission_ids))
        {
            $this->clearPermission();
            foreach ($permission_ids as $permission_id) {
                $permission = Permission::find($permission_id);
                if ($permission != null)
                {
                    $this->addPermission($permission);
                }
            }
            return true;
        }
        return false;
    }
}
