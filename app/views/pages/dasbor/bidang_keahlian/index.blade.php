@extends('layouts.dasbor')
@section('page_title')
Kelola Bidang Keahlian
@stop

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborBidangKeahlian', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateBidangKeahlian($rootScope, $http);
});

var updateBidangKeahlian = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/dosen/bidang_keahlian')}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};


app.controller('daftarBidangKeahlianController', function($scope, $http, $rootScope) {
    $scope.hapusBidangKeahlian = function(id_bidang_keahlian) {
        if(confirm("Yakin untuk menghapus ini?")) {
        $http.delete('{{URL::to('/dasbor/dosen/bidang_keahlian')}}', {'params': {'id_bidang_keahlian': String(id_bidang_keahlian)}}).success(function(data) {
            updateBidangKeahlian($rootScope, $http);
            alert('Bidang Keahlian dihapus');
        }); }
    };
    $scope.publish = function(id_pos, action) {
        var bidangKeahlian = {};

        $.each($rootScope.items, function(i, val) {
            if(val.id_bidang_keahlian == id_bidang_keahlian) {
                bidangKeahlian = val;
            }
        });

        bidangKeahlian.apakah_terbit = action;

        $http.put('{{{URL::to('/dasbor/dosen/bidang_keahlian')}}}', bidangKeahlian).success(function(data) {
            updateBidangKeahlian($rootScope, $http)
            $location.path('/');
        })
    };
});

app.controller('bidangKeahlianSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.bidangKeahlian = {};
        $scope.bidangKeahlian.nama_bidang_keahlian = "";
        $scope.bidangKeahlian.deskripsi_bidang_keahlian = "";
        $scope.simpanBidangKeahlian = function() {
            $http.post('{{{URL::to('/dasbor/dosen/bidang_keahlian')}}}', $scope.bidangKeahlian).success(function(data) {
                updateBidangKeahlian($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.bidangKeahlian = {};
            $scope.bidangKeahlian.id_bidang_keahlian = $routeParams.id;
            $scope.suntingBidangKeahlian = function() {
                $http.put('{{URL::to('/dasbor/dosen/bidang_keahlian')}}', $scope.bidangKeahlian).success(function (data) {
                    updateBidangKeahlian($rootScope, $http);
                    $location.path('/');
                });
            };
            updateBidangKeahlian($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_bidang_keahlian === $scope.bidangKeahlian.id_bidang_keahlian) {
                        $scope.bidangKeahlian.nama_bidang_keahlian = val.nama_bidang_keahlian;
                        $scope.bidangKeahlian.deskripsi_bidang_keahlian = val.deskripsi_bidang_keahlian;
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
    .when('/', { templateUrl: 'daftarBidangKeahlian.html'})
    .when('/:method', { templateUrl: 'bidangKeahlianSunting.html'})
    .when('/:method/:id', { templateUrl: 'bidangKeahlianSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborBidangKeahlian">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="bidangKeahlianSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="bidangKeahlianSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="bidangKeahlian.nama_bidang_keahlian" type="text" class="form-control input-lg" id="judulbidangKeahlian" name="judulbidangKeahlian" placeholder="Nama Bidang Keahlian">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="bidangKeahlian.deskripsi_bidang_keahlian" class="form-control" rows="10" name="isibidangKeahlian" id="isibidangKeahlian" placeholder="Deskripsi Bidang Keahlian"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Simpan" class="btn btn-success" ng-click="simpanBidangKeahlian()">Simpan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="suntingBidangKeahlian()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarBidangKeahlian.html">
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
        <div class="row" ng-controller="daftarBidangKeahlianController">
            <div class="col-md-12">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.nama_bidang_keahlian]]</td>
                            <td>[[item.deskripsi_bidang_keahlian]]</td>
                            <td>
                                <a href="#/sunting/[[item.id_bidang_keahlian]]">Sunting</a>
                                <a href="#/" ng-click="hapusBidangKeahlian([[item.id_bidang_keahlian]])">Hapus</a>
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
