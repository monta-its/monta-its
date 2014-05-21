@extends('layouts.default')
@section('content')

@foreach($items as $item)

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('judul/'. $item->id_penawaran_judul) }}">{{ $item->judul_tugas_akhir }}</a></h3>
    <p>
        <span class="glyphicon glyphicon-tag"></span>
        <span>Laboratorium: </span>
        @foreach ($item->topik->bidangKeahlian->bidangMinat as $i => $bidangMinat) 
            <a href="{{ URL::to('prodi/'. $bidangMinat->id_bidang_minat) }}">
                {{ $bidangMinat->nama_bidang_minat }}
            </a>
            @if ($i != $item->topik->bidangKeahlian->bidangMinat->count() - 1)
                ,
            @endif
        @endforeach
        <span> · </span>
        <span class="glyphicon glyphicon-tags"></span>
        <span>Topik: </span><a href="{{ URL::to('topik/'. $item->id_topik) }}">{{ $item->topik->topik }}</a>
        <span> · </span>
        <span class="glyphicon glyphicon-question-sign"></span>
        <span>Pengambilan: </span>
        @if ($item->tugasAkhir == null)
            <span class="label label-success">Tersedia</span>
        @else
            <span class="label label-default">Sudah Diambil</span>
        @endif
        <br />
        <span class="glyphicon glyphicon-user"></span>
        <span>Dosen Pembimbing: </span>
        @if ($item->tugasAkhir != null)
            @foreach ($item->tugasAkhir->dosenPembimbing as $i => $dosenPembimbing)
            <a class="author" href="{{ URL::to('dosen/'. $dosenPembimbing->nip_dosen ) }}">{{ $dosenPembimbing->pegawai->nama_lengkap }}</a>
            @if ($i < $item->tugasAkhir->dosenPembimbing->count() - 1)    
            <span> · </span>
            @endif    
            @endforeach
        @else
            <a class="author" href="{{ URL::to('dosen/'. $item->nip_dosen ) }}">{{ $item->dosen->pegawai->nama_lengkap }}</a>
        @endif
        <br />
        @if ($item->tugasAkhir != null)
        <span class="glyphicon glyphicon-user"></span>
        <span>Mahasiswa: </span>
        <a href="{{ URL::to('mahasiswa/' . $item->tugasAkhir->nrp_mahasiswa) }}">{{ $item->tugasAkhir->mahasiswa->nama_lengkap }}</a>
        <br />
        @endif
        @if ($item->tugasAkhir != null)
        <span class="glyphicon glyphicon-time"></span>
        <span>Tanggal Mulai: </span><strong>{{ $item->tugasAkhir->tanggal_mulai }}</strong>
        <span> · </span>
        <span class="glyphicon glyphicon-time"></span>
        <span>Tanggal Selesai: </span><strong>{{ $item->tugasAkhir->tanggal_selesai }}</strong>
        <br />
        @endif
        
        
    </p>
    <div class="item-main">{{ $item->deskripsi }}</div>
    <a href="{{ URL::to('judul/'. $item->id_penawaran_judul) }}" class="btn btn-primary pull-right">Selengkapnya...</a>
  </div>
</div>

@endforeach

@stop