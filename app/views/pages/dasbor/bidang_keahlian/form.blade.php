@extends('layouts.dasbor')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">@yield('title')</h1>
    </div>
</div>
<form role="form" action="" method="post" accept-charset="utf-8">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" class="form-control input-lg" id="judulBidangKeahlian " name="judulBidangKeahlian " placeholder="Judul Bidang Keahlian ">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="10" name="isiBidangKeahlian " id="isiBidangKeahlian "></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <input type="hidden" name="idBidangKeahlian " value="" />
            @yield('side_menu')
        </div>
    </div>
</form>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop