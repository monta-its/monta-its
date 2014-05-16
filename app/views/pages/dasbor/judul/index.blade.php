@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Judul</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/judul/baru' )}}" class="btn btn-default">Buat Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul Topik</td>
                    <td>Nama Penulis</td>
                    <td><a href="{{ URL::to('mahasiswa/' . 'nrp_mahasiswa') }}" title="oleh Nama Mahasiswa">Terambil</a></td>
                    <td>
                        <a href="{{ URL::to('dasbor/judul/sunting/' . 'id_judul') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/judul/hapus/' . 'id_judul') }}">Hapus</a>
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