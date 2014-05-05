@extends('layouts.default')
@section('content')

@foreach($l_item as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('bidang_ahli/'. $item['id_bidang_ahli']) }}">{{ $item['judul_bidang_ahli'] }}</a></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>{{ $item['label_prodi'] }}: </span><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }}</a>
            <br />
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/'. $item['penulis']['id_dosen']) }}">{{ $item['penulis']['nama_dosen'] }}</a>
        </p>
        <div class="item-main">{{ $item['cuplikan_bidang_ahli'] }}</div>
        <a href="{{ URL::to('bidang_ahli/'. $item['id_bidang_ahli']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop