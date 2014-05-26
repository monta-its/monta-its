@extends('layouts.dasbor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Bimbingan Tugas Akhir</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Mahasiswa Bimbingan
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NRP</th>
                            <th>Status Tugas Akhir</th>
                            <th>Target Selesai</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach($mahasiswaBimbingan as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->mahasiswa->nama_lengkap}}</td>
                            <td>{{$item->mahasiswa->nrp_mahasiswa}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->target_selesai}}</td>
                            <td>
                                <a href="{{ URL::to('dasbor/dosen/bimbingan/' . $item->id_tugas_akhir) }}">Rincian / Sunting</a>
                            </td>
                        </tr>
                    <?php $i++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
