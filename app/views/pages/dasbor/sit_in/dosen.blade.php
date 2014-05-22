@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Sit In</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Daftar Sit In Saat Ini</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="col-md-2 text-center">NRP</th>
                    <th class="col-md-3 text-center">Waktu Permintaan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Mahasiswa 1</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa 2</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                </tr>
            </tbody>
        </table>

        <h2>Daftar Permintaan Sit In</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="col-md-2 text-center">NRP</th>
                    <th class="col-md-3 text-center">Waktu Permintaan</th>
                    <th class="col-md-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Mahasiswa 1</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/dosen/sit_in/setujui/' . 'nrp_mahasiswa') }}" class="btn btn-warning">Setujui</a>
                    </td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa 2</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/dosen/sit_in/setujui/' . 'nrp_mahasiswa') }}" class="btn btn-warning">Setujui</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>Daftar Pembatalan Sit In</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="col-md-2 text-center">NRP</th>
                    <th class="col-md-3 text-center">Waktu Permintaan</th>
                    <th class="col-md-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Mahasiswa 1</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/dosen/sit_in/batalkan/' . 'nrp_mahasiswa') }}" class="btn btn-warning">Terima Pembatalan</a>
                    </td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa 2</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/dosen/sit_in/batalkan/' . 'nrp_mahasiswa') }}" class="btn btn-warning">Terima Pembatalan</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop