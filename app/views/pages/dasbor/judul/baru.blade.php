@extends('pages.dasbor.judul.form')

@section('title')
Judul Baru
@stop

@section('side_menu')

<button type="submit" name="aksi" value="terbitkan" class="btn btn-success">Terbitkan</button>
<button type="submit" name="aksi" value="simpan" class="btn btn-default">Simpan</button>
<button type="submit" name="aksi" value="hapus" class="btn btn-warning">Hapus</button>

@stop