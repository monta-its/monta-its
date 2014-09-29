<?php

namespace Simta\Controllers;
use BaseController;
use View;
use Redirect;
use Request;
use Input;
use Simta\Models\Group;
use Simta\Models\Menu;
use Simta\Models\Permission;

class GroupController extends BaseController {

    public function index()
    {
        $data = array();
        $data['items'] = Group::all();
        View::share('data', $data);
        return View::make('pages.group.index');
    }

    public function manage()
    {
        $data = array();
        $data['items'] = Group::all();
        View::share('data', $data);
        return View::make('pages.group.manage');
    }

    public function detail($id_group)
    {
        $data = array();
        $data['item'] = Group::with('menu', 'permission')->find($id_group);
        View::share('data', $data);
        return View::make('pages.group.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['menus'] = Menu::all();
            $data['permissions'] = Permission::all();
            View::share('data', $data);
            return View::make('pages.group.create');
        }
        else if (Request::isMethod('post'))
        {
            Group::create(Input::all());
            return Redirect::to('group/manage');
        }
    }

    public function update($id_group)
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['item'] = Group::with('menu', 'permission')->find($id_group);
            $data['menus'] = Menu::all();
            $data['permissions'] = Permission::all();
            View::share('data', $data);
            return View::make('pages.group.update');
        }
        else if (Request::isMethod('post'))
        {
            $group = Group::find($id_group);
            $group->update(Input::all());
            $menu_ids = Input::get('menu_ids');
            if ($menu_ids == null)
            {
                $menu_ids = array();
            }
            $group->setMenuByIds($menu_ids);

            $permission_ids = Input::get('permission_ids');
            if ($permission_ids == null)
            {
                $permission_ids = array();
            }
            $group->setPermissionByIds($permission_ids);
            return Redirect::to('group/detail/' . $id_group);
        }
    }

    public function delete($id_group)
    {
        $group = Group::find($id_group);
        $group->delete();
        return Redirect::to('group/manage');
    }
}
