@extends('layouts.default')
@section('content')
    <h1>Rincian User</h1>
    <?php $item = $data['item']; ?>
    @if ($data['item'] != null)
    <a href="{{ URL::to('user/update/' . $item->id_user) }}" class="btn btn-primary">Sunting</a>
    <a href="{{ URL::to('user/delete/' . $item->id_user) }}" class="btn btn-danger">Hapus</a>
    @endif
    <a href="{{ URL::to('user') }}" class="btn btn-default">Kembali ke Daftar</a>
    <br><br>
    @if ($data['item'] != null)
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th class="col-md-3">Username</th>
                <td>{{ $item->username_user }}</td>
            </tr>
            <tr>
                <th>Kata Sandi</th>
                <td><a href="{{ URL::to('user/change_password/' . $item->id_user) }}" title="">Ganti kata sandi</a></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $item->name_user }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $item->email_user }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $item->address_user }}</td>
            </tr>
            <tr>
                <th>Kontak</th>
                <td>{{ $item->contact_user }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>
                    @if ($item->gender_user == 'l')
                    Laki-laki
                    @elseif ($item->gender_user == 'p')
                    Perempuan
                    @endif
                </td>
            </tr>
            <tr>
                <th>Group</th>
                <td>
                @if ($item->group->count() == 0)
                    <span class="text-muted">Tidak terdaftar di group apapun</span>
                @endif
                @foreach ($item->group as $group)
                    <li><a href="{{ URL::to('group/detail/' . $group->id_group) }}">{{ $group->name_group }}</a></li>
                @endforeach
                </td>
            </tr>
            <tr>
                <th>Enabled</th>
                <td>{{ $item->enabled ? '<span class="label label-success">Ya</span>' : '<span class="label label-default">Tidak</span>' }}</td>
            </tr>
        </tbody>
    </table>
    @endif
@stop