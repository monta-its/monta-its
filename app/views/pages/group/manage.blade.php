@extends('layouts.default')
@section('content')
<h1>Kelola Group</h1>

<a href="{{ URL::to('group/create') }}" class="btn btn-primary">Tambah</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:40px;">No.</th>
            <th>Nama Group</th>
            <th class="col-md-1">Level Group</th>
            <th class="col-md-1">Enabled</th>
            <th class="col-md-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ URL::to('group/detail/' . $item->id_group) }}" title="">{{ $item->name_group }}</a></td>
            <td>{{ $item->level_group }}</td>
            <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
            <td>
                <a href="{{ URL::to('group/update/' . $item->id_group) }}" class="btn btn-primary btn-xs">Sunting</a>
                <a href="{{ URL::to('group/delete/' . $item->id_group) }}" class="btn btn-danger btn-xs">Hapus</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop