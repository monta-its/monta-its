@extends('layouts.default')
@section('content')
<h1>Kelola Permission</h1>

<a href="{{ URL::to('permission/create') }}" class="btn btn-primary">Tambah</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:40px;">No.</th>
            <th>Rute Permission</th>
            <th class="col-md-1">Enabled</th>
            <th class="col-md-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ URL::to('permission/detail/' . $item->id_permission) }}" title="">{{ $item->route_permission }}</a></td>
            <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
            <td>
                <a href="{{ URL::to('permission/update/' . $item->id_permission) }}" class="btn btn-primary btn-xs">Sunting</a>
                <a href="{{ URL::to('permission/delete/' . $item->id_permission) }}" class="btn btn-danger btn-xs">Hapus</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop