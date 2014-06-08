@extends('layouts.dasbor')
@section('page_title')
Sit In
@stop

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
        if(confirm("Apakah Anda yakin untuk membatalkan Sit In?")) {
            $http.delete('{{URL::to('/dasbor/mahasiswa/sit_in')}}', {'params': {'id_sit_in': String(id_sit_in)}}).success(function(data) {
                alert(data.pesan);
                update($rootScope, $http);
            });
        }

    };

    $scope.buatDataTugasAkhir = function(id_sit_in) {
        if(confirm('Konfirmasikan pemrosesan TA dari Sitin?')) {
            $http.post('{{URL::to('/dasbor/mahasiswa/proses_ta')}}', {id_sit_in: String(id_sit_in)}).success(function(data) {
                alert(data.pesan);
                update($rootScope, $http);
            });
        }
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Daftar Sit In
                    </div>
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Dosen</th>
                                <th class="col-md-2 text-center">NIP</th>
                                <th class="col-md-3 text-center">Waktu Sit In</th>
                                <th class="col-md-1 text-center">Status</th>
                                <th class="col-md-1 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in items">
                                <td>[[item.dosen.pegawai.nama_lengkap]]</td>
                                <td class="text-center">[[item.dosen.nip_dosen]]</td>
                                <td class="text-center">[[item.updated_at]]</td>
                                <td ng-show="item.status == -1">Dibatalkan (menunggu)</td>
                                <td ng-show="item.status == 0">Diajukan</td>
                                <td ng-show="item.status == 1">Disetujui</td>
                                <td ng-show="item.status == 2">Bimbingan</td>
                                <td ng-show="item.status != -1" class="text-center">
                                    <a class="btn btn-xs btn-warning" ng-show="item.status==0" ng-click="batalkanSitIn([[item.id_sit_in]])">Batalkan</a>
                                    <a class="btn btn-xs btn-success" ng-show="item.status==1" ng-click="buatDataTugasAkhir([[item.id_sit_in]])">Proses Bimbingan</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2>Pilih Dosen</h2>
                <ul class="list-unstyled">
                    <div class="panel panel-default" ng-repeat="item in prodi_items">
                        <div class="panel-heading">
                            Laboratorium: [[item.nama_bidang_minat]]
                        </div>
                        <table class="table table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Dosen</th>
                                    <th class="text-center col-md-2">NIP</th>
                                    <th class="text-center">Bidang Ahli</th>
                                    <th class="text-center">Kuota</th>
                                    <th class="text-center col-md-1">Sit In</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="dosen in item.dosen">
                                    <td>[[dosen.pegawai.nama_lengkap]]</td>
                                    <td class="text-center">[[dosen.nip_dosen]]</td>
                                    <td>
                                        <a ng-repeat="bk in dosen.bidang_keahlian" href="{{{URL::to('/bidang_keahlian/')}}}/[[bk.id_bidang_keahlian]]">[[bk.nama_bidang_keahlian]]</a>
                                    </td>
                                    <td class="text-center">[[dosen.kuota_sit_in]]</td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-success" ng-click="pilihSitIn([[dosen.nip_dosen]])">Pilih</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
