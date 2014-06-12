@extends('layouts.default')
@section('page_title')
Login
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" action="" method="post" class="col-md-4">
            <div class="form-group">
                <label for="username">NRP / NIP</label>
                <input placeholder="NRP / NIP" name="username" class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input placeholder="password" name="password" type="password" class="form-control" />
            </div>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </div>
</div>
@stop