@extends('layouts.default')
@section('content')
<h1>Login</h1>
<form role="form" action="" method="post" class="col-md-4">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" placeholder="Username" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" class="form-control" name="password">
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn btn-success">Login</button>
</form>
@stop