@extends('pages.dasbor.pengguna.mahasiswa.tambah')
@section('mahasiswa_satu')
<div class="row">
    <div class="col-md-3 col-sm-4 col-xs-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <img src="{{ URL::to('assets/images/dosen-default-profile-picture.jpg') }}" style="width: 100%" />
          </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-8 col-xs-8">
        <table class="table table-condensed table-striped">
            <tbody>
                <tr>
                    <td class="col-md-3 col-sm-4 col-xs-4"><strong>Nama</strong></td>
                    <td width="10px">: </td>
                    <td>{{ $item['nama_mahasiswa'] }}</td>
                </tr>
                <tr>
                    <td><strong>NRP</strong></td>
                    <td>: </td>
                    <td>{{ $item['nrp'] }}</td>
                </tr>
                <tr>
                    <td><strong>SKS Lulus</strong></td>
                    <td>: </td>
                    <td>{{ $item['sks_lulus'] }}</td>
                </tr>
                <tr>
                    <td><strong>SKS Tempuh</strong></td>
                    <td>: </td>
                    <td>{{ $item['sks_tempuh'] }}</td>
                </tr>
                <tr>
                    <td><strong>Dosen Wali</strong></td>
                    <td>: </td>
                    <td><a href="{{ URL::to('dosen/' . $item['id_dosen_wali']) }}" title="">{{ $item['nama_dosen_wali'] }}</a></td>
                    
                </tr>
            </tbody>
        </table>
        <form action="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/tambah') }}" method="POST">
            <input type="hidden" name="nrp" value="{{ $item['nrp'] }}" />
            <input type="hidden" name="nama_mahasiswa" value="{{ $item['nama_mahasiswa'] }}" />
            <button type="submit" class="btn btn-primary">Tambahkan</button>
        </form>
    </div>
</div>

@stop