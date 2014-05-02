@extends('layouts.default')

@section('content')
@foreach($l_item as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('panduan/' . $item['id_panduan']) }}">{{ $item['judul_panduan'] }}</a></h3>
        <p>
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/' . $item['id_dosen']) }}">{{ $item['nama_dosen'] }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-paperclip"></span>
            <span>Lampiran: </span>
            @if ($item['tautan_lampiran'] == '')
            <span>tidak terserdia</span>
            @else
            <a href="{{ URL::to($item['tautan_lampiran']) }}">
                {{ $item['nama_lampiran'] }}
            </a>
            @endif
            
        </p>
        <div class="item-main">{{ $item['cuplikan_panduan'] }}</div>
        <a href="{{ URL::to('panduan/'. $item['id_panduan']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach
@stop
