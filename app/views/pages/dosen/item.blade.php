@extends('layouts.custom-sidebar')
@section('page_title')
Profil {{ $item->nama_lengkap }}
@stop
@section('content')

<div class="panel panel-default">
  <div class="panel-body">
    <h3>Profil Dosen</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-condensed table-striped">
                <tbody>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><strong>Nama</strong></td>
                        <td>: </td>
                        <td>{{ $item->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIP</strong></td>
                        <td>: </td>
                        <td>{{ $item->nip }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bidang Ahli</strong></td>
                        <td>: </td>
                        <td>
                        @for ($i = 0; $i < count($item->bidangKeahlian); $i++)
                            <a href="{{ URL::to('bidang_keahlian/' . $item->bidangKeahlian[$i]->id_bidang_keahlian) }}">{{ $item->bidangKeahlian[$i]->nama_bidang_keahlian }}</a> 
                            @if ($i != count($item->bidangKeahlian) - 1)
                                ,
                            @endif
                        @endfor
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Laboratorium</strong></td>
                        <td>: </td>
                        <td>
                            <a href="{{ URL::to('bidang_minat/' . $item->id_bidang_minat) }}">{{ $item->bidangMinat->nama_bidang_keahlian }}</a> 
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Bimbingan</strong></td>
                        <td>: </td>
                        <td>
                        @if ($item->pembimbingTugasAkhir->count() != 0)
                            <p>{{$item->pembimbingTugasAkhir->count()}} mahasiswa</p>
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center col-md-2">NRP</th>
                                        <th class="text-center">Judul Tugas Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($item->pembimbingTugasAkhir as $key => $tugasAkhir)
                                    <tr>
                                        <td>
                                            <a href="{{URL::to('/mahasiswa/' . $tugasAkhir->nrp)}}" >{{$tugasAkhir->mahasiswa->nama_lengkap}}</a>
                                        </td>
                                        <td class="text-center">
                                            {{$tugasAkhir->nrp}}
                                        </td>
                                        <td>
                                        @if ($tugasAkhir->penawaranJudul != null)
                                            <a href="{{URL::to('/judul/' . $tugasAkhir->id_penawaran_judul)}}" >{{$tugasAkhir->penawaranJudul->judul_tugas_akhir}}</a>
                                        @else
                                            <span class="text-muted">Belum ditentukan</span>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            tidak ada
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sit In</strong></td>
                        <td>: </td>
                        <td>
                        @if ($item->sitIn->count() != 0)
                            <p>{{$item->sitIn->count()}} mahasiswa</p>
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center col-md-2">NRP</th>
                                        <th class="text-center col-md-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($item->sitIn as $key => $sitIn)
                                    <tr>
                                        <td>
                                            <a href="{{URL::to('/mahasiswa/' . $sitIn->nrp)}}" >{{$sitIn->mahasiswa->nama_lengkap}}</a>
                                        </td>
                                        <td class="text-center">
                                            {{$sitIn->nrp}}
                                        </td>
                                        <td>
                                        @if ($sitIn->status == 0)
                                            <span class="label label-default">Diajukan (menunggu)</span>
                                        @elseif ($sitIn->status == 1)
                                            <span class="label label-success">Disetujui</span>
                                        @elseif ($sitIn->status == -1)
                                            <span class="label label-danger">Dibatalkan (menunggu)</span>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            tidak ada
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Penawaran Judul</strong></td>
                        <td>: </td>
                        <td>
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Judul Tugas Akhir</th>
                                        <th class="text-center col-md-1 col-sm-2 col-xs-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($item->penawaranJudul as $i => $penawaranJudul)
                                    <tr>
                                        <td>
                                            <a href="{{ URL::to('judul/' . $penawaranJudul->id_penawaran_judul) }}">{{ $penawaranJudul->judul_tugas_akhir }}</a>
                                        </td>
                                        <td>
                                        @if ($penawaranJudul->tugasAkhir == null)
                                            <span class="label label-success">Tersedia</span>
                                        @else
                                            <span class="label label-default">Sudah Diambil</span>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

@stop

@section('sidebar')
<div class="panel panel-default">
  <div class="panel-body">
    <img src="{{ URL::to('assets/images/dosen-default-profile-picture.jpg') }}" style="width: 100%" />
  </div>
</div>
@stop