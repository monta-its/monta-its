@extends('layouts.default')
@section('content')
    <h1>Rincian Group</h1>
    <?php $item = $data['item']; ?>
    @if ($data['item'] != null)
    <a href="{{ URL::to('group/update/' . $item->id_group) }}" class="btn btn-primary">Sunting</a>
    <a href="{{ URL::to('group/delete/' . $item->id_group) }}" class="btn btn-danger">Hapus</a>
    @endif
    <a href="{{ URL::to('group') }}" class="btn btn-default">Kembali ke Daftar</a>
    <br><br>
    @if ($data['item'] != null)
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th class="col-md-3">Nama Group</th>
                <td>{{ $item->name_group }}</td>
            </tr>
            <tr>
                <th class="col-md-3">Level Group</th>
                <td>{{ $item->level_group }}</td>
            </tr>
            <tr>
                <th>Permission</th>
                <td>
                @if ($item->permission->count() == 0)
                    <span class="text-muted">Tidak terdaftar di permission apapun</span>
                @endif
                @foreach ($item->permission as $permission)
                    <li><a href="{{ URL::to('permission/detail/' . $permission->id_permission) }}">{{ $permission->route_permission }}</a></li>
                @endforeach
                </td>
            </tr>
            <tr>
                <th>Menu</th>
                <td>
                @if ($item->menu->count() == 0)
                    <span class="text-muted">Tidak terdaftar di menu apapun</span>
                @endif
                @foreach ($item->menu as $menu)
                    <li><a href="{{ URL::to('menu/detail/' . $menu->id_menu) }}">{{ $menu->name_menu }}</a></li>
                @endforeach
                </td>
            </tr>
            <tr>
                <th>Enabled</th>
                <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
            </tr>
        </tbody>
    </table>
    @endif
@stop