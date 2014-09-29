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
use Simta\Models\Group;
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    public $incrementing = true;
    protected $softDelete = false;
    protected $fillable = array(
        'username_user',
        'email_user',
        'password_user',
        'name_user',
        'address_user',
        'contact_user',
        'gender_user',
        'last_login_user',
        'last_ip_user',
        'enabled',
        'remember_token_user',
        'acting_group_user'
    );
    protected $exceptionalRoute = array(
        'user/change_acting_group',
    );
    protected $effectiveMenu = null;
    protected $effectivePermission = null;
    protected $actingGroup = null;

    public function person()
    {
        return $this->morphTo();
    }

    public function group()
    {
        return $this->belongsToMany('Simta\Models\Group', 'user_group', 'user_id', 'group_id');
    }

    public function hasAccess($route_permission)
    {
        foreach ($this->exceptionalRoute as $exceptionalRoute)
        {
            if ($exceptionalRoute == $route_permission)
            {
                return true;
            }
        }

        $permissions = $this->getEffectivePermission();
        foreach ($permissions as $permission) 
        {
            if ($permission->route_permission == $route_permission)
            {
                return true;
            }
        }
        return false;
    }

    public function getEffectiveMenu()
    {
        if ($this->effectiveMenu != null)
        {
            return $this->effectiveMenu;
        }
        else
        {
            $group = Group::with('menu')->find($this->getActingGroupId());
            if ($group != null)
            {
                $effectiveMenu = array();
                foreach ($group->menu as $menu) 
                {
                    if ($menu->parent_id == 0)
                    {
                        array_push($effectiveMenu, $menu);
                        $menu->_child = array();
                        foreach ($group->menu as $child) 
                        {
                            if ($child->parent_id == $menu->id_menu)
                            {
                                array_push($menu->_child, $child);

                                $child->_child = array();
                                foreach ($group->menu as $grandChild) 
                                {
                                    if ($grandChild->parent_id == $child->id_menu)
                                    {
                                        array_push($child->_child, $grandChild);
                                    }
                                }
                            }
                        }
                    }
                }
                $this->effectiveMenu = $effectiveMenu;
            }
            else
            {
                $this->effectiveMenu = array();
            }
            return $this->effectiveMenu;
        }
    }

    public function getEffectivePermission()
    {
        if ($this->effectivePermission != null)
        {
            return $this->effectivePermission;
        }
        else
        {
            $group = Group::with('permission')->find($this->getActingGroupId());
            if ($group != null)
            {
                $this->effectivePermission = $group->permission;
            }
            else
            {
                $this->effectivePermission = array();
            }
            return $this->effectivePermission;
        }
    }

    public function setActingGroupId($id_group)
    {
        $group = Group::find($id_group);
        if ($group != null)
        {
            $this->acting_group_user = $id_group;
            $this->save();
        }
    }

    public function getActingGroupId()
    {
        if ($this->acting_group_user == 0)
        {
            if ($this->group->count() > 0)
            {
                $id_group = $this->group->sortByDesc('level_group')->first()->id_group;
                $this->setActingGroupId($id_group);
                return $this->acting_group_user;
            }
            else
            {
                return 0;
            }            
        }
        else
        {
            return $this->acting_group_user;
        }
    }

    public function getActingGroup()
    {
        if ($this->actingGroup != null)
        {
            return $this->actingGroup;
        }
        else
        {
            $this->actingGroup = Group::find($this->getActingGroupId());
            return $this->actingGroup;
        }
    }    

    public function addGroup($group)
    {
        if (!$this->inGroup($group))
        {
            $this->group()->attach($group);
        }
        return true;
    }

    public function removeGroup($group)
    {
        if ($this->inGroup($group))
        {
            $this->group()->detach($group);
        }
        return true;
    }

    public function clearGroup()
    {
        foreach ($this->group()->get() as $group)
        {
            $this->group()->detach($group);
        }
    }

    public function inGroup($group)
    {
        foreach ($this->group()->get() as $_group)
        {
            if ($_group->id_group == $group->id_group)
            {
                return true;
            }
        }
        return false;
    }

    public function setGroupByIds($group_ids)
    {
        if (is_array($group_ids))
        {
            $this->clearGroup();
            foreach ($group_ids as $group_id) {
                $group = Group::find($group_id);
                if ($group != null)
                {
                    $this->addGroup($group);
                }
            }
            return true;
        }
        return false;
    }

    public function getAuthIdentifier()
    {
        return $this->id_user;
    }

    public function getAuthPassword()
    {
        return $this->password_user;
    }

    public function getRememberTokenName()
    {
        return 'remember_token_user';
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

}
