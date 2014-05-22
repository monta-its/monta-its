@extends('layouts.dasbor')

@section('content')


<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>

var app = angular.module('dasborSitInMahasiswa', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http) {
    $http.get('{{URL::to('/dasbor/mahasiswa/sit_in')}}').success(function(data) {
        $rootScope.items = data;
    });

    // Ambil data Prodi
    $http.get('{{URL::to('/dasbor/umum/dosen/prodi?dosen')}}').success(function(data) {
        $rootScope.prodi_items = data;
    });

}

app.controller('sitInController', function($scope, $http, $rootScope) {
    $scope.batalkanSitIn = function(id_sit_in) {
        $http.delete('{{URL::to('/dasbor/mahasiswa/sit_in')}}', {'params': {'id_sit_in': String(id_sit_in)}}).success(function(data) {
            alert("Pengajuan pembatalan Sitin sudah dinotifikasikan ke Dosen bersangkutan. Sitin baru akan dihapus setelah dosen bersangkutan menyetujuinya.");
            update($rootScope, $http);
        });
    };

    $scope.pilihSitIn = function(nip_dosen) {
        var sitIn = {};
        sitIn.dosen = {};
        sitIn.dosen.nip_dosen = String(nip_dosen);

        if(confirm("Apakah Anda setuju untuk melakukan Sitin Tugas Akhir dengan dosen yang dipilih?")) {
            $http.post('{{URL::to('/dasbor/mahasiswa/sit_in')}}', sitIn).success(function(data) {
                update($rootScope, $http);
                if(data.galat) {
                    alert("GALAT: " + data.galat);
                } else {
                    alert("Sitin sudah diproses, konfirmasi sudah dikirimkan ke dosen.")
                }
            });
        } else {
            alert("Sitin dibatalkan.");

        }
    }
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborSitInMahasiswa">
    <div ng-controller="sitInController">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Sit In</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Daftar Sit In</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Dosen</th>
                            <th class="col-md-2 text-center">NIP</th>
                            <th class="col-md-3 text-center">Waktu Sit In</th>
                            <th class="col-md-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items">
                            <td>[[item.dosen.pegawai.nama_lengkap]]</td>
                            <td>[[item.dosen.nip_dosen]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <button class="btn btn-warning" ng-click="batalkanSitIn([[item.id_sit_in]])">Batalkan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2>Pilih Dosen</h2>
                <ul class="list-unstyled">
                    <li ng-repeat="item in prodi_items">
                        <h3>[[prodi.nama_bidang_minat]]</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Dosen</th>
                                    <th class="text-center col-md-2">NIP</th>
                                    <th class="text-center">Bidang Ahli</th>
                                    <th class="text-center col-md-1">Sit In</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="dosen in item.dosen">
                                    <td>[[dosen.pegawai.nama_lengkap]]</td>
                                    <td>[[dosen.nip_dosen]]</td>
                                    <td>
                                        <a ng-repeat="bk in dosen.bidang_keahlian" href="{{{URL::to('/bidang_keahlian/')}}}/[[bk.id_bidang_keahlian]]">[[bk.nama_bidang_keahlian]]</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-default" ng-click="pilihSitIn([[dosen.nip_dosen]])">Pilih</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop