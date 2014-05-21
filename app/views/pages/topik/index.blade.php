@extends('layouts.default')
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('topik/'. $item->id_topik) }}">{{ $item->topik }}</a></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Bidang Keahlian: </span><a href="{{ URL::to('bidang_keahlian/'. $item->id_bidang_keahlian) }}">{{ $item->bidangKeahlian->nama_bidang_keahlian }}</a>
        </p>
        <div class="item-main">{{ $item->deskripsi }}</div>
        <a href="{{ URL::to('topik/'. $item['id_topik']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
