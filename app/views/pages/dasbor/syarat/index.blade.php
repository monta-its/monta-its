@extends('layouts.dasbor')
@section('page_title')
Kelola Syarat
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Syarat Pra Sit In <a class="btn btn-primary btn-xs pull-right" href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Tambah</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Syarat</th>
                            <th>Jenis Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pem</td>
                            <td>Lulus PEM</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>sks_90</td>
                            <td>Jumlah SKS lebih dari 90</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Syarat Pra Bimbingan <a class="btn btn-primary btn-xs pull-right" href="{{ URL::to('/dasbor/pegawai/syarat/tambah') }}">Tambah</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Syarat</th>
                            <th>Jenis Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pem</td>
                            <td>Lulus PEM</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>sks_90</td>
                            <td>Jumlah SKS lebih dari 90</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Syarat Pra Seminar <a class="btn btn-primary btn-xs pull-right" href="{{ URL::to('/dasbor/pegawai/syarat/tambah') }}">Tambah</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Syarat</th>
                            <th>Jenis Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pem</td>
                            <td>Lulus PEM</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>sks_90</td>
                            <td>Jumlah SKS lebih dari 90</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Syarat Pra Sidang <a class="btn btn-primary btn-xs pull-right" href="{{ URL::to('/dasbor/pegawai/syarat/tambah') }}">Tambah</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Syarat</th>
                            <th>Jenis Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pem</td>
                            <td>Lulus PEM</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>sks_90</td>
                            <td>Jumlah SKS lebih dari 90</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                        <tr>
                            <td>kode_syarat</td>
                            <td>Nama Syarat yang Lebih Rinci</td>
                            <td>Reguler</td>
                            <td><a href="{{ URL::to('/dasbor/pegawai/syarat/sunting') }}">Sunting</a> | <a href="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
