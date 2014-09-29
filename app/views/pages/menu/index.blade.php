@extends('layouts.default')
@section('content')
<h1>Daftar Menu</h1>

<a href="{{ URL::to('menu/manage') }}" class="btn btn-primary">Kelola</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:40px;">No.</th>
            <th>Nama Menu</th>
            <th>URL</th>
            <th>Urutan</th>
            <th>Parent</th>
            <th class="col-md-1">Enabled</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ URL::to('menu/detail/' . $item->id_menu) }}" title="">{{ $item->name_menu }}</a></td>
            <td>{{ $item->url_menu }}</td>
            <td>{{ $item->order_menu }}</td>
            <td>{{ $item->parent_id }}</td>
            <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop