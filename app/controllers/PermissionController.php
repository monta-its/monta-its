<?php

namespace Simta\Controllers;
use BaseController;
use View;
use Redirect;
use Request;
use Input;
use Simta\Models\Permission;

class PermissionController extends BaseController {

    public function index()
    {
        $data = array();
        $data['items'] = Permission::all();
        $data['items']->sortBy('route_permission');
        View::share('data', $data);
        return View::make('pages.permission.index');
    }

    public function manage()
    {
        $data = array();
        $data['items'] = Permission::all();
        $data['items']->sortBy('route_permission');
        View::share('data', $data);
        return View::make('pages.permission.manage');
    }

    public function detail($id_permission)
    {
        $data = array();
        $data['item'] = Permission::with('group')->find($id_permission);
        $data['item']->group->sortBy('name_group');
        View::share('data', $data);
        return View::make('pages.permission.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            View::share('data', $data);
            return View::make('pages.permission.create');
        }
        else if (Request::isMethod('post'))
        {
            $permission = Permission::create(Input::all());
            return Redirect::to('permission/manage');
        }
    }

    public function update($id_permission)
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['item'] = Permission::find($id_permission);
            View::share('data', $data);
            return View::make('pages.permission.update');
        }
        else if (Request::isMethod('post'))
        {
            $permission = Permission::find($id_permission);
            $permission->update(Input::all());
            return Redirect::to('permission/detail/' . $id_permission);
        }
    }

    public function delete($id_permission)
    {
        $permission = Permission::find($id_permission);
        $permission->delete();
        return Redirect::to('permission/manage');
    }
}
