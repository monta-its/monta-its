@extends('layouts.default')
@section('content')
<div class="col-md-6">

    <h1>Buat Permission</h1>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Rute Permission </label>
            <input type="text" class="form-control" name="route_permission">
        </div>
        <div class="form-group">
            <label for="">Enabled</label>
            <select class="form-control" name="enabled">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@stop