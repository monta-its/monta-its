@extends('layouts.default')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3><strong>{{ $item->nama_bidang_keahlian }}</strong></h3>
        <p>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Laboratorium: </span>
            @foreach ($item->bidangMinat as $i => $bidangMinat) 
                <a href="{{ URL::to('prodi/'. $bidangMinat->id_bidang_minat) }}">
                    {{ $bidangMinat->nama_bidang_minat }}
                </a>
                @if ($i != $item->bidangMinat->count() - 1)
                    ,
                @endif
            @endforeach
        </p>
        <div class="item-main">
            <div class="row">
                <div class="col-md-12">
                    {{ $item->deskripsi_bidang_keahlian }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center col-md-4 col-sm-5 col-xs-5">Topik</th>
                            <th class="text-center">Nama Mahasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($item->topik as $topik)
                        <tr>
                            <td>
                                <a href="{{ URL::to('topik/' . $topik->id_topik) }}">{{ $topik->topik }}</a>
                            </td>
                            <td>
                            @foreach ($topik->tugasAkhir as $i => $tugasAkhir)
                                <a href="{{ URL::to('mahasiswa/' . $tugasAkhir->nrp_mahasiswa) }}">
                                    {{ $tugasAkhir->mahasiswa->nama_lengkap }}
                                </a>
                                @if ($i < $topik->tugasAkhir->count() - 1)
                                <span> · </span>
                                @endif
                            @endforeach
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