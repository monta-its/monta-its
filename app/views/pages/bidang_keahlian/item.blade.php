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
            <a href="{{ URL::to('prodi/'. $item->bidangMinat->id_bidang_minat) }}">
                {{ $item->bidangMinat->nama_bidang_minat }}
            </a>
            <br>
            <span class="glyphicon glyphicon-user"></span>
            <span>Dosen: </span>
            @foreach ($item->dosen as $i => $dosen)
                <a class="author" href="{{ URL::to('dosen/'. $dosen->nip ) }}">{{ $dosen->nama_lengkap }}</a>
                @if ($i < $item->dosen->count() - 1)
                    <span> · </span>
                @endif
            @endforeach
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    <h4>Deskripsi</h4>
                    {{ $item->deskripsi_bidang_keahlian }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Daftar Penawaran Judul</h4>
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Judul Tugas Akhir</th>
                                <th class="text-center">Dosen</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($item->penawaranJudul as $i => $penawaranJudul)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('judul/' . $penawaranJudul->id_penawaran_judul) }}">{{ $penawaranJudul->judul_tugas_akhir }}</a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('dosen/' . $penawaranJudul->dosen->nip) }}">{{ $penawaranJudul->dosen->nama_lengkap }}</a>
                                </td>
                                @if ($penawaranJudul->tugasAkhir == null)
                                <td class="text-center">
                                    <span class="label label-success">Tersedia</span>
                                @else
                                <td>
                                    <span class="label label-default">Diambil</span> : <a href="{{ URL::to( 'mahasiswa/' . $penawaranJudul->tugasAkhir->nrp) }}">{{ $penawaranJudul->tugasAkhir->mahasiswa->nama_lengkap }}</a>
                                @endif
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
</div>

@stop