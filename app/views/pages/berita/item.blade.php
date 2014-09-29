@extends('layouts.default')
@section('page_title')
{{$item->judul}}
@stop
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->judul }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            @if ($item->pegawai->apakahDosen())
            <a class="author" href="{{ URL::to('dosen/'. $item->nip) }}">{{ $item->nama_lengkap }}</a>
            @else
            <span>{{ $item->nama_lengkap }}</span>
            @endif
            <span> · </span>
            <span class="glyphicon glyphicon-time"></span>
            <span>Waktu: </span><strong>{{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}</strong>
        </p>
        <div class="item-main">{{ $item->isi }}</div>
  </div>
</div>

@stop
