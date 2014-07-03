@extends('layouts.dasbor')
@section('page_title')
Dasbor Pegawai
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th class="col-md-4">Menu</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{URL::to('/dasbor/pegawai/syarat_mahasiswa')}}" class="btn btn-xs btn-default">Syarat Mahasiswa</a></td>
                    <td>Kelola daftar kelengkapan prasyarat tiap mahasiswa.</td>
                </tr>
                <tr>
                    <td><a href="{{URL::to('/dasbor/pegawai/syarat')}}" class="btn btn-xs btn-default">Syarat</a></td>
                    <td>Kelola rincian persyaratan untuk setiap tahap kegiatan.</td>
                </tr>
                <tr>
                    <td><a href="{{URL::to('/dasbor/pegawai/sidang')}}" class="btn btn-xs btn-default">Seminar &amp; Sidang</a></td>
                    <td>Kelola seminar &amp; sidang.</td>
                </tr>
                <tr>
                    <td><a href="{{URL::to('/dasbor/pegawai/sesi_sidang')}}" class="btn btn-xs btn-default">Kelola sesi seminar dan sidang.</a></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pemberitahuan
            </div>
            <div class="panel-body">
            @foreach ($pemberitahuan as $i => $value)
                <p>
                    <span>{{ $value->isi }}</span>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i> {{ $value->created_at->diffForHumans() }}
                    </small>
                </p>
            @endforeach
            @if ($pemberitahuan->count() == 0)
            Tidak ada pemberitahuan
            @endif
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop