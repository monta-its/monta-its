@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Bidang Keahlian</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::to('dasbor/bidang_keahlian/baru' )}}" class="btn btn-default">Buat Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Bidang Keahlian</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Judul Bidang Keahlian </td>
                    <td>Nama Penulis</td>
                    <td>
                        <a href="{{ URL::to('dasbor/bidang_keahlian/sunting/' . 'id_bidang_keahlian') }}">Sunting</a>
                        <a href="{{ URL::to('dasbor/bidang_keahlian/hapus/' . 'id_bidang_keahlian') }}">Hapus</a>
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