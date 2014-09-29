@extends('layouts.default')
@section('content')
<h1>Daftar Permission</h1>

<a href="{{ URL::to('permission/manage') }}" class="btn btn-primary">Kelola</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:40px;">No.</th>
            <th>Rute Permission</th>
            <th class="col-md-1">Enabled</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ URL::to('permission/detail/' . $item->id_permission) }}" title="">{{ $item->route_permission }}</a></td>
            <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop