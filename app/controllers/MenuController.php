<?php

namespace Simta\Controllers;
use BaseController;
use View;
use Redirect;
use Request;
use Input;
use Simta\Models\Menu;

class MenuController extends BaseController {

    public function index()
    {
        $data = array();
        $data['items'] = Menu::all();
        $data['items']->sortBy('url_menu');
        View::share('data', $data);
        return View::make('pages.menu.index');
    }

    public function manage()
    {
        $data = array();
        $data['items'] = Menu::all();
        $data['items']->sortBy('url_menu');
        View::share('data', $data);
        return View::make('pages.menu.manage');
    }

    public function detail($id_menu)
    {
        $data = array();
        $data['item'] = Menu::with('parent', 'child.child', 'group')->find($id_menu);
        $data['item']->group->sortBy('name_menu');
        $data['item']->child->sortBy('order_menu')->each(function($child){
            if ($child->child != null)
            {
                $child->child->sortBy('order_menu');
            }
        });
        View::share('data', $data);
        return View::make('pages.menu.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['items'] = Menu::all()->sortBy('url_menu');
            View::share('data', $data);
            return View::make('pages.menu.create');
        }
        else if (Request::isMethod('post'))
        {
            $menu = Menu::create(Input::all());
            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::find(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
            return Redirect::to('menu/manage');
        }
    }

    public function update($id_menu)
    {
        if (Request::isMethod('get'))
        {
            $data = array();
            $data['item'] = Menu::find($id_menu);
            $data['items'] = Menu::where('id_menu', '<>', $id_menu)->get();
            View::share('data', $data);
            return View::make('pages.menu.update');
        }
        else if (Request::isMethod('post'))
        {
            $menu = Menu::find($id_menu);
            $menu->update(Input::all());
            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::find(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
            return Redirect::to('menu/detail/' . $id_menu);
        }
    }

    public function delete($id_menu)
    {
        $menu = Menu::find($id_menu);
        $menu->delete();
        return Redirect::to('menu/manage');
    }
}
