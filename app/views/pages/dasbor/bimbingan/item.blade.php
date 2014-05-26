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
                Profil Tugas Akhir
            </div>
            <div class="panel-body">
            <form role="form" action="" method="put" accept-charset="utf-8">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-3">Nama Mahasiswa</td>
                                <td>
                                    {{{ $item->mahasiswa->nama_lengkap }}}
                                </td>
                            </tr>
                            <tr>
                                <td>NRP Mahasiswa</td>
                                <td>
                                    {{{ $item->mahasiswa->nrp_mahasiswa}}}
                                </td>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td>
                                    <b>{{{$item->penawaranJudul->judul_tugas_akhir}}}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Target Selesai</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="target_selesai" value="" class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai</td>
                                <td>
                                    {{{$item->tanggal_mulai}}}
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Selesai</td>
                                <td>
                                    {{{ $item->tanggal_selesai }}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
