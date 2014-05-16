@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Sidang</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/sidang/baru' )}}" class="btn btn-default">Buat Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Sidang</th>
                    <th>Penulis</th>
                    <th>Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sidang Siapa</td>
                    <td>Nama Penulis</td>
                    <td><a href="{{ URL::to('mahasiswa/' . 'nrp_mahasiswa') }}">Nama Mahasiswa</a></td>
                    <td>
                        <a href="{{ URL::to('dasbor/sidang/sunting/' . 'id_sidang') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/sidang/hapus/' . 'id_sidang') }}">Hapus</a>
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