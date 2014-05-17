@extends('layouts.default')
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('topik/'. $item->id_topik) }}">{{ $item->topik }}</a></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Prodi: </span><a href="{{ URL::to('prodi/'. $item->kode_bidang_minat) }}">{{ $item->bidangMinat->kode_bidang_minat }}</a>
        </p>
        <div class="item-main">{{ $item->deskripsi }}</div>
        <a href="{{ URL::to('topik/'. $item['id_topik']) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
