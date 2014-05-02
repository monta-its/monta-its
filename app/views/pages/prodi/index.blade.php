@extends('layouts.default')
@section('content')

@foreach($l_item as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }} ({{ $item['singkatan_prodi'] }})</a></h3>
        <p>
            
            
        </p>
        <div class="item-main">{{ $item['cuplikan_prodi'] }}</div>
        <a href="{{ URL::to('prodi/'. $item['id_prodi']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop