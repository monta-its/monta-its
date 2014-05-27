@extends('layouts.dasbor')

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script>
var app = angular.module('dasborSyarat', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('syaratController', function($http, $scope) {
    $scope.syaratTerpilih = {}

    // Ambil data syarat mentah
    $http.get('{{{URL::to('/dasbor/pegawai/syarat')}}}').success(function(data) {
        $scope.dataSyarat = data;
    });

    $scope.cariMahasiswa = function() {
        $http.get('{{{URL::to('/dasbor/pegawai/syarat/')}}}' + '/' + $scope.nrpMahasiswa).success(function(data) {
            $scope.dataMahasiswa = data;
            $.each($scope.dataMahasiswa.syarat, function(i, val) {
                $scope.syaratTerpilih[val.id_syarat] = true;
            });
        });
    };

    $scope.simpanSyarat = function() {
        if(confirm('Yakin lakukan perubahan data?')) {
            $.each($scope.syaratTerpilih, function(i, val) {
                if(val == true) {
                    $http.post('{{{URL::to('/dasbor/pegawai/syarat/')}}}' + '/' + $scope.nrpMahasiswa, {'id_syarat': i});
                } else {
                    $http.delete('{{{URL::to('/dasbor/pegawai/syarat/')}}}' + '/' + $scope.nrpMahasiswa, {'params': {'id_syarat': i}});
                }
            });
        }
    };
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Syarat</h1>
    </div>
</div>

<div ng-app="dasborSyarat">
    <div ng-controller="syaratController">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" ng-model="nrpMahasiswa" class="form-control" placeholder="NRP Mahasiswa"/>
                </div>
                <button class="btn btn-default" ng-click="cariMahasiswa()">Cari</button>
            </div>
        </div>


        <div class="row" ng-show="dataMahasiswa">
            <div class="col-md-12">
                <h2>[[dataMahasiswa.nama_lengkap]] ([[dataMahasiswa.nrp_mahasiswa]])</h2>
                <h3>Syarat Sit In</h3>
                <div class="checkbox">
                    <div ng-repeat="syarat in dataSyarat | filter: {'waktu_syarat': 'pra_sit_in'}">
                        <label>
                            [[syarat.nama_syarat]]
                            <input type="checkbox" ng-model="syaratTerpilih[syarat.id_syarat]" />
                        </label>
                    </div>
                </div>
                <h3>Syarat Bimbingan</h3>
                <div class="checkbox">
                    <div ng-repeat="syarat in dataSyarat | filter: {'waktu_syarat': 'pra_bimbingan'}">
                        <label>
                            [[syarat.nama_syarat]]
                            <input type="checkbox" ng-model="syaratTerpilih[syarat.id_syarat]" />
                        </label>
                    </div>
                </div>
                <h3>Syarat Sidang Proposal</h3>
                <div class="checkbox">
                    <div ng-repeat="syarat in dataSyarat | filter: {'waktu_syarat': 'pra_sidang_proposal'}">
                        <label>
                            [[syarat.nama_syarat]]
                            <input type="checkbox" ng-model="syaratTerpilih[syarat.id_syarat]" />
                        </label>
                    </div>
                </div>
                <h3>Syarat Sidang Akhir</h3>
                <div class="checkbox">
                    <div ng-repeat="syarat in dataSyarat | filter: {'waktu_syarat': 'pra_sidang_akhir'}">
                        <label>
                            [[syarat.nama_syarat]]
                            <input type="checkbox" ng-model="syaratTerpilih[syarat.id_syarat]" />
                        </label>
                    </div>
                </div>
                <button ng-click="simpanSyarat()" class="btn">Simpan Syarat</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
