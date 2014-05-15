@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><a href="{{ URL::to('prodi/'. $item['id_prodi']) }}">{{ $item['nama_prodi'] }} ({{ $item['singkatan_prodi'] }})</a></h3>
        <p></p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item['deskripsi_prodi'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center col-md-4 col-sm-5 col-xs-5">Nama Dosen</th>
                                <th class="text-center">Bidang Ahli</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($item['dosen_prodi'] as $dosen)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('dosen/' . $dosen['id_dosen']) }}">{{ $dosen['nama_dosen'] }}</a>
                                </td>
                                <td>

                                @for ($i = 0; $i < count($dosen['bidang_keahlian']); $i++)
                                    <a href="{{ URL::to('bidang_keahlian/' . $dosen['bidang_keahlian'][$i]['id_bidang_keahlian']) }}">
                                        {{ $dosen['bidang_keahlian'][$i]['nama_bidang_keahlian'] }}
                                    </a>
                                    @if ($i < count($dosen['bidang_keahlian']) - 1)
                                    <span> · </span>
                                    @endif
                                @endfor
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>
</div>

@stop