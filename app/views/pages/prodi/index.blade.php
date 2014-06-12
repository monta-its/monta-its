@extends('layouts.default')
@section('page_title')
Laboratorium
@stop
@section('content')

@foreach($items as $item)
<div class="panel panel-default">
  <div class="panel-body">
    <h3>
        <a href="{{ URL::to('prodi/'. $item->id_bidang_minat) }}">{{ $item->nama_bidang_minat }} ({{ $item->kode_bidang_minat }})</a>
    </h3>
    <p>
    </p>
    <div class="item-main">{{ $item->deskripsi_bidang_minat }}</div>
    <a href="{{ URL::to('prodi/'. $item->id_bidang_minat) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
