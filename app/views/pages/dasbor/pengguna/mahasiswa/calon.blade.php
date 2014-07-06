@extends('pages.dasbor.pengguna.mahasiswa.tambah')
@section('mahasiswa_banyak')
<form class="form-inline" role="form" method="POST" action="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/tambah') }}">  
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th class="col-md-1 text-center">No.</th>
                <th class="col-md-1 text-center">NRP</th>
                <th class="col-md-4 text-center">Nama Mahasiswa</th>
                <th class="col-md-1 text-center">SKS Lulus</th>
                <th class="col-md-1 text-center">SKS Tempuh</th>
                <th class="col-md-1 text-center">Pilih</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        @foreach ($l_item as $item)
            <tr>
                <td class="text-center">{{ $i++ }}</td>
                <td>{{ $item->nrp_mahasiswa }}</td>
                <td>{{ $item->nama_mahasiswa }}</td>
                <td class="text-center">{{ $item->sks_lulus }}</td>
                <td class="text-center">{{ $item->sks_tempuh }}</td>
                <td class="text-center"><input type="checkbox" name="nrp_mahasiswa[]" value="{{ $item->nrp_mahasiswa }}" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Tambahkan Data Terpilih</button>
    <button type="submit" class="btn btn-default">Tambahkan Semua</button>
</form>
@stop