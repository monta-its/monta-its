@extends('pages.dasbor.dosen.form')

@section('title')
Sunting Dosen
@stop

@section('side_menu')

<button type="submit" name="aksi" value="terbitkan" class="btn btn-success">Perbarui &amp; Terbitkan</button>
<button type="submit" name="aksi" value="simpan" class="btn btn-default">Simpan</button>
<br />
<button type="submit" name="aksi" value="hapus" class="btn btn-warning">Hapus</button>

@stop