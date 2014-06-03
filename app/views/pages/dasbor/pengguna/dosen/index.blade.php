@extends('layouts.dasbor')
@section('page_title')
Kelola Dosen
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/dosen/baru' )}}" class="btn btn-default">Buat Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul Dosen</td>
                    <td>Nama Penulis</td>
                    <td>
                        <a href="{{ URL::to('dasbor/dosen/sunting/' . 'id_dosen') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/dosen/hapus/' . 'id_dosen') }}">Hapus</a>
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