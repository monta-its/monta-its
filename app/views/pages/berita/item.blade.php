@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->judul }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('pegawai/' . $item->pegawai()->first()->nip_pegawai) }}">{{ $item->pegawai()->first()->nama_lengkap }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-time"></span>
            <span>Waktu: </span><strong>{{ $item->updated_at }}</strong>
        </p>
        <div class="item-main">{{ $item->isi }}</div>
  </div>
</div>

@stop
