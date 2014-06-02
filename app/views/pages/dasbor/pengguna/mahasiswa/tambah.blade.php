@extends('layouts.dasbor')
@section('custom_head')
<link href="{{ URL::to('assets/site-styles/dasbor.css') }}" rel="stylesheet">
@stop

@section('page_title')
Tambah Mahasiswa
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        @yield('message')
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tambah_banyak" data-toggle="tab">Tambah Banyak</a></li>
            <li><a href="#tambah_satu" data-toggle="tab">Tambah Satu</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tambah_banyak">
                <p><strong>Tambah Banyak</strong> menambahkan banyak mahasiswa sekaligus sebagai calon mahasiswa TA yang memiliki akses login ke sistem ini. Untuk memulai, klik tombol di bawah ini untuk mendapatkan daftar mahasiswa yang telah memenuhi syarat sebagai calon mahasiswa TA.</p>
                <div>
                    <a href="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/calon') }}" class="btn btn-primary">Tampilkan Daftar Calon Mahasiswa TA</a>
                </div>
                
                <br />
                @yield('mahasiswa_banyak')
            </div>
            <div class="tab-pane" id="tambah_satu">
                <p><strong>Tambah Satu</strong> memungkinkan penambahan mahasiswa satu persatu berdasarkan NRP. Isi kotak NRP di bawah ini kemudian tekan tombol Cari untuk mulai menambahkan calon mahasiswa TA.</p>
                <div>
                    <form class="form-inline" role="form" method="POST" action="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/cari') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nrp" placeholder="NRP">
                        </div>

                        <button type="submit" class="btn btn-default">Cari</button>
                    </form>
                </div>
                <br />
                @yield('mahasiswa_satu')
            </div>
        </div>
        
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop