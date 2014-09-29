@extends('layouts.dasbor')
@section('page_title')
Dasbor Mahasiswa
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
    @if ($sidang != null)
        <div class="panel panel-default">
            <div class="panel-heading">
                Sidang
            </div>
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <!--<th class="text-center">No.</th>-->
                        <th class="text-center">Jenis Sidang</th>
                        <th class="text-center">Waktu Mulai</th>
                        <th class="text-center">Waktu Selesai</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Penguji</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sidang as $i => $value)
                    <tr>
                        <!--<td>{{ $i + 1 }}</td>-->
                        <td style="text-transform: capitalize;">{{ $value->jenis_sidang }}</td>
                        <td>{{ $value->waktu_mulai }}</td>
                        <td>{{ $value->waktu_mulai }}</td>
                        <td>
                        @if ($value->ruangan->nama_ruangan != '')
                            {{ $value->ruangan->kode_ruangan }}
                        @else
                            {{ $value->ruangan->nama_ruangan }} ({{$value->ruangan->kode_ruangan}})
                        @endif
                        </td>
                        <td>
                        @if ($value->penguji != null)
                            @foreach ($value->penguji as $j => $penguji) 
                                <a href="{{ URL::to('dosen/' . $penguji->nip) }}">{{ $penguji->nama_lengkap }}</a>
                                @if ($j < $value->penguji->count() - 1)
                                ,
                                @endif
                            @endforeach
                        @else
                            <a href="{{ URL::to('dasbor/mahasiswa/penguji') }}" class="btn btn-xs btn-default">Tentukan</a>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($tugasAkhir != null)
        <div class="panel panel-default">
            <div class="panel-heading">
                Tugas Akhir
            </div>
            <table class="table table-condensed table-striped">
                <tbody>
                    <tr>
                        <td>Pembimbing</td>
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
                        <td>Status</td>
                        <td>
                        @if ($tugasAkhir->status != '')
                            <b>{{ $tugasAkhir->status }}</b>
                        @else
                            <span class="text-muted">tidak ditentukan</span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Mulai</td>
                        <td><b>{{ $tugasAkhir->tanggal_mulai }}</b></td>
                    </tr>
                    <tr>
                        <td>Target Selesai</td>
                        <td><b>{{ $tugasAkhir->target_selesai }}</b></td>
                    </tr>
                    @if ($tugasAkhir->penawaranJudul != null)
                    <tr>
                        <td class="col-md-3">Judul</td>
                        <td>
                            <a href="{{ URL::to('/judul/' . $tugasAkhir->id_penawaran_judul) }}">{{ $tugasAkhir->penawaranJudul->judul_tugas_akhir }}</a> <a href="{{ URL::to('/judul/batal/' . $tugasAkhir->id_penawaran_judul) }}" class="btn btn-xs btn-danger">Batalkan</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bidang Keahlian</td>
                        <td>
                            <a href="{{ URL::to('bidang_keahlian/' . $tugasAkhir->penawaranJudul->bidangKeahlian->id_bidang_keahlian) }}">{{ $tugasAkhir->penawaranJudul->bidangKeahlian->nama_bidang_keahlian }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Laboratorium</td>
                        <td>
                            <a href="{{ URL::to('prodi/' . $tugasAkhir->penawaranJudul->bidangKeahlian->bidangMinat->id_bidang_minat) }}">{{ $tugasAkhir->penawaranJudul->bidangKeahlian->bidangMinat->nama_bidang_minat }}</a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td class="col-md-3">Judul</td>
                        <td>
                            <a href="{{ URL::to('/judul') }}" class="btn btn-xs btn-default">Tentukan</a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Profil Mahasiswa
            </div>
            <table class="table table-condensed table-striped">
                <tbody>
                    <tr>
                        <td class="col-md-3">Nama</td>
                        <td>{{ $item->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td>NRP</td>
                        <td>{{ $item->nrp }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pemberitahuan
            </div>
            <div class="panel-body">
            @foreach ($pemberitahuan as $i => $value)
                <p>
                    <span>{{ $value->isi }}</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> {{ $value->created_at->diffForHumans() }}
                    </small>
                </p>
            @endforeach
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop