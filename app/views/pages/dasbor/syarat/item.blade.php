@extends('layouts.dasbor')
@section('page_title')
Sunting Syarat
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <form role="form" action="{{ URL::to('/dasbor/pegawai/syarat') }}" method="get" accept-charset="utf-8">
            <div class="form-group">
                <label for="kode_syarat">Kode Syarat</label>
                <input type="text" name="kode_syarat" class="form-control" />
            </div>
            <div class="form-group">
                <label for="nama_syarat">Nama Syarat</label>
                <input type="text" name="nama_syarat" class="form-control" />
            </div>
            <div class="form-group">
                <label for="waktu_syarat">Waktu Syarat</label>
                <select name="waktu_syarat" class="form-control">
                    <option value=""></option>
                    <option value="pra_sit_in">Pra Sit In</option>
                    <option value="pra_bimbingan">Pra Bimbingan / Pra FRS</option>
                    <option value="pra_seminar_proposal">Pra Seminar Proposal</option>
                    <option value="pra_sidang_akhir">Pra Sidang Akhir</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_mahasiswa">Jenis Mahasiswa</label>
                <select name="jenis_mahasiswa" class="form-control">
                    <option value=""></option>
                    <option value="reguler">Reguler</option>
                    <option value="lintas_jalur">Lintas Jalur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@stop
