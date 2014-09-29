@extends('layouts.dasbor')
@section('page_title')
Dasbor Dosen
@stop
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Mahasiswa Sit In <a href="{{ URL::to('/dasbor/dosen/bimbingan') }}" class="pull-right btn btn-xs btn-default">Selengkapnya</a>
                Mahasiswa Bimbingan 
            </div>
            @if (count($mahasiswaBimbingan) > 0)
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NRP</th>
                        <th>Status Tugas Akhir</th>
                        <th>Target Selesai</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                    @foreach($mahasiswaBimbingan as $value)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$value->mahasiswa->nama_lengkap}}</td>
                        <td>{{$value->mahasiswa->nrp}}</td>
                        <td>{{$value->status}}</td>
                        <td>{{$value->target_selesai}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="panel-footer">Tidak ada data</div>
            @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Mahasiswa Sit In <a href="{{ URL::to('/dasbor/dosen/sit_in') }}" class="pull-right btn btn-xs btn-default">Selengkapnya</a>
            </div>
            @if (count($mahasiswaSitIn) > 0)
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>NRP</th>
                        <th>Waktu Sit In</th>
                        <th>Status Sit In</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                    @foreach($mahasiswaSitIn as $value)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$value->mahasiswa->nama_lengkap}}</td>
                        <td>{{$value->mahasiswa->nrp}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>
                        {{$value->status == 0? "Diajukan": ""}}
                        {{$value->status == -1? "Pembatalan": ""}}
                        {{$value->status == 1? "Diterima": ""}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="panel-footer">Tidak ada data</div>
            @endif
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Jadwal Sidang Mahasiswa Bimbingan <a href="{{ URL::to('/dasbor/dosen/sidang') }}" class="pull-right btn btn-xs btn-default">Selengkapnya</a>
            </div>
            @if (count($jadwalSidangBimbingan) > 0)
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Jenis Sidang</th>
                        <th class="text-center">Sesi (Waktu)</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Penguji</th>
                    </tr>
                </thead>
                <tbody>

                <?php $i = 1 ?>
                @foreach ($jadwalSidangBimbingan as $value)
                <tr>
                    @foreach($value->sidang as $sidang)
                    <td class="text-center">{{$i}}</td>
                    <td>{{$sidang->tugasAkhir->mahasiswa->nama_lengkap}}</td>
                    <td class="text-center">{{$sidang->jenis_sidang}}</td>
                    <td class="text-center">ke-{{$sidang->sesiSidang->sesi}}: {{date('H:i', strtotime($sidang->sesiSidang->waktu_mulai))}}-{{date('H:i', strtotime($sidang->sesiSidang->waktu_selesai))}}</td>
                    <td class="text-center">{{$sidang->ruangan->nama_ruangan}}</td>
                    <td class="text-center">
                        @foreach($sidang->pengujiSidang as $dosen)
                        <a href="{{URL::to('dosen/' . $dosen->nip)}}">{{$dosen->nama_lengkap}}</a><br/>
                        @endforeach
                    </td>
                    <?php $i++ ?>
                    @endforeach
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="panel-footer">Tidak ada data</div>
            @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Jadwal Menguji Sidang <a href="#" class="pull-right btn btn-xs btn-default">Selengkapnya</a>
            </div>
            @if (count($jadwalSidangMenguji) > 0)
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Jenis Sidang</th>
                        <th class="text-center">Sesi (Waktu)</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Penguji</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($jadwalSidangMenguji as $value)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>{{$value->tugasAkhir->mahasiswa->nama_lengkap}}</td>
                        <td class="text-center">{{$value->jenis_sidang}}</td>
                        <td class="text-center">ke-{{$value->sesiSidang->sesi}}: {{date('H:i', strtotime($value->sesiSidang->waktu_mulai))}}-{{date('H:i', strtotime($value->sesiSidang->waktu_selesai))}}</td>
                        <td class="text-center">{{$value->ruangan->nama_ruangan}}</td>
                        <td class="text-center">
                            @foreach($value->pengujiSidang as $dosen)
                            <a href="{{URL::to('dosen/' . $dosen->nip)}}">{{$dosen->nama_lengkap}}</a><br/>
                            @endforeach
                        </td>
                        <?php $i++ ?>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="panel-footer">Tidak ada data</div>
            @endif
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
