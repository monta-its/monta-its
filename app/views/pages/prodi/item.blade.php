@extends('layouts.default')
@section('page_title')
{{ $item->nama_bidang_minat }}
@stop
@section('content')

<!-- // TODO: Bro, istilah Bidang Ahli disini diubah ke Bidang Keahlian setiap dosen, baca segala TODO yang ada di routes.php lagi :( -->
<div class="panel panel-default">
  <div class="panel-body">
    <h3>{{ $item->nama_bidang_minat }} ({{ $item->kode_bidang_minat }})</h3>
    <p>
        <span class="glyphicon glyphicon-tag"></span>
        <span>Bidang Keahlian: </span>
        @for ($i = 0; $i < count($item->bidangKeahlian); $i++)
            <a href="{{ URL::to('bidang_keahlian/' . $item->bidangKeahlian[$i]->id_bidang_keahlian) }}">{{ $item->bidangKeahlian[$i]->nama_bidang_keahlian }}</a> 
            @if ($i != count($item->bidangKeahlian) - 1)
                ,
            @endif
        @endfor
        <br />
    </p>
    <div class="item-main">
        <div class="row">
            <div class="col-md-12">
                <h4>Deskripsi</h4>
                {{ $item->deskripsi_bidang_minat }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Daftar Dosen</h4>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center col-md-4 col-sm-5 col-xs-5">Nama Dosen</th>
                            <th class="text-center">Bidang Keahlian</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($item->dosen as $dosen)
                        <tr>
                            <td>
                                <a href="{{ URL::to('dosen/' . $dosen->nip_dosen) }}">{{ $dosen->pegawai->nama_lengkap }}</a>
                            </td>
                            <td>

                            @for ($i = 0; $i < count($dosen); $i++)
                                <a href="{{ URL::to('bidang_keahlian/' . $dosen['bidang_keahlian'][$i]['id_bidang_keahlian']) }}">
                                    {{ $dosen['bidang_keahlian'][$i]['nama_bidang_keahlian'] }}
                                </a>
                                @if ($i < count($dosen['bidang_keahlian']) - 1)
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
        <div class="row">
            <div class="col-md-12">
            <h4>Penawaran Judul Tiap Bidang Keahlian</h4>
            @foreach ($item->bidangKeahlian as $i => $bidangKeahlian)
                <h5>Bidang Keahlian: {{ $bidangKeahlian->nama_bidang_keahlian }}</h5>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Judul Tugas Akhir</th>
                            <th class="text-center">Dosen</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bidangKeahlian->penawaranJudul as $i => $penawaranJudul)
                        <tr>
                            <td>
                                <a href="{{ URL::to('judul/' . $penawaranJudul->id_penawaran_judul) }}">{{ $penawaranJudul->judul_tugas_akhir }}</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('dosen/' . $penawaranJudul->dosen->nip_dosen) }}">{{ $penawaranJudul->dosen->pegawai->nama_lengkap }}</a>
                            </td>
                            @if ($penawaranJudul->tugasAkhir == null)
                            <td class="text-center">
                                <span class="label label-success">Tersedia</span>
                            @else
                            <td>
                                <span class="label label-default">Diambil</span> : <a href="{{ URL::to( 'mahasiswa/' . $penawaranJudul->tugasAkhir->nrp_mahasiswa) }}">{{ $penawaranJudul->tugasAkhir->mahasiswa->nama_lengkap }}</a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach
            </div>
        </div>
    </div>
  </div>
</div>

@stop
