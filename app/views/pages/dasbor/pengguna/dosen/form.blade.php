@extends('layouts.dasbor')
@section('page_title')
@yield('title')
@stop

@section('content')
<form role="form" action="" method="post" accept-charset="utf-8">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" class="form-control input-lg" id="judulDosen" name="judulDosen" placeholder="Judul Dosen">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="10" name="isiDosen" id="isiDosen"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <input type="hidden" name="idDosen" value="" />
            @yield('side_menu')
        </div>
    </div>
</form>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop