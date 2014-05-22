@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborJudul', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateJudul($rootScope, $http);
});

var updateJudul = function($rootScope, $http) {
    $http.get('{{URL::to('/dasbor/dosen/judul')}}').success(function(data) {
        $rootScope.items = data;
    });

    $http.get('{{URL::to('/dasbor/dosen/topik')}}').success(function(data) {
        $rootScope.topik_items = data;
    });
};


app.controller('daftarJudulController', function($scope, $http, $rootScope, $routeParams) {
    if($routeParams) {
        $scope.searchText = $routeParams.searchText;
    }
    $scope.hapusJudul = function(id_judul) {
        $http.delete('{{URL::to('/dasbor/dosen/judul')}}', {'params': {'id_judul': String(id_penawaran_judul)}}).success(function(data) {
            updateJudul($rootScope, $http);
            alert('Judul dihapus');
        });
    };
});

app.controller('judulSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.judul = {};
        $scope.judul.judul_tugas_akhir = "";
        $scope.judul.deskripsi = "";
        $scope.judul.topik = {};
        $scope.tambahJudul = function() {
            $http.post('{{{URL::to('/dasbor/dosen/judul')}}}', $scope.judul).success(function(data) {
                updateJudul($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.judul = {};
            $scope.judul.id_penawaran_judul = $routeParams.id;
            $scope.suntingJudul = function() {
                $http.put('{{URL::to('/dasbor/dosen/judul')}}', $scope.judul).success(function (data) {
                    updateJudul($rootScope, $http);
                    $location.path('/');
                });
            };
            $.each($rootScope.items, function(i, val) {
                if(val.id_penawaran_judul === $scope.judul.id_penawaran_judul) {
                    $scope.judul.judul_tugas_akhir = val.judul_tugas_akhir;
                    $scope.judul.deskripsi = val.deskripsi;
                    $.each($rootScope.topik_items, function(j, val2) {
                        if(val2.id_topik == val.id_topik) {
                            $scope.judul.topik = val2;
                        }
                    });
                }
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
    .when('/', { templateUrl: 'daftarJudul.html'})
    .when('/topik/:searchText', { templateUrl: 'daftarJudul.html'})
    .when('/:method', { templateUrl: 'judulSunting.html'})
    .when('/:method/:id', { templateUrl: 'judulSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Judul</h1>
    </div>
</div>
<div ng-app="dasborJudul">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="judulSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="judulSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="judul.judul_tugas_akhir" type="text" class="form-control input-lg" placeholder="Nama Judul">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="judul.deskripsi" class="form-control" rows="10" placeholder="Deskripsi Judul"></textarea>
                    </div>
                    <select ng-model="judul.topik" ng-options="item.topik for item in topik_items"></select>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi"  class="btn btn-success" ng-click="tambahJudul()">Tambahkan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" class="btn btn-success" ng-click="suntingJudul()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarJudul.html">
        <div class="row" >
            <div class="col-md-6">
                <a href="#/baru" class="btn btn-default">Buat Baru</a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input ng-model="searchText" type="text" class="form-control input-xs"  placeholder="Pencarian">
                </div>
            </div>
        </div>
        <div class="row" ng-controller="daftarJudulController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.judul_tugas_akhir]]</td>
                            <td>[[item.deskripsi]]</td>
                            <td>[[item.topik.topik]]</td>
                            <td>[[item.tugasAkhir ? "Diambil": "Belum Diambil"]]</td>
                            <td>
                                <a href="#/sunting/[[item.id_penawaran_judul]]">Sunting</a>
                                <a href="#/" ng-click="hapusJudul([[item.id_penawaran_judul]])">Hapus</a>
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
