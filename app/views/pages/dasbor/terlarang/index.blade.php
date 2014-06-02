@extends ('layouts.dasbor')
@section ('page_title')
{{ $page_title }}
@stop

@section ('content')
<div class="row">
    <div class="col-md-12">
        <p>{{ $message }}</p>
    </div>
</div>
@stop