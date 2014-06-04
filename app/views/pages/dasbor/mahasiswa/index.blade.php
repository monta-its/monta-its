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
                                <a href="{{ URL::to('dosen/' . $penguji->nip_dosen) }}">{{ $penguji->pegawai->nama_lengkap }}</a>
                                @if ($j < $value->penguji->count() - 1)
                                ,
                                @endif
                            @endforeach
                        @else
                            <a href="{{ URL::to('dasbor/mahasiswa/penguji') }}" class="btn btn-default">Tentukan</a>
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
                            <a href="{{ URL::to('dosen/' . $pembimbing->nip_dosen) }}">{{ $pembimbing->pegawai->nama_lengkap }}</a>
                            @if ($i < $tugasAkhir->dosenPembimbing->count() - 1)
                            ,
                            @endif
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-3">Judul</td>
                        <td>
                            <b>{{ $tugasAkhir->penawaranJudul->judul_tugas_akhir }}</b>
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
                        <td>Tanggal Selesai</td>
                        <td><b>{{ $tugasAkhir->tanggal_selesai }}</b></td>
                    </tr>
                    <tr>
                        <td>Topik</td>
                        <td>
                            <a href="{{ URL::to('topik/' . $tugasAkhir->penawaranJudul->id_topik) }}">{{ $tugasAkhir->penawaranJudul->topik->topik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bidang Keahlian</td>
                        <td>
                            <a href="{{ URL::to('bidang_keahlian/' . $tugasAkhir->penawaranJudul->topik->id_bidang_keahlian) }}">{{ $tugasAkhir->penawaranJudul->topik->bidangKeahlian->nama_bidang_keahlian }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Laboratorium</td>
                        <td>
                        @foreach ($tugasAkhir->penawaranJudul->topik->bidangKeahlian->bidangMinat as $i => $bidangMinat)
                            <a href="{{ URL::to('prodi/' . $bidangMinat->id_bidang_minat) }}">{{ $bidangMinat->nama_bidang_minat }}</a>
                            @if ($i < $tugasAkhir->penawaranJudul->topik->bidangKeahlian->bidangMinat->count() - 1)
                            ,
                            @endif
                        @endforeach
                        </td>
                    </tr>
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
                        <td>{{ $item->nrp_mahasiswa }}</td>
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