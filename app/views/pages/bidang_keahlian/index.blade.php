@extends('layouts.default')
@section('page_title')
Bidang Keahlian
@stop
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('bidang_keahlian/'. $item->id_bidang_keahlian) }}">{{ $item->nama_bidang_keahlian }}</a></h3>
    <p>
        <span class="glyphicon glyphicon-tag"></span>
        <span>Laboratorium: </span>
        <a href="{{ URL::to('prodi/'. $item->bidangMinat->id_bidang_minat) }}">
            {{ $item->bidangMinat->nama_bidang_minat }}
        </a>
        <br />
        <span class="glyphicon glyphicon-user"></span>
        <span>Dosen: </span>
        @foreach ($item->dosen as $i => $dosen)
            <a class="author" href="{{ URL::to('dosen/'. $dosen->nip_dosen ) }}">{{ $dosen->pegawai->nama_lengkap }}</a>
            @if ($i < $item->dosen->count() - 1)
                <span> · </span>
            @endif
        @endforeach
        
    </p>
    <div class="item-main">{{ $item->deskripsi_bidang_keahlian }}</div>
    <a href="{{ URL::to('bidang_keahlian/'. $item->id_bidang_keahlian) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop