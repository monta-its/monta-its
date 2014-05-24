@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborTopik', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateTopik($rootScope, $http);
});

var updateTopik = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/dosen/topik')}}').success(function(data) {
        $rootScope.items = data;
        // Ambil data bidang minat tersedia
        // TODO: Sesuaikan dengan bidang Keahlian
        $http.get('{{URL::to('/dasbor/dosen/bidang_keahlian')}}').success(function(data) {
            $rootScope.bidang_keahlian_item = data;
            if (callback) callback();
        });
    });

};


app.controller('daftarTopikController', function($scope, $http, $rootScope, $routeParams) {
    if($routeParams) {
        $scope.searchText = $routeParams.searchText;
    }
    $scope.hapusTopik = function(id_topik) {
        $http.delete('{{URL::to('/dasbor/dosen/topik')}}', {'params': {'id_topik': String(id_topik)}}).success(function(data) {
            updateTopik($rootScope, $http);
            alert('Topik dihapus');
        });
    };
});

app.controller('topikSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.topik = {};
        $scope.topik.topik = "";
        $scope.topik.deskripsi = "";
        $scope.tambahTopik = function() {
            $http.post('{{{URL::to('/dasbor/dosen/topik')}}}', $scope.topik).success(function(data) {
                updateTopik($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.topik = {};
            $scope.topik.id_topik = $routeParams.id;
            $scope.suntingTopik = function() {
                $http.put('{{URL::to('/dasbor/dosen/topik')}}', $scope.topik).success(function (data) {
                    updateTopik($rootScope, $http);
                    $location.path('/');
                });
            };
            updateTopik($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_topik === $scope.topik.id_topik) {
                        $scope.topik.topik = val.topik;
                        $scope.topik.deskripsi = val.deskripsi;
                        $.each($rootScope.bidang_keahlian_item, function(j, val2) {
                            if(val2.id_bidang_keahlian == val.id_bidang_keahlian) {
                                $scope.topik.bidangMinat = val2;
                            }
                        });
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
    .when('/', { templateUrl: 'daftarTopik.html'})
    .when('/prodi/:searchText', { templateUrl: 'daftarTopik.html'})
    .when('/:method', { templateUrl: 'topikSunting.html'})
    .when('/:method/:id', { templateUrl: 'topikSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Topik</h1>
    </div>
</div>
<div ng-app="dasborTopik">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="topikSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="topikSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="topik.topik" type="text" class="form-control input-lg" placeholder="Nama Topik">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="topik.deskripsi" class="form-control" rows="10" placeholder="Deskripsi Topik"></textarea>
                    </div>
                    <select ng-model="topik.bidangKeahlian" ng-options="item.nama_bidang_keahlian for item in bidang_keahlian_item"></select>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi"  class="btn btn-success" ng-click="tambahTopik()">Tambahkan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" class="btn btn-success" ng-click="suntingTopik()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarTopik.html">
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
        <div class="row" ng-controller="daftarTopikController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Topik</th>
                            <th>Deskripsi</th>
                            <th>Bidang Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.topik]]</td>
                            <td>[[item.deskripsi]]</td>
                            <td>[[item.bidang_keahlian.nama_bidang_keahlian]]</td>
                            <td>
                                <a href="#/sunting/[[item.id_topik]]">Sunting</a>
                                <a href="#/" ng-click="hapusTopik([[item.id_topik]])">Hapus</a>
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
