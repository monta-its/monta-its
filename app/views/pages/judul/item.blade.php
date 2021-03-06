@extends('layouts.default')
@section('page_title')
{{ $item->judul_tugas_akhir }}
@stop
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->judul_tugas_akhir }}</strong></h3>
    <p>
        <span class="glyphicon glyphicon-tag"></span>
        <span>Laboratorium: </span>
            <a href="{{ URL::to('prodi/'. $item->bidangKeahlian->bidangMinat->id_bidang_minat) }}">
                {{ $item->bidangKeahlian->bidangMinat->nama_bidang_minat }}
            </a>
        <span> · </span>
        <span class="glyphicon glyphicon-question-sign"></span>
        <span>Status Pengambilan: </span>
        @if ($item->tugasAkhir == null)
            <span class="label label-success">Tersedia</span>
        @else
            <span class="label label-default">Diambil</span> - <a href="{{ URL::to( 'mahasiswa/' . $item->tugasAkhir->nrp) }}">{{ $item->tugasAkhir->mahasiswa->nama_lengkap }}</a>
        @endif
        <br />
        <span class="glyphicon glyphicon-user"></span>
        <span>Dosen Pembimbing: </span>
        @if ($item->tugasAkhir != null)
            @foreach ($item->tugasAkhir->dosenPembimbing as $i => $dosenPembimbing)
            <a class="author" href="{{ URL::to('dosen/'. $dosenPembimbing->nip ) }}">{{ $dosenPembimbing->nama_lengkap }}</a>
            @if ($i < $item->tugasAkhir->dosenPembimbing->count() - 1)    
            <span> · </span>
            @endif    
            @endforeach
        @else
            <a class="author" href="{{ URL::to('dosen/'. $item->nip ) }}">{{ $item->dosen->nama_lengkap }}</a>
        @endif
        <br />
        @if ($item->tugasAkhir != null)
        <span class="glyphicon glyphicon-time"></span>
        <span>Tanggal Mulai: </span><strong>{{ date('d-m-Y', strtotime($item->tugasAkhir->tanggal_mulai)) }}</strong>
        <span> · </span>
        <span class="glyphicon glyphicon-time"></span>
        <span>Target Selesai: </span><strong>{{ date('d-m-Y', strtotime($item->tugasAkhir->target_selesai)) }}</strong>
        <br />
        @endif
    </p>
    <div class="item-main">{{ $item->deskripsi }}</div>
    @if ($item->tugasAkhir == null)
    <p class="text-center">
        <a href="{{ URL::to('judul/ambil/'. $item->id_penawaran_judul ) }}" class="btn btn-success">Ambil judul ini!</a>
    </p>
    @endif
  </div>
</div>

@stop