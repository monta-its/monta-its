@extends('layouts.default')

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <form action="" method="" class="form-horizontal row">
        <div class="form-group col-md-4">
            <label for="filter" class="col-md-3 control-label">Filter</label>
            <div class="col-md-9">
                <select class="form-control" name="filter" id="filter">
                    <option>Prodi</option>
                    <option>Ruang Sidang</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="filter" class="col-md-3 control-label">Order</label>
            <div class="col-md-9">
                <select class="form-control" name="filter" id="filter">
                    <option>Tanggal</option>
                    <option>Nama Mahasiswa</option>
                    <option>Prodi</option>
                    <option>Ruang Sidang</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary" type="submit">Terapkan</button>
        </div>
    </form>
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Prodi</th>
                <th class="text-center">Ruang Sidang</th>
            </tr>
        </thead>
        <tbody>
        @for ($i = 0; $i < count($l_item) ; $i++)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $l_item[$i]['tanggal_sidang'] }}</td>
                <td>{{ $l_item[$i]['nama_mahasiswa'] }}</td>
                <td>{{ $l_item[$i]['nama_prodi'] }}</td>
                <td class="text-center">{{ $l_item[$i]['ruang_sidang'] }}</td>
            </tr>
        @endfor
        </tbody>
    </table>    
  </div>
</div>

@stop
