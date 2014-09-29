@extends('layouts.default')
@section('page_title')
{{ $item->judul_panduan }}
@stop
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->judul_panduan }}</strong></h3>
    <p>
        <span class="glyphicon glyphicon-user"></span>
        <span>Penulis: </span>
        <a class="author" href="{{ URL::to('dosen/' . $item->person->nip ) }}">{{ $item->person->nama_lengkap }}</a>
        <span> · </span>
        <span class="glyphicon glyphicon-paperclip"></span>
        <span>Lampiran: </span>
        @if ($item->lampiran == null)
        <span>tidak terserdia</span>
        @else
            @if ($item->lampiran->tipe_lampiran == 'url')
            <a href="{{ URL::to($item->lampiran->path_lampiran) }}">{{ $item->lampiran->nama_lampiran }}</a>
            @else
            <a href="{{ URL::to($item->lampiran->path_lampiran) }}">{{ $item->lampiran->nama_lampiran }}</a>
            @endif
        @endif

    </p>
        <div class="item-main">{{ $item->isi_panduan }}</div>
  </div>
</div>

@stop
