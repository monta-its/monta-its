@extends('layouts.dasbor')
@section('page_title')
{{ $item->page_title }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <form role='form' method="post" accept-charset="utf-8">
            <table class="table table-condensed table-striped">
                <tbody>
                    <tr>
                        <th class="col-md-3">Nama Mahasiswa</th>
                        <td>{{ $item->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NRP</th>
                        <td>{{ $item->nrp }}</td>
                    </tr>
                    <tr>
                        <th>Judul Tugas Akhir</th>
                        <td>{{ $item->judul_tugas_akhir }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Nilai</th>
                        <td>{{ $item->jenis_nilai }}</td>
                    </tr>
                    <tr>
                        <th>Nilai</th>
                        <td>
                            <div class="col-md-2">
                                <input class="form-control input-sm" type="text" name="nilai" value="{{ $item->nilai }}">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="id_tugas_akhir" value="{{ $item->id_tugas_akhir }}">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="{{ URL::to('/dasbor/dosen/nilai') }}" class="btn btn-default">Batalkan</a>
        </form>
    </div>
</div>
@stop

@section('scripts')
@stop
