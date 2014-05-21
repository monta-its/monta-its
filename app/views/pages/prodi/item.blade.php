@extends('layouts.default')
@section('content')

<!-- // TODO: Bro, istilah Bidang Ahli disini diubah ke Bidang Keahlian setiap dosen, baca segala TODO yang ada di routes.php lagi :( -->
<div class="panel panel-default">
  <div class="panel-body">
    <h3>{{ $item->nama_bidang_minat }} ({{ $item->kode_bidang_minat }})</h3>
    <p></p>
    <div class="item-main">
        <div class="row">
            <div class="col-md-12">
                {{ $item->deskripsi_bidang_minat }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center col-md-4 col-sm-5 col-xs-5">Nama Dosen</th>
                            <th class="text-center">Bidang Keahlian</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($item->dosen as $dosen)
                        <tr>
                            <td>
                                <a href="{{ URL::to('dosen/' . $dosen->nip_dosen) }}">{{ $dosen->pegawai->nama_lengkap }}</a>
                            </td>
                            <td>

                            @for ($i = 0; $i < count($dosen); $i++)
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
