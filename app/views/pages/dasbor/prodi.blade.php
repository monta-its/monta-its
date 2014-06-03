@extends('layouts.dasbor')
@section('page_title')
Dasbor
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tugas Akhir
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="col-md-3">Dosen Pembimbing</td>
                            <td><a href="{{ URL::to('dasbor/pembimbing/pilih') }}">Pilih Pembimbing</a></td>
                        </tr>
                        <tr>
                            <td>Dosen Penguji</td>
                            <td><a href="{{ URL::to('dasbor/penguji/pilih') }}">Pilih Penguji</a></td>
                        </tr>
                        <tr>
                            <td>Proposal</td>
                            <td><a href="{{ URL::to('dasbor/proposal/unggah') }}">Unggah</a></td>
                        </tr>
                        <tr>
                            <td>Progress</td>
                            <td><a href="{{ URL::to('dasbor/progress') }}">Tambah Progress</a></td>
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