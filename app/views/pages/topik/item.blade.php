@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_topik'] }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>z
            <span>{{ $item['label_prodi'] }}: </span><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }}</a>
            <span> · </span>
            <span class="glyphicon glyphicon-tags"></span>
            <span>Bidang Ahli: </span><a href="{{ URL::to('bidang_keahlian/'. $item['id_bidang_keahlian']) }}">{{ $item['nama_bidang_keahlian'] }}</a>
            <br />
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/'. $item['penulis']['id_dosen']) }}">{{ $item['penulis']['nama_dosen'] }}</a>
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item['isi_topik'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center col-md-4 col-sm-5 col-xs-5">Nama Mahasiswa</th>
                                <th class="text-center">Judul TA</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($item['mahasiswa_judul'] as $mahasiswa)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('mahasiswa/' . $mahasiswa['nrp_mahasiswa']) }}">{{ $mahasiswa['nama_mahasiswa'] }}</a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('judul/' . $mahasiswa['id_judul']) }}">
                                        {{ $mahasiswa['judul_judul'] }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>
</div>

@stop