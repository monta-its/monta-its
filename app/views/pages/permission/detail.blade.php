@extends('layouts.default')
@section('content')
    <h1>Rincian Permission</h1>
    <?php $item = $data['item']; ?>
    @if ($data['item'] != null)
    <a href="{{ URL::to('permission/update/' . $item->id_permission) }}" class="btn btn-primary">Sunting</a>
    <a href="{{ URL::to('permission/delete/' . $item->id_permission) }}" class="btn btn-danger">Hapus</a>
    @endif
    <a href="{{ URL::to('permission') }}" class="btn btn-default">Kembali ke Daftar</a>
    <br><br>
    @if ($data['item'] != null)
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th class="col-md-3">Rute Permission</th>
                <td>{{ $item->route_permission }}</td>
            </tr>
            <tr>
                <th>Group pengakses</th>
                <td>
                @if ($item->group->count() >0)
                    @foreach ($item->group as $group)
                        <li>
                            <a href="{{ URL::to('group/detail/' . $group->id_group) }}" title="">{{ $group->name_group }}</a>
                        </li>
                    @endforeach
                @else
                    Tidak ada
                @endif
                </td>
            </tr>
            <tr>
                <th>Enabled</th>
                <td>{{ $item->enabled ? 'Ya' : 'Tidak' }}</td>
            </tr>
        </tbody>
    </table>
    @endif
@stop