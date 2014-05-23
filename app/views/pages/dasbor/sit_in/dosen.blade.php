@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>

var app = angular.module('dasborSitInDosen', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http) {
    $http.get('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}').success(function(data) {
        $rootScope.items = data;
    });

}

app.controller('sitInController', function($scope, $http, $rootScope) {
    $scope.batalkanSitIn = function(id_sit_in) {
        $http.delete('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}', {params: {'id_sit_in': String(id_sit_in)}}).success(function(data) {
            alert("Pembatalan berhasil dilakukan.")
            update($rootScope, $http);
        });
    };
    $scope.setujuiSitIn = function(id_sit_in) {
        if(confirm("Apakah Anda yakin untuk menyetujui Sitin yang dipilih?")) {
            sitIn = {}
            sitIn.id_sit_in = String(id_sit_in);
            $http.put('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}', sitIn).success(function(data) {
                alert("Penyetujuan berhasil.");
                update($rootScope, $http);
            });
        }
    }
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborSitInDosen">
    <div ng-controller="sitInController">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Sit In</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Daftar Sit In Saat Ini</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: '1'}: true">
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                        </tr>
                    </tbody>
                </table>

                <h2>Daftar Permintaan Sit In</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                            <th class="col-md-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: '0'}: true">
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <button ng-click="setujuiSitIn([[item.id_sit_in]])" class="btn btn-warning">Setujui</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2>Daftar Pembatalan Sit In</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                            <th class="col-md-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: '-1'}: true">
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <button ng-click="batalkanSitIn([[item.id_sit_in]])" class="btn btn-warning">Terima Pembatalan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
