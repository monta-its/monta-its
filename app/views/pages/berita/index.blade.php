@extends('layouts.default')
@section('content')

<!--app/views/pages/berita/index.blade.php-->
<?php 
/*
    Item Model
    
*/
?>

@foreach($l_item as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_berita'] }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/' . $item['id_dosen']) }}">{{ $item['nama_dosen'] }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-time"></span>
            <span>Waktu: </span><strong>{{ $item['waktu'] }}</strong>
            <span> · </span>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Kategori: </span>
            <a href="{{ URL::to('kategori/' . $item['id_kategori']) }}">{{ $item['nama_kategori'] }}</a>
        </p>
        <div class="item-main">{{ $item['cuplikan_berita'] }}</div>
        <a href="{{ URL::to('berita/'. $item['id_berita']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop