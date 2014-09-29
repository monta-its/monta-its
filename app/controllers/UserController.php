<?php

namespace Simta\Controllers;
use BaseController;
use View;
use Redirect;
use Request;
use Input;
use Auth;
use Simta\Models\User;
use Simta\Models\Group;

class UserController extends BaseController {

    public function index()
    {
        $data = array();
        $data['items'] = User::all();
        View::share('data', $data);
        return View::make('pages.user.index');
    }

    public function manage()
    {
        $data = array();
        $data['items'] = User::all();
        View::share('data', $data);
        return View::make('pages.user.manage');
    }

    public function detail($id_user = null)
    {
        if ($id_user == null)
        {
            $id_user = Auth::user()->id_user;
        }
        $data = array();
        $data['item'] = User::with('group')->find($id_user);
        View::share('data', $data);
        return View::make('pages.user.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['groups'] = Group::all();
            View::share('data', $data);
            return View::make('pages.user.create');
        }
        else if (Request::isMethod('post'))
        {
            $user = User::create(Input::all());
            $group_ids = Input::get('group_ids');
            $user->setGroupByIds($group_ids);
            return Redirect::to('user/manage');
        }
    }

    public function update($id_user = null)
    {
        if ($id_user == null)
        {
            $id_user = Auth::user()->id_user;
        }
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['item'] = User::with('group')->find($id_user);
            $data['groups'] = Group::all();
            View::share('data', $data);
            return View::make('pages.user.update');
        }
        else if (Request::isMethod('post'))
        {
            $user = User::find($id_user);
            $user->update(Input::all());
            $group_ids = Input::get('group_ids');
            if ($group_ids == null)
            {
                $group_ids = array();
            }
            $user->setGroupByIds($group_ids);
            return Redirect::to('user/detail/' . $id_user);
        }
    }

    public function delete($id_user)
    {
        $user = User::find($id_user);
        $user->delete();
        return Redirect::to('user/manage');
    }

    public function changePassword($id_user)
    {
        if (Request::isMethod('get'))
        {
            return View::make('pages.user.change_password');
        }
        else if (Request::isMethod('post'))
        {
            $user = User::find($id_user);
            $data = Input::all();
            if ($data['password_user'] == $user->password_user)
            {
                if ($data['new_password'] == $data['confirm_password'])
                {
                    $user->password_user = $data['new_password'];
                    $user->save();
                }
            }

            return Redirect::to('user/detail/' . $id_user);
        }
    }

    public function changeActingGroup()
    {
        Auth::user()->setActingGroupId(Input::get('acting_group'));
        return Redirect::to('/');
    }
}
