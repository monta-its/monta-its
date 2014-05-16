@extends('layouts.default')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->judul }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/' . $item->dosen()->first()->nip_dosen) }}">{{ $item->dosen()->first()->pegawai()->first()->nama_lengkap }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-paperclip"></span>
            <span>Lampiran: </span>
            @if ($item->lampiran == '')
            <span>tidak terserdia</span>
            @else
            <a href="{{ URL::to($item->lampiran) }}">
            Unduh
            </a>
            @endif

        </p>
        <div class="item-main">{{ $item->isi }}</div>
  </div>
</div>

@stop
