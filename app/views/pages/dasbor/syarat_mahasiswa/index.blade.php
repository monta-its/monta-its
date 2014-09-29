@extends('layouts.dasbor')
@section('page_title')
Kelola Syarat Mahasiswa
@stop

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.tpl.min.js')}}"></script>
<script>
var app = angular.module('dasborSyarat', ['mgcrea.ngStrap'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('syaratController', function($http, $scope) {
    $scope.syaratTerpilih = {}
    $scope.nrpMahasiswa = "";
    $scope.dataMahasiswa = [];

    // Ambil data mahasiswa
    $http.get('{{{URL::to('/dasbor/umum/mahasiswa')}}}').success(function(data){
        $scope.dataMahasiswa = data;
    });
    // Ambil data syarat mentah
    $http.get('{{{URL::to('/dasbor/pegawai/syarat')}}}').success(function(data) {
        $scope.dataSyarat = data;
    });

    $scope.cariMahasiswa = function() {
        $http.get('{{{URL::to('/dasbor/pegawai/syarat_mahasiswa/')}}}' + '/' + $scope.nrpMahasiswa).success(function(data) {
            if(!($.isEmptyObject(data))) {
                $scope.dataSyaratMahasiswa = data;
                $.each($scope.dataSyaratMahasiswa.syarat, function(i, val) {
                        $scope.syaratTerpilih[val.id_syarat] = true;
                });
            } else {
                alert('Mahasiswa tidak ditemukan.');
            }
        });
    };

    $scope.simpanSyarat = function() {
        if(confirm('Yakin lakukan perubahan data?')) {
            $scope.totalSyaratTerpilih = 0;
            $scope.countSyaratTerpilih = 0;
            for (syaratTerpilih in $scope.syaratTerpilih) {
                $scope.totalSyaratTerpilih++;
            }

            $.each($scope.syaratTerpilih, function(i, val) {
                if(val == true) {
                    $http.post('{{{URL::to('/dasbor/pegawai/syarat_mahasiswa/')}}}' + '/' + $scope.nrpMahasiswa, {'id_syarat': i}).success(function(data){
                        $scope.countSyaratTerpilih++;
                        if ($scope.countSyaratTerpilih == $scope.totalSyaratTerpilih) {
                            alert('Data berhasil disimpan.');
                        }
                    });
                } else {
                    $http.delete('{{{URL::to('/dasbor/pegawai/syarat_mahasiswa/')}}}' + '/' + $scope.nrpMahasiswa, {'params': {'id_syarat': i}}).success(function(data){
                        $scope.countSyaratTerpilih++;
                        if ($scope.countSyaratTerpilih == $scope.totalSyaratTerpilih) {
                            alert('Data berhasil disimpan.');
                        }
                    });
                }
            });
        }
    };
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborSyarat">
    <div ng-controller="syaratController">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" ng-options="mahasiswa.nrp as mahasiswa.nrp + ' - ' + mahasiswa.nama_lengkap for mahasiswa in dataMahasiswa" ng-model="nrpMahasiswa" class="form-control" placeholder="NRP Mahasiswa" bs-typeahead/>
                </div>
                <button class="btn btn-default" ng-click="cariMahasiswa()">Cari</button>
            </div>
        </div>


        <div class="row" ng-show="dataSyaratMahasiswa">
            <div class="col-md-12">
                <h2>[[dataSyaratMahasiswa.nama_lengkap]] ([[dataSyaratMahasiswa.nrp]])</h2>
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
                <h3>Syarat Seminar Proposal</h3>
                <div class="checkbox">
                    <div ng-repeat="syarat in dataSyarat | filter: {'waktu_syarat': 'pra_seminar_proposal'}">
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
