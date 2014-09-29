@extends('layouts.default')
@section('content')
<h1>Selamat Datang</h1>
@if (Auth::check())
<p>Anda login sebagai <strong>[{{ Auth::user()->getActingGroup()->name_group }}]</strong></p>
@endif
@stop