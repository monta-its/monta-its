@extends('layouts.default')
@section('content')
    <h1>Rincian Menu</h1>
    <?php $item = $data['item']; ?>
    @if ($data['item'] != null)
    <a href="{{ URL::to('menu/update/' . $item->id_menu) }}" class="btn btn-primary">Sunting</a>
    <a href="{{ URL::to('menu/delete/' . $item->id_menu) }}" class="btn btn-danger">Hapus</a>
    @endif
    <a href="{{ URL::to('menu') }}" class="btn btn-default">Kembali ke Daftar</a>
    <br><br>
    @if ($data['item'] != null)
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th class="col-md-3">Nama Menu</th>
                <td>{{ $item->name_menu }}</td>
            </tr>
            <tr>
                <th>URL</th>
                <td>{{ $item->url_menu }}</td>
            </tr>
            <tr>
                <th>Urutan</th>
                <td>{{ $item->order_menu }}</td>
            </tr>
            <tr>
                <th>Parent</th>
            @if ($item->parent != null)
                <td><a href="{{ URL::to('menu/detail/' . $item->parent_id) }}" title="">{{ $item->parent->name_menu . ' - ' . $item->parent->url_menu }}</a></td>
            @else
                <td>Tidak ada</td>
            @endif
            </tr>
            <tr>
                <th>Child</th>
                <td>
                @if ($item->child->count() >0)
                    @foreach ($item->child as $child)
                        <li>
                            <a href="{{ URL::to('menu/detail/' . $child->id_menu) }}" title="">{{ $child->name_menu . ' - ' . $child->url_menu }}</a>
                        @if ($child->child->count() >0)
<ul>

                            @foreach ($child->child as $grandChild)
<li>
                            <a href="{{ URL::to('menu/detail/' . $grandChild->id_menu) }}" title="">{{ $grandChild->name_menu . ' - ' . $grandChild->url_menu }}</a></li>
                            @endforeach
                            </ul>
                        @endif
                        </li>
                    @endforeach
                @else
                    Tidak ada
                @endif
                </td>
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