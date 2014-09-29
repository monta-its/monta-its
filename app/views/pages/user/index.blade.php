@extends('layouts.default')
@section('content')
<h1>Daftar User</h1>

<a href="{{ URL::to('user/manage') }}" class="btn btn-primary">Kelola</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="col-md-1">No.</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Kontak</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ URL::to('user/detail/' . $item->id_user) }}" title="">{{ $item->name_user }}</a></td>
            <td>
                @if ($item->gender_user == 'l')
                Laki-laki
                @elseif ($item->gender_user == 'p')
                Perempuan
                @endif
            </td>
            <td>{{ $item->username_user }}</td>
            <td>{{ $item->email_user }}</td>
            <td>{{ $item->contact_user }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop