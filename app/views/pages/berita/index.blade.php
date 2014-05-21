@extends('layouts.default')
@section('content')

<!--app/views/pages/berita/index.blade.php-->
<?php
/*
    Item Model

*/
?>

@foreach($items as $item)


<div class="panel panel-default">
  <div class="panel-body">
    <h3>
        <a href="{{ URL::to('berita/'. $item->id_pos)}}">{{ $item->judul }}</a>
    </h3>
    <p>
        <span class="glyphicon glyphicon-user"></span>
        <span>Penulis: </span>
        <a class="author" href="{{ URL::to('pegawai/'. $item->nip_pegawai) }}">{{ $item->pegawai()->first()->nama_lengkap }}</a>
        <span> · </span>
        <span class="glyphicon glyphicon-time"></span>
        <span>Waktu: </span><strong>{{ $item->updated_at }}</strong>
    </p>
    <div class="item-main">{{ $item->isi }}</div>
    <a href="{{ URL::to('berita/'. $item->id_pos) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
