@extends('layouts.dasbor')
@section('page_title')
Penilaian
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Nilai Tugas Akhir Mahasiswa Bimbingan</div>
        @if ($tugasAkhirBimbingan->count() == 0)
            <div class="panel-body">
               Tidak ada data 
            </div>
        @else
            <table class="table table-striped table condensed">
                <thead>
                    <tr>
                        <th class="col-md-1">No.</th>
                        <th>Nama Mahasiswa</th>
                        <th class="col-md-2">Nilai Seminar</th>
                        <th class="col-md-2">Nilai Sidang</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tugasAkhirBimbingan as $i => $ta)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><a href="{{ URL::to('/mahasiswa/' . $ta->nrp ) }}" title="NRP {{ $ta->nrp }}">{{ $ta->mahasiswa->nama_lengkap }}</a></td>
                        <td>
                    @if ($ta->nilaiProposal()->where('nip', $nip)->count() == 0)
                        <a href="{{ URL::to('/dasbor/dosen/nilai/proposal/' . $ta->nrp) }}" class="btn btn-default btn-xs">tentukan</a>
                    @else
                        <a href="{{ URL::to('/dasbor/dosen/nilai/proposal/' . $ta->nrp) }}" class="btn btn-default btn-xs">{{ $ta->nilaiProposal()->where('nip', $nip)->get()->nilai }}</a>
                    @endif
                        </td>
                        <td>
                    @if ($ta->nilaiAkhir()->where('nip', $nip)->count() == 0)
                        <a href="{{ URL::to('/dasbor/dosen/nilai/akhir/' . $ta->nrp) }}" class="btn btn-default btn-xs">tentukan</a>
                    @else
                        <a href="{{ URL::to('/dasbor/dosen/nilai/akhir/' . $ta->nrp) }}" class="">{{ $ta->nilaiAkhir()->where('nip', $nip)->get()->first()->nilai }}</a>
                    @endif
                        </td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Nilai Tugas Akhir Mahasiswa Seminar &amp; Sidang</div>
        @if ($seminarDanSidang->count() == 0)
            <div class="panel-body">
               Tidak ada data 
            </div>
        @else
            <table class="table table-striped table condensed">
                <thead>
                    <tr>
                        <th class="col-md-1">No.</th>
                        <th>Nama Mahasiswa</th>
                        <th class="col-md-2">Jenis Evaluasi</th>
                        <th class="col-md-2">Nilai</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($seminarDanSidang as $i => $ss)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td><a href="{{ URL::to('/mahasiswa/' . $ss->tugasAkhir->nrp ) }}" title="NRP {{ $ss->tugasAkhir->nrp }}">{{ $ss->tugasAkhir->mahasiswa->nama_lengkap }}</a></td>
                        @if ($ss->jenis_sidang == 'akhir')
                        <td>Sidang Akhir</td>
                        <td>
                            @if ($ss->tugasAkhir->nilaiAkhir()->where('nip', $nip)->count() == 0)
                                <a href="{{ URL::to('/dasbor/dosen/nilai/akhir/' . $ss->tugasAkhir->nrp) }}" class="btn btn-default btn-xs">tentukan</a>
                            @else
                                <a href="{{ URL::to('/dasbor/dosen/nilai/akhir/' . $ss->tugasAkhir->nrp) }}" class="">{{ $ss->tugasAkhir->nilaiAkhir()->where('nip', $nip)->get()->first()->nilai }}</a>
                            @endif
                        </td>
                        @else
                        <td>Seminar Proposal</td>
                        <td>
                            @if ($ss->tugasAkhir->nilaiProposal()->where('nip', $nip)->count() == 0)
                                <a href="{{ URL::to('/dasbor/dosen/nilai/proposal/' . $ss->tugasAkhir->nrp) }}" class="btn btn-default btn-xs">tentukan</a>
                            @else
                                <a href="{{ URL::to('/dasbor/dosen/nilai/proposal/' . $ss->tugasAkhir->nrp) }}" class="">{{ $ss->tugasAkhir->nilaiProposal()->where('nip', $nip)->get()->first()->nilai }}</a>
                            @endif
                        </td>
                        @endif
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        </div>

    </div>
</div>
@stop

@section('scripts')
@stop
