@extends ('layouts.default')
@section ('page_title')
{{ $page_title }}
@stop

@section ('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>
                    @yield('page_title')
                </h1>
                <br />
                <p>{{ $message }}</p>
            </div>
        </div>
    </div>
</div>
@stop