@extends('layouts.default')
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('topik/'. $item->id_topik) }}">{{ $item->topik }}</a></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Laboratorium: </span>
            @foreach ($item->bidangKeahlian->bidangMinat as $i => $bidangMinat) 
                <a href="{{ URL::to('prodi/'. $bidangMinat->id_bidang_minat) }}">
                    {{ $bidangMinat->nama_bidang_minat }}
                </a>
                @if ($i != $item->bidangKeahlian->bidangMinat->count() - 1)
                    ,
                @endif
            @endforeach
            
        </p>
        <div class="item-main">{{ $item->deskripsi }}</div>
        <a href="{{ URL::to('topik/'. $item->id_topik) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop
