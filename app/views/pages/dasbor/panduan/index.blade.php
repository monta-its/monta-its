@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Panduan</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/panduan/baru' )}}" class="btn btn-default">Buat Baru</a>
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
                    <th>Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul Panduan</td>
                    <td>Nama Penulis</td>
                    <td><a href="{{ URL::to('files/panduan/' . 'path_panduan') }}">Nama File atau Link</a></td>
                    <td>
                        <a href="{{ URL::to('dasbor/panduan/sunting/' . 'id_panduan') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/panduan/hapus/' . 'id_panduan') }}">Hapus</a>
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