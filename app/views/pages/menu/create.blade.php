@extends('layouts.default')
@section('content')
<div class="col-md-6">

    <h1>Buat Menu</h1>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Nama Menu </label>
            <input type="text" class="form-control" name="name_menu">
        </div>
        <div class="form-group">
            <label for="">URL</label>
            <input type="text" class="form-control" name="url_menu">
        </div>
        <div class="form-group">
            <label for="">Urutan</label>
            <input type="number" class="form-control" name="order_menu">
        </div>
        <div class="form-group">
            <label for="">Parent</label>
            <select class="form-control" name="parent_id">
                <option value="0">Tanpa parent</option>
            @foreach ($data['items'] as $item)
                <option value="{{ $item->id_menu }}">{{ $item->name_menu . ' - ' . $item->url_menu }}</option>
            @endforeach
            </select>
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