@extends('layouts.default')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_panduan'] }}</strong></h3>
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
        <div class="item-main">{{ $item['isi_panduan'] }}</div>
  </div>
</div>

@stop
