@extends('layouts.custom-sidebar')
@section('page_title')
Profil {{ $item->nama_lengkap }}
@stop
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3>Profil Mahasiswa</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped">
                <tbody>
                    <tr>
                        <td class="col-md-3 col-sm-4 col-xs-4"><strong>Nama</strong></td>
                        <td>: </td>
                        <td>{{ $item->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>NRP</strong></td>
                        <td>: </td>
                        <td>{{ $item->nrp }}</td>
                    </tr>
                    @if ($tugasAkhir != null)
                        <tr>
                            <td><strong>Dosen Pembimbing</strong></td>
                            <td>: </td>
                            <td>
                            @foreach ($tugasAkhir->dosenPembimbing as $i => $pembimbing) 
                                <a href="{{ URL::to('dosen/' . $pembimbing->nip) }}">{{ $pembimbing->nama_lengkap }}</a>
                                @if ($i < $tugasAkhir->dosenPembimbing->count() - 1)
                                ,
                                @endif
                            @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status Tugas Akhir</strong></td>
                            <td>: </td>
                            <td>
                            @if ($tugasAkhir->status != '')
                                {{ $tugasAkhir->status }}
                            @else
                                <span class="text-muted">tidak ditentukan</span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Mulai</strong></td>
                            <td>: </td>
                            <td>{{ $tugasAkhir->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <td><strong>Target Selesai</strong></td>
                            <td>: </td>
                            <td>
                            @if ($tugasAkhir->target_selesai != 0)
                            {{ $tugasAkhir->target_selesai }}
                            @else
                            Belum ditentukan
                            @endif
                            </td>
                        </tr>
                        @if ($tugasAkhir->penawaranJudul != null)
                        <tr>
                            <td class="col-md-3"><strong>Judul</strong></td>
                            <td>: </td>
                            <td>
                                {{ $tugasAkhir->penawaranJudul->judul_tugas_akhir }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Bidang Keahlian</strong></td>
                            <td>: </td>
                            <td>
                                <a href="{{ URL::to('bidang_keahlian/' . $tugasAkhir->penawaranJudul->bidangKeahlian->id_bidang_keahlian) }}">{{ $tugasAkhir->penawaranJudul->bidangKeahlian->nama_bidang_keahlian }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Laboratorium</strong></td>
                            <td>: </td>
                            <td>
                                <a href="{{ URL::to('prodi/' . $tugasAkhir->penawaranJudul->bidangKeahlian->bidangMinat->id_bidang_minat) }}">{{ $tugasAkhir->penawaranJudul->bidangKeahlian->bidangMinat->nama_bidang_minat }}</a>
                            </td>
                        </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

@stop

@section('sidebar')
<div class="panel panel-default">
  <div class="panel-body">
    <img src="{{ URL::to('assets/images/dosen-default-profile-picture.jpg') }}" style="width: 100%" />
  </div>
</div>
@stop