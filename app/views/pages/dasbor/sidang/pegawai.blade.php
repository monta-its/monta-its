@extends('layouts.dasbor')
@section('page_title')
Kelola Seminar &amp; Sidang
@stop

@section('content')
    <h2>Daftar Seminar Proposal</h2>
    <div class="panel panel-default">
        
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="text-center">Ruangan</th>
                    <th class="text-center">Sesi</th>
                    <th class="text-center">Berita Acara</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($l_item_proposal as $item)
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->tugasAkhir->mahasiswa->nama_lengkap }}</td>
                    <td class="text-center">{{ $item->ruangan->kode_ruangan }}</td>
                    <td class="text-center">{{ $item->sesiSidang->waktu_mulai }} - {{ $item->sesiSidang->waktu_selesai }}</td>
                    <td class="text-center"><a href="{{ URL::to('/dasbor/pegawai/berita_acara/' . $item->id_sidang) }}" class="btn btn-xs btn-primary">Unduh</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <h2>Daftar Sidang Akhir</h2>
    <div class="panel panel-default">
        
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="text-center">Ruangan</th>
                    <th class="text-center">Sesi</th>
                    <th class="text-center">Berita Acara</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($l_item_akhir as $item)
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->tugasAkhir->mahasiswa->nama_lengkap }}</td>
                    <td class="text-center">{{ $item->ruangan->kode_ruangan }}</td>
                    <td class="text-center">{{ $item->sesiSidang->waktu_mulai }} - {{ $item->sesiSidang->waktu_selesai }}</td>
                    <td class="text-center"><a href="{{ URL::to('/dasbor/pegawai/berita_acara/' . $item->id_sidang) }}" class="btn btn-xs btn-primary">Unduh</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop