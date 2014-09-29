@extends('layouts.default')
@section('content')
<h1>Daftar Group</h1>

<a href="{{ URL::to('group/manage') }}" class="btn btn-primary">Kelola</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:40px;">No.</th>
            <th>Nama Group</th>
            <th class="col-md-1">Level Group</th>
            <th class="col-md-1">Enabled</th>
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
        </tr>
    @endforeach
    </tbody>
</table>
@stop