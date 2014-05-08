@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Dasbor</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Status Mahasiswa
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="col-md-3">Tugas Akhir</td>
                            <td><b>{{ $status['TA'] }}</b></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td><b>{{ $status['Prodi'] }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Profil Mahasiswa
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="col-md-3">Nama</td>
                            <td>{{ $profil['Nama'] }}</td>
                        </tr>
                        <tr>
                            <td>NRP</td>
                            <td>{{ $profil['NRP'] }}</td>
                        </tr>
                        <tr>
                            <td>Topik TA</td>
                            <td>{{ $profil['TopikTA'] }}</td>
                        </tr>
                        <tr>
                            <td>Judul TA</td>
                            <td>{{ $profil['JudulTA'] }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi TA</td>
                            <td>{{ $profil['DeskripsiTA'] }}</td>
                        </tr>
                        <tr>
                            <td>Pembimbing</td>
                            <td>{{ $profil['Pembimbing'] }}</td>
                        </tr>
                        <tr>
                            <td>Penguji</td>
                            <td>{{ $profil['Penguji'] }}</td>
                        </tr>
                        <tr>
                            <td>Mulai</td>
                            <td>{{ $profil['Mulai'] }}</td>
                        </tr>
                        <tr>
                            <td>Selesai</td>
                            <td>{{ $profil['Selesai'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notifikasi
            </div>
            <div class="panel-body">
                <p>
                    <strong>Dosen Pembimbing</strong> 
                    <span>memberikan <a href="{{ URL::to('dasbor/proposal') }}" title="">penilaian</a> terhadap proposal Anda.</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> 1 days ago
                    </small>
                </p>
                <p>
                    <strong>Dosen Pembimbing</strong> 
                    <span>menerima Anda sebagai mahasiswa bimbingannya.</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> 2 days ago
                    </small>
                </p>
                <p>
                    <strong>Dosen Pembimbing</strong> 
                    <span>memverifikasi <a href="{{ URL::to('dasbor/progress/id_progress') }}" title="">progress bimbingan</a> Anda.</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> 5 days ago
                    </small>
                </p>
                <p>
                    <strong>Petugas Jurusan</strong> 
                    <span>menyetujui syarat proposal Anda.</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> 1 week day ago
                    </small>
                </p>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop