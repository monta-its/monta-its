@extends('layouts.dasbor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Bimbingan Tugas Akhir</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>nama lengkap</td>
                            <td>nrp mahasiswa</td>
                            <td>status</td>
                            <td>target selesai</td>
                            <td>
                                <a href="{{ URL::to('dasbor/dosen/bimbingan/' . 'id_tugas_akhir') }}">Rincian / Sunting</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop