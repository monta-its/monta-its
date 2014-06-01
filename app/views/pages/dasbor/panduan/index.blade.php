@extends('layouts.dasbor')
@section('page_title')
Kelola Panduan
@stop

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular-file-upload-shim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-file-upload.min.js')}}"></script>
<script>
var app = angular.module('dasborPanduan', ['ngRoute', 'angularFileUpload'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updatePanduan($rootScope, $http);
});

var updatePanduan = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/dosen/panduan')}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};


app.controller('daftarPanduanController', function($scope, $http, $rootScope) {
    $scope.hapusPanduan = function(id_panduan) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/dosen/panduan')}}', {'params': {'id_panduan': String(id_panduan)}}).success(function(data) {
                updatePanduan($rootScope, $http);
                alert('Panduan dihapus');
            });
        }
    };
});

app.controller('panduanSuntingController', function($rootScope, $scope, $http, $routeParams, $location, $upload){
    var method = $routeParams.method;
    $scope.method = method;
    $scope.pilihBerkas = function($files) {
        $scope.panduan.lampiran.berkas_lampiran = $files[0];
    };
    if(method == "baru") {
        $scope.panduan = {};
        $scope.panduan.judul_panduan = "";
        $scope.panduan.isi_panduan = "";
        $scope.panduan.lampiran = {};
        $scope.panduan.lampiran.nama_lampiran = "";
        $scope.panduan.lampiran.tipe_lampiran = "file";
        $scope.panduan.lampiran.path_lampiran = "";
        $scope.terbitkanPanduan = function() {
            if($scope.panduan.lampiran.tipe_lampiran == 'url' || !$scope.panduan.lampiran.berkas_lampiran) {
                $http.post('{{URL::to('/dasbor/dosen/panduan')}}', $scope.panduan).success(function (data) {
                    updatePanduan($rootScope, $http);
                    $location.path('/');
                });
            } else if ($scope.panduan.lampiran.tipe_lampiran == 'file') {
                $upload.upload({
                    url: '{{URL::to('/dasbor/dosen/panduan')}}',
                    method: 'POST',
                    data: $scope.panduan,
                    file: $scope.panduan.lampiran.berkas_lampiran

                }).success(function(data, status, headers, config) {
                    alert('Pengunggahan berkas berhasil');
                    updatePanduan($rootScope, $http);
                    $location.path('/');
                }).error(function() {
                    alert('Pengunggahan berkas gagal')
                    updatePanduan($rootScope, $http);
                    $location.path('/');
                });
            }
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.panduan = {};
            $scope.panduan.id_panduan = $routeParams.id;
            $scope.suntingPanduan = function() {
                if($scope.panduan.lampiran.tipe_lampiran == 'url' || !$scope.panduan.lampiran.berkas_lampiran) {
                    $http.put('{{URL::to('/dasbor/dosen/panduan')}}', $scope.panduan).success(function (data) {
                        updatePanduan($rootScope, $http);
                        $location.path('/');
                    });
                } else if ($scope.panduan.lampiran.tipe_lampiran == 'file') {
                    $scope.panduan._permit_to_edit = true;
                    $upload.upload({
                        url: '{{URL::to('/dasbor/dosen/panduan')}}',
                        method: 'POST',
                        data: $scope.panduan,
                        file: $scope.panduan.lampiran.berkas_lampiran

                    }).success(function(data, status, headers, config) {
                        alert('Pengunggahan berkas berhasil');
                        updatePanduan($rootScope, $http);
                        $location.path('/');
                    }).error(function() {
                        alert('Pengunggahan berkas gagal')
                        updatePanduan($rootScope, $http);
                        $location.path('/');
                    });
                }
            };
            updatePanduan($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_panduan === $scope.panduan.id_panduan) {
                        $scope.panduan.judul_panduan = val.judul_panduan;
                        $scope.panduan.isi_panduan = val.isi_panduan;
                        $scope.panduan.lampiran = val.lampiran;
                    }
                });
            });
        } else {
            location.path('/');
        }
    } else {
        $location.path('/');
    }

});

app.config(function($routeProvider) {
    $routeProvider
    .when('/', { templateUrl: 'daftarPanduan.html'})
    .when('/:method', { templateUrl: 'panduanSunting.html'})
    .when('/:method/:id', { templateUrl: 'panduanSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborPanduan">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="panduanSunting.html">

        <div class="row">
        </div>
        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="panduanSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="panduan.judul_panduan" type="text" class="form-control input-lg" id="judul_panduanPanduan" name="judul_panduanPanduan" placeholder="Judul Panduan">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="panduan.isi_panduan" class="form-control" rows="10" name="isiPanduan" id="isiPanduan" placeholder="Isi Panduan"></textarea>
                    </div>
                    <h3>Lampiran</h3>
                    <div class="form-group">
                        <input ng-model="panduan.lampiran.nama_lampiran" type="text" class="form-control input-lg"  placeholder="Nama Lampiran">
                    </div>
                    <div class="form-group">
                        <input type="radio" ng-model="panduan.lampiran.tipe_lampiran" value="url"/> Lampiran pranala URL<br/>
                        <input type="radio" ng-model="panduan.lampiran.tipe_lampiran" value="file"/> Lampiran berkas unggah<br/>

                    </div>
                    <div class="form-group">
                        <input ng-show="panduan.lampiran.tipe_lampiran=='url'" placeholder="Masukkan URL/pranala menuju lampiran (dari Dropbox/Google Drive)" ng-model="panduan.lampiran.path_lampiran" class="form-control"/>
                        <a ng-show="panduan.lampiran.path_lampiran && panduan.lampiran.tipe_lampiran=='file'" href="{{URL::to('/files/')}}/[[panduan.pegawai.nip_pegawai]]/[[panduan.lampiran.path_lampiran]]">Pranala berkas sebelumnya</a>
                        <input type="file" ng-file-select="pilihBerkas($files)" ng-show="panduan.lampiran.tipe_lampiran=='file'"  class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Terbitkan" class="btn btn-success" ng-click="terbitkanPanduan()">Terbitkan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="suntingPanduan()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarPanduan.html">
        <div class="row" >
            <div class="col-md-6">
                <a href="#/baru" class="btn btn-default">Buat Baru</a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input ng-model="searchText" type="text" class="form-control input-xs"  placeholder="Pencarian">
                </div>
            </div>
        <div class="row" ng-controller="daftarPanduanController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>judul_panduan</th>
                            <th>Penulis</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.id_panduan]]</td>
                            <td>[[item.judul_panduan]]</td>
                            <td>[[item.pegawai.nama_lengkap]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a href="#/sunting/[[item.id_panduan]]">Sunting</a>
                                <a href="#/" ng-click="hapusPanduan([[item.id_panduan]])">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </script>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
