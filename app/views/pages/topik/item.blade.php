@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_topik'] }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>{{ $item['label_prodi'] }}: </span><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-question-sign"></span>
            <span>Pengambilan: </span>
            @if ($item['status_terambil'] == false)
                <span class="label label-success">Tersedia</span>
            @else
                <span class="label label-default">Sudah Diambil</span>
            @endif
            <br />
            <span class="glyphicon glyphicon-time"></span>
            <span>Waktu Mulai: </span><strong>{{ $item['waktu_mulai'] }}</strong>
            <span> · </span>
            <span class="glyphicon glyphicon-time"></span>
            <span>Waktu Akhir: </span><strong>{{ $item['waktu_akhir'] }}</strong>
            <br />
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            @for ($i = 0; $i < count($item['pembimbing']); $i++)
            <a class="author" href="{{ URL::to('dosen/'. $item['pembimbing'][$i]['id_dosen']) }}">{{ $item['pembimbing'][$i]['nama_dosen'] }}</a>
                @if ($i < count($item['pembimbing']) - 1)    
                <span> · </span>
                @endif
            @endfor
            
        </p>
        <div class="item-main">{{ $item['isi_topik'] }}</div>
        @if ($item['status_terambil'] == false)
        <p class="text-center">
            <a href="{{ URL::to('topik/'. $item['id_topik'] . '/ambil') }}" class="btn btn-success">Ambil topik ini!</a>
        </p>
        @endif
  </div>
</div>

@stop