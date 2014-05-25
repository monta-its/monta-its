@extends('layouts.dasbor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Dasbor Dosen</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Mahasiswa Bimbingan
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NRP</th>
                            <th>Status Tugas Akhir</th>
                            <th>Target Selesai</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Mahasiswa Sit In
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NRP</th>
                            <th>Waktu Sit In</th>
                            <th>Status Sit In</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
                Jadwal Sidang Mahasiswa Bimbingan
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Jenis Sidang</th>
                            <th class="text-center">Waktu Mulai</th>
                            <th class="text-center">Waktu Selesai</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Penguji</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Jadwal Menguji Sidang
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Jenis Sidang</th>
                            <th class="text-center">Waktu Mulai</th>
                            <th class="text-center">Waktu Selesai</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Penguji</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop