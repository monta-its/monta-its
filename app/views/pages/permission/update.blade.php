@extends('layouts.default')
@section('content')
<div class="col-md-6">

    <h1>Sunting Permission</h1>

    @if ($data['item'] != null)
    <?php $item = $data['item']; ?>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Rute Permission </label>
            <input type="text" class="form-control" value="{{ $item->route_permission }}" name="route_permission">
        </div>
        <div class="form-group">
            <label for="">Enabled</label>
            <select class="form-control" name="enabled">
                <option value="1" @if ($item->enabled == '1') {{ 'selected' }} @endif >Ya</option>
                <option value="0" @if ($item->enabled == '0') {{ 'selected' }} @endif >Tidak</option>
            </select>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-success">Simpan</button>
    </form>
    @endif
</div>
@stop