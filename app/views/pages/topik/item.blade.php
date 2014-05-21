@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->topik }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Bidang Keahlian: </span><a href="{{ URL::to('bidang_keahlian/'. $item->id_bidang_keahlian) }}">{{ $item->bidangKeahlian->nama_bidang_keahlian }}</a>
            <span> · </span>
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item->deskripsi }}
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
                        @foreach ($item->tugasAkhir as $tugasAkhir)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('mahasiswa/' . $tugasAkhir->nrp_mahasiswa) }}">{{ $tugasAkhir->mahasiswa->nama_lengkap }}</a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('judul/' . $tugasAkhir->id_tugas_akhir) }}">
                                        {{ $tugasAkhir->penawaranJudul->judul_tugas_akhir }}
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
