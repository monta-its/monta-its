@extends('layouts.default')
@section('content')
<h1>Kelola User</h1>

<a href="{{ URL::to('user/create') }}" class="btn btn-primary">Tambah</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="col-md-1">No.</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Username</th>
            <th>E-mail</th>
            <th class="col-md-2">Aksi</th>
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
            <td>
                <a href="{{ URL::to('user/update/' . $item->id_user) }}" class="btn btn-primary btn-xs">Sunting</a>
                <a href="{{ URL::to('user/delete/' . $item->id_user) }}" class="btn btn-danger btn-xs">Hapus</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop