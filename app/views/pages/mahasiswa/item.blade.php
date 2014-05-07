@extends('layouts.custom-sidebar')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3>Profil Mahasiswa</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tbody>
                    <tr>
                        <td class="col-md-3 col-sm-4 col-xs-4"><strong>Nama</strong></td>
                        <td>: </td>
                        <td>{{ $item['nama_mahasiswa'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>NRP</strong></td>
                        <td>: </td>
                        <td>{{ $item['nrp_mahasiswa'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dosen Pembimbing</strong></td>
                        <td>: </td>
                        <td><a href="{{ URL::to('dosen/' . $item['id_dosen']) }}" title="">{{ $item['nama_dosen'] }}</a></td>
                    </tr>
                    <tr>
                        <td><strong>Topik TA</strong></td>
                        <td>: </td>
                        <td><a href="{{ URL::to('topik/' . $item['id_topik']) }}" title="">{{ $item['judul_topik'] }}</a></td>
                    </tr>
                    <tr>
                        <td><strong>Judul TA</strong></td>
                        <td>: </td>
                        <td><a href="{{ URL::to('judul/' . $item['id_judul']) }}" title="">{{ $item['judul_judul'] }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

@stop

@section('sidebar')
<div class="panel panel-default">
  <div class="panel-body">
    <img src="{{ URL::to('assets/images/dosen-default-profile-picture.jpg') }}" style="width: 100%" />
  </div>
</div>
@stop