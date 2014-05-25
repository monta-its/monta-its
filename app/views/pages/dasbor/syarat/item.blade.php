@extends('layouts.dasbor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Persyaratan Mahasiswa</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form role="form" class="form-horizontal" action="" method="put" accept-charset="utf-8">
            <h3>Waktu Syarat 1</h3>
            <div class="checkbox">
                <label>
                    nama syarat 1
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <div class="checkbox">
                <label>
                    nama syarat 1
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <div class="checkbox">
                <label>
                    nama syarat 1
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <br />

            <h3>Waktu Syarat 2</h3>
            <div class="checkbox">
                <label>
                    nama syarat 2
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <div class="checkbox">
                <label>
                    nama syarat 2
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <div class="checkbox">
                <label>
                    nama syarat 2
                    <input type="hidden" name="kode_syarat1" value="0" />
                    <input type="checkbox" name="kode_syarat1" value="1" />
                </label>
            </div>
            <br />
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop