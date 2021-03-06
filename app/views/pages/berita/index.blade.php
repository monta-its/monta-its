@extends('layouts.default')
@section('page_title')
Berita
@stop
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3>
        <a href="{{ URL::to('berita/'. $item->id_pos)}}">{{ $item->judul }}</a>
    </h3>
    <p>
        <span class="glyphicon glyphicon-user"></span>
        <span>Penulis: </span>
        <a class="author" href="{{ URL::to('dosen/'. $item->person->nip) }}">{{ $item->person->nama_lengkap }}</a>
        <span> · </span>
        <span class="glyphicon glyphicon-time"></span>
        <span>Waktu: </span><strong>{{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}</strong>
    </p>
    <div class="item-main">{{ $item->isi }}</div>
    <a href="{{ URL::to('berita/'. $item->id_pos) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
