@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->topik }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Prodi: </span>
            @foreach ($item->bidangKeahlian->bidangMinat as $i => $bidangMinat) 
                <a href="{{ URL::to('prodi/'. $bidangMinat->kode_bidang_minat) }}">
                    {{ $bidangMinat->kode_bidang_minat }}
                </a>
                @if ($i != $item->bidangKeahlian->bidangMinat->count() - 1)
                    ,
                @endif
            @endforeach
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
                        @foreach ($item->penawaranJudul as $penawaranJudul)
                            <tr>
                            @if ($penawaranJudul->tugasAkhir != null)
                                <td>
                                    <a href="{{ URL::to('mahasiswa/' . $penawaranJudul->tugasAkhir->nrp_mahasiswa) }}">{{ $penawaranJudul->tugasAkhir->mahasiswa->nama_lengkap }}</a>
                                </td>
                            @else
                                <td>
                                    <span class="text-muted">Belum diambil</span>
                                </td>
                            @endif
                                
                                <td>
                                    <a href="{{ URL::to('judul/' . $penawaranJudul->id_penawaran_judul) }}">
                                        {{ $penawaranJudul->judul_tugas_akhir }}
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
