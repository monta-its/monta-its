@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item['judul_bidang_ahli'] }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>{{ $item['label_prodi'] }}: </span><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }}</a>
            <br />
            <span class="glyphicon glyphicon-user"></span>
            <span>Penulis: </span>
            <a class="author" href="{{ URL::to('dosen/'. $item['penulis']['id_dosen']) }}">{{ $item['penulis']['nama_dosen'] }}</a>
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item['isi_bidang_ahli'] }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center col-md-4 col-sm-5 col-xs-5">Topik</th>
                            <th class="text-center">Nama Mahasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($item['topik_bidang_ahli'] as $topik)

                        <tr>
                            <td>
                                <a href="{{ URL::to('topik/' . $topik['id_topik']) }}">{{ $topik['judul_topik'] }}</a>
                            </td>
                            <td>

                            @for ($i = 0; $i < count($topik['mahasiswa_topik']); $i++)
                                <a href="{{ URL::to('mahasiswa/nrp/' . $topik['mahasiswa_topik'][$i]['nrp_mahasiswa']) }}">
                                    {{ $topik['mahasiswa_topik'][$i]['nama_mahasiswa'] }}
                                </a>
                                @if ($i < count($topik['mahasiswa_topik']) - 1)
                                <span> · </span>
                                @endif
                            @endfor
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