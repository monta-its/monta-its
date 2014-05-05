@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_topik'] }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>{{ $item['label_prodi'] }}: </span><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-tags"></span>
            <span>Bidang Ahli: </span><a href="{{ URL::to('prodi/'. $item['id_bidang_ahli']) }}">{{ $item['nama_bidang_ahli'] }}</a>
            <br />
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/'. $item['penulis']['id_dosen']) }}">{{ $item['penulis']['nama_dosen'] }}</a>
        </p>
        <div class="item-main">{{ $item['isi_topik'] }}</div>
  </div>
</div>

@stop