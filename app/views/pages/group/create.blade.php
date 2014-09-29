@extends('layouts.default')
@section('content')
<div class="col-md-6">

    <h1>Buat Group</h1>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Nama Group</label>
            <input type="text" class="form-control" name="name_group">
        </div>
        <div class="form-group">
            <label for="">Level Group</label>
            <input type="number" class="form-control" name="level_group">
        </div>
        <div class="form-group">
            <label for="">Permission</label>
            <div class="input-group">
                <select class="form-control" name="permission_id">
                    <option value="0"></option>
                @foreach ($data['permissions'] as $permission)
                    <option value="{{ $permission->id_permission }}">{{ $permission->route_permission }}</option>
                @endforeach
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="addPermission">Tambah</button>
                </span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" id="noPermission">Tidak ada permission terdaftar</div>
            <table class="table table-striped table-hover" id="permission">
                <tbody>
                    <tr class="sample">
                        <td>
                            <a class="text">Rute permission</a>
                            <input type="hidden" value="" name="permission_ids[]">
                        </td>
                        <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removePermission">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="">Menu</label>
            <div class="input-group">
                <select class="form-control" name="menu_id">
                    <option value="0"></option>
                @foreach ($data['menus'] as $menu)
                    <option value="{{ $menu->id_menu }}">{{ $menu->name_menu }}</option>
                @endforeach
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="addMenu">Tambah</button>
                </span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" id="noMenu">Tidak ada menu terdaftar</div>
            <table class="table table-striped table-hover" id="menu">
                <tbody>
                    <tr class="sample">
                        <td>
                            <a class="text">Nama menu</a>
                            <input type="hidden" value="" name="menu_ids[]">
                        </td>
                        <td class="col-md-2 text-center"><button type="button" class="btn btn-warning btn-xs removeMenu">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="">Enabled</label>
            <select class="form-control" name="enabled">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@stop

@section('custom_foot')
    @include('scripts.item-input-control')
    <script type="text/javascript">
        $(document).ready(function(){
            runItemInputControl(['menu', 'permission']);
        });
    </script>
@stop