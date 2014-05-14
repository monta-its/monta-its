@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Berita</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/berita/baru' )}}" class="btn btn-default">Buat Baru</a>
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
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul Berita</td>
                    <td>Nama Penulis</td>
                    <td>12 Maret 2013 10:00</td>
                    <td>
                        <a href="{{ URL::to('dasbor/berita/sunting/' . 'id_berita') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/berita/hapus/' . 'id_berita') }}">Hapus</a>
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