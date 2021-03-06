@extends('layouts.default')
@section('page_title')
{{ $page_title }}
@stop
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h1>{{ $page_title }}</h1>
    <br>
    <form action="" method="get" class="form-horizontal row">
        <!-- <div class="form-group col-md-4">
            <label for="filter" class="col-md-3 control-label">Filter</label>
            <div class="col-md-9">
                <select class="form-control" name="filter" id="filter">
                    <option>Laboratorium</option>
                    <option>Ruangan</option>
                </select>
            </div>
        </div> -->
        <div class="form-group col-md-4">
            <label for="filter" class="col-md-3 control-label">Urut</label>
            <div class="col-md-9">
                <select class="form-control" name="urut" id="urut">
                    <option value="tanggal" {{ $urut == 'tanggal' ? 'selected' : '' }}>Tanggal</option>
                    <option value="nama_lengkap" {{ $urut == 'nama_lengkap' ? 'selected' : '' }}>Nama Mahasiswa</option>
                    <option value="bidang_minat" {{ $urut == 'bidang_minat' ? 'selected' : '' }}>Laboratorium</option>
                    <option value="ruangan" {{ $urut == 'ruangan' ? 'selected' : '' }}>Ruangan</option>
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
                <th class="text-center">Laboratorium</th>
                <th class="text-center">Ruangan</th>
                <th class="text-center">Sesi</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        @foreach ($l_item as $item)
            <tr>
                <td class="text-center">{{ $i++ }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                <td>{{ $item->tugasAkhir->mahasiswa->nama_lengkap }}</td>
                <td>{{ $item->tugasAkhir->penawaranJudul->bidangKeahlian->bidangMinat->nama_bidang_minat }}</td>
                <td class="text-center">{{ $item->ruangan->kode_ruangan }}</td>
                <td class="text-center">{{ $item->sesiSidang->waktu_mulai }} - {{ $item->sesiSidang->waktu_selesai }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>    
  </div>
</div>


@stop

