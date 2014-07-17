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
        <span class="glyphicon glyphicon-tag"></span>
        <span>Bidang Keahlian: </span>
        @for ($i = 0; $i < count($item->bidangKeahlian); $i++)
            <a href="{{ URL::to('bidang_keahlian/' . $item->bidangKeahlian[$i]->id_bidang_keahlian) }}">{{ $item->bidangKeahlian[$i]->nama_bidang_keahlian }}</a> 
            @if ($i != count($item->bidangKeahlian) - 1)
                ,
            @endif
        @endfor
        <br />
    </p>
    <div class="item-main">{{ $item->deskripsi_bidang_minat }}</div>
    <a href="{{ URL::to('prodi/'. $item->id_bidang_minat) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
