@extends('layouts.default')

@section('content')
@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('panduan/' . $item->id_panduan) }}">{{ $item->judul_panduan }}</a></h3>
    <p>
        <span class="glyphicon glyphicon-user"></span>
        <span>Penulis: </span>
        @if ($item->pegawai->apakahDosen())
        <a class="author" href="{{ URL::to('dosen/' . $item->nip_pegawai ) }}">{{ $item->pegawai->nama_lengkap }}</a>
        @else
        <span>{{ $item->pegawai->nama_lengkap }}</span>
        @endif
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
        <a href="{{ URL::to('panduan/'. $item->id_panduan) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach
@stop
