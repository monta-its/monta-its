@extends('layouts.custom-sidebar')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3>Profil Dosen</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tbody>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><strong>Nama</strong></td>
                        <td>: </td>
                        <td>Nama Dosen</td>
                    </tr>
                    <tr>
                        <td><strong>NIP</strong></td>
                        <td>: </td>
                        <td>12345678909876543</td>
                    </tr>
                    <tr>
                        <td><strong>Bidang Ahli</strong></td>
                        <td>: </td>
                        <td>Bidang Ahli 1, Bidang Ahli 2</td>
                    </tr>
                    <tr>
                        <td><strong>Topik TA</strong></td>
                        <td>: </td>
                        <td>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Judul Topik TA</th>
                                        <th class="text-center col-md-1 col-sm-2 col-xs-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::to('topik/id-topik') }}">Judul topik TA 1 menggunakan kakas kerja berbasis pengolah teks dengan abjad lokal yang terintegrasi dengan kalimat lengkap</a>
                                        </td>
                                        <td>
                                            <span class="label label-success">Tersedia</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::to('topik/id-topik') }}">Judul topik TA 2</a>
                                        </td>
                                        <td>
                                            <span class="label label-success">Tersedia</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::to('topik/id-topik') }}">Judul topik TA 3</a>
                                        </td>
                                        <td>
                                            <span class="label label-default">Sudah Diambil</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
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