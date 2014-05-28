@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborSidang', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/mahasiswa/sidang')}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};


app.controller('daftarSidangController', function($scope, $http, $rootScope) {
    $scope.hapusBerita = function(id_sidang) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/mahasiswa/sidang')}}', {'params': {'id_sidang': String(id_sidang)}}).success(function(data) {
                updateBerita($rootScope, $http);
                alert('Sidang dihapus');
            });
        }
    };
});

app.controller('sidangSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.berita = {};
        $scope.berita.judul = "";
        $scope.berita.isi = "";
        $scope.berita.apakah_terbit = true;
        $scope.terbitkanBerita = function() {
            $http.post('{{{URL::to('/dasbor/dosen/berita')}}}', $scope.berita).success(function(data) {
                updateBerita($rootScope, $http)
                $location.path('/');
            })
        };
        $scope.simpanBerita = function() {
            $scope.berita.apakah_terbit = false;
            $http.post('{{{URL::to('/dasbor/dosen/berita')}}}', $scope.berita).success(function(data) {
                updateBerita($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.berita = {};
            $scope.berita.id_pos = $routeParams.id;
            $scope.suntingBerita = function() {
                $http.put('{{URL::to('/dasbor/dosen/berita')}}', $scope.berita).success(function (data) {
                    updateBerita($rootScope, $http);
                    $location.path('/');
                });
            };
            updateBerita($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_pos === $scope.berita.id_pos) {
                        $scope.berita.judul = val.judul;
                        $scope.berita.isi = val.isi;
                        $scope.berita.apakah_terbit = val.apakah_terbit;
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
    .when('/', { templateUrl: 'daftarSidang.html'})
    .when('/:method', { templateUrl: 'sidangSunting.html'})
    .when('/:method/:id', { templateUrl: 'sidangSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Sidang</h1>
    </div>
</div>
<div class="row" ng-app="dasborSidang">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="daftarSidang.html">
        <div ng-controller="daftarSidangController">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ URL::to('dasbor/sidang/baru' )}}" class="btn btn-default">Buat Baru</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Jenis Sidang</th>
                                <th>Judul TA</th>
                                <th>Mahasiswa</th>
                                <th>Dosen Penguji</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in items">
                                <td>[[item.jenis_sidang]]</td>
                                <td>[[item.tugas_akhir.penawaran_judul.judul_tugas_akhir]]</td>
                                <td>[[item.tugas_akhir.mahasiswa.nama_lengkap]] ([[item.tugas_akhir.mahasiswa.nrp_mahasiswa]])</td>
                                <td>
                                    <span ng-repeat="penguji in item.penguji_sidang">
                                        [[penguji.pegawai.nama_lengkap]] </br>
                                    </span>
                                </td>
                                <td>[[item.waktu_mulai]]</td>
                                <td>[[item.waktu_selesai]]</td>
                                <td>
                                    <a href="#/">Sunting</a>
                                    <a href="#/">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
