@extends('layouts.dasbor')
@section('page_title')
Sunting Jadwal
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <form role="form" action="{{ URL::to('/dasbor/dosen/jadwal') }}" method="get" accept-charset="utf-8">
            <input type="hidden" name="nip" value="1234567890" />
            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control">
                    <option value=""></option>
                    <option value="1">Senin</option>
                    <option value="2">Selasa</option>
                    <option value="3">Rabu</option>
                    <option value="4">Kamis</option>
                    <option value="5">Jumat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sesi">Sesi Sidang</label>
                <select name="sesi" class="form-control">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="apakah_tersedia">Status</label>
                <select name="apakah_tersedia" class="form-control">
                    <option value=""></option>
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@stop
