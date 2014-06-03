@extends('layouts.dasbor')
@section('page_title')
Jadwal Dosen Penguji
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <p>Jadwal ketersediaan Bapak/Ibu sebagai dosen penguji seminar/sidang.</p>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Hari</th>
                    <th class="text-center">Sesi I (08.00 - 12.00)</th>
                    <th class="text-center">Sesi II (13.00 - 17.00)</th>
                    <th class="text-center">Sesi III (18.30 - 22.30)</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Senin</td>
                    <td class="text-center"><span class="label label-success">tersedia</span></td>
                    <td class="text-center"><span class="label label-danger">tidak tersedia</span></td>
                    <td class="text-center"><span class="label label-default">belum ditentukan</span></td>
                    <td><a href="{{ URL::to('/dasbor/dosen/jadwal/sunting') }}" class="btn btn-primary btn-xs">Sunting</a></td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td class="text-center"><span class="label label-success">tersedia</span></td>
                    <td class="text-center"><span class="label label-danger">tidak tersedia</span></td>
                    <td class="text-center"><span class="label label-default">belum ditentukan</span></td>
                    <td><a href="{{ URL::to('/dasbor/dosen/jadwal/sunting') }}" class="btn btn-primary btn-xs">Sunting</a></td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td class="text-center"><span class="label label-success">tersedia</span></td>
                    <td class="text-center"><span class="label label-danger">tidak tersedia</span></td>
                    <td class="text-center"><span class="label label-default">belum ditentukan</span></td>
                    <td><a href="{{ URL::to('/dasbor/dosen/jadwal/sunting') }}" class="btn btn-primary btn-xs">Sunting</a></td>
                </tr>
                <tr>
                    <td>Kamis</td>
                    <td class="text-center"><span class="label label-success">tersedia</span></td>
                    <td class="text-center"><span class="label label-danger">tidak tersedia</span></td>
                    <td class="text-center"><span class="label label-default">belum ditentukan</span></td>
                    <td><a href="{{ URL::to('/dasbor/dosen/jadwal/sunting') }}" class="btn btn-primary btn-xs">Sunting</a></td>
                </tr>
                <tr>
                    <td>Jumat</td>
                    <td class="text-center"><span class="label label-success">tersedia</span></td>
                    <td class="text-center"><span class="label label-danger">tidak tersedia</span></td>
                    <td class="text-center"><span class="label label-default">belum ditentukan</span></td>
                    <td><a href="{{ URL::to('/dasbor/dosen/jadwal/sunting') }}" class="btn btn-primary btn-xs">Sunting</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop
