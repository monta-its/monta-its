@extends('layouts.dasbor')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Syarat</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form class="form-inline" action="" method="post" accept-charset="utf-8">
            <div class="form-group">
                <input type="text" name="nrp_mahasiswa" class="form-control" placeholder="NRP Mahasiswa"/>
            </div>
            <button type="submit" class="btn btn-default">Cari</button>
        </form>
    </div>
</div>

@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop