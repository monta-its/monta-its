@extends('layouts.default')
@section('page_title')
{{ $item->nama_bidang_keahlian }}
@stop
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->nama_bidang_keahlian }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Laboratorium: </span>
            @foreach ($item->bidangMinat as $i => $bidangMinat) 
                <a href="{{ URL::to('prodi/'. $bidangMinat->id_bidang_minat) }}">
                    {{ $bidangMinat->nama_bidang_minat }}
                </a>
                @if ($i != $item->bidangMinat->count() - 1)
                    ,
                @endif
            @endforeach
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item->deskripsi_bidang_keahlian }}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@stop