@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Sit In</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Daftar Sit In</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Nama Dosen</th>
                    <th class="col-md-2 text-center">NIP</th>
                    <th class="col-md-3 text-center">Waktu Sit In</th>
                    <th class="col-md-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Dosen Terpilih Sit In 1</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/sit_in/batalkan/' . 'id_dosen') }}" class="btn btn-warning">Batalkan</a>
                    </td>
                </tr>
                <tr>
                    <td>Nama Dosen Terpilih Sit In 2</td>
                    <td>12345678092837983</td>
                    <td>12 November 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/sit_in/batalkan/' . 'id_dosen') }}" class="btn btn-warning">Batalkan</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>Pilih Dosen</h2>
        <ul class="list-unstyled">
            <li>
                <h3>Nama Laboratorium 1</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Dosen</th>
                            <th class="text-center col-md-2">NIP</th>
                            <th class="text-center">Bidang Ahli</th>
                            <th class="text-center col-md-1">Sit In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Dosen 1</td>
                            <td>1234567890</td>
                            <td>
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 1</a>, 
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 2</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('dasbor/sit_in/pilih/' . 'id_dosen') }}" class="btn btn-default">Pilih</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Dosen 2</td>
                            <td>1234567890</td>
                            <td>
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 1</a>, 
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 2</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('dasbor/sit_in/pilih/' . 'id_dosen') }}" class="btn btn-default">Pilih</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Dosen 3</td>
                            <td>1234567890</td>
                            <td>
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 1</a>, 
                                <a href="{{ URL::to('bidang_ahli/' . 'id_bidang_ahli') }}">Bidang Ahli 2</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('dasbor/sit_in/pilih/' . 'id_dosen') }}" class="btn btn-default">Pilih</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </li>
        </ul>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop