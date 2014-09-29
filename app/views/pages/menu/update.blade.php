@extends('layouts.default')
@section('content')
<div class="col-md-6">

    <h1>Sunting Menu</h1>

    @if ($data['item'] != null)
    <?php $item = $data['item']; ?>

    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Nama Menu </label>
            <input type="text" class="form-control" value="{{ $item->name_menu }}" name="name_menu">
        </div>
        <div class="form-group">
            <label for="">URL</label>
            <input type="text" class="form-control" value="{{ $item->url_menu }}" name="url_menu">
        </div>
        <div class="form-group">
            <label for="">Urutan</label>
            <input type="number" class="form-control" value="{{ $item->order_menu }}" name="order_menu">
        </div>
        <div class="form-group">
            <label for="">Parent</label>
            <select class="form-control" name="parent_id">
                <option value="0" @if ($item->parent_id == 0) {{ 'selected' }} @endif >Tanpa parent</option>
            @foreach ($data['items'] as $item)
                <option value="{{ $item->id_menu }}" @if ($item->parent_id == $item->id_menu) {{ 'selected' }} @endif >{{ $item->name_menu . ' - ' . $item->url_menu }}</option>
            @endforeach
            </select>
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