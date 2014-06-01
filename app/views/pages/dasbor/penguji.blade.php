@extends('layouts.dasbor')
@section('page_title')
Pemilihan Dosen Penguji
@stop

@section('content')
<div class="row">
        <div class="panel panel-default">
          <div class="panel-body" align="center">
            Dosen Penguji : <b>{{ $statusPenguji }}</b>
          </div>
        </div>
        <form role="form">
          <div class="form-group">
            <label for="exampleInputEmail1">Pilih Program Studi</label>
            <select class="form-control">
                @foreach($daftarProdi as $prodi)
                    <option value='{{ $prodi['kode'] }}'>{{ $prodi['nama'] }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Pilih Dosen Penguji</label>
            <table class="table table-hover">
                @foreach($daftarPenguji as $penguji)
                    <tr>
                        <td class="col-md-10">{{ $penguji['nama']}}</td>
                        <td><a href='dosen/{{ $penguji['NIP'] }}/penguji/pilih' class='btn btn-primary'>Pilih</a></td>
                    </tr>
                @endforeach
            </table>
          </div>
          <button type="submit" class="btn btn-default">Simpan</button>
        </form>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop