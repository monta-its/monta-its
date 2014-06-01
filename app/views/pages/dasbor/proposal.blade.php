@extends('layouts.dasbor')
@section('page_title')
Pengunggahan(Upload) Proposal Tugas Akhir
@stop

@section('content')
<div class="row">
    <form class="form-inline" role="form">
          <div class="form-group">
            <input type="file" class="form-control" id="exampleInputEmail2">
          </div>
          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-upload"></span>
 Unggah</button>
        </form>
        <br>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table">
                <tbody>
                  <tr>
                    <td>Nama Berkas Proposal</td>
                    <td>{{ $proposal['nama'] }}</td>
                  </tr>
                  <tr>
                    <td>Format Berkas Proposal</td>
                    <td>{{ $proposal['format'] }}</td>
                  </tr>
                  <tr>
                    <td>Ukuran Berkas</td>
                    <td>{{ $proposal['ukuran'] }} MB</td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop