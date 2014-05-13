@extends('pages.dasbor.pengguna.mahasiswa.tambah')
@section('message')
<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Data {{ $pesan }} <strong> telah ditambahkan! </strong>
</div>
@stop