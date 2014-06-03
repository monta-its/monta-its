@extends('layouts.dasbor')
@section('page_title')
Kelola Sesi Sidang
@stop

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.tpl.min.js')}}"></script>
<script>
var app = angular.module('dasborSesiSidang', ['ngRoute','mgcrea.ngStrap'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/pegawai/sesi_sidang')}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};


app.controller('daftarSesiSidangController', function($scope, $http, $rootScope) {
    $scope.hapus = function(sesi) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/pegawai/sesi_sidang')}}', {'params': {'sesi': String(sesi)}}).success(function(data) {
                update($rootScope, $http);
                alert('Sesi Sidang dihapus');
            });
        }
    };
});

app.controller('sesiSidangSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.sesiSidang = {};
        $scope.sesiSidang.sesi = "";
        $scope.sesiSidang.waktu_mulai = "";
        $scope.sesiSidang.waktu_selesai = "";
        $scope.simpan = function() {
            $http.post('{{{URL::to('/dasbor/pegawai/sesi_sidang')}}}', $scope.sesiSidang).success(function(data) {
                update($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.sesiSidang = {};
            $scope.sesiSidang.sesi = $routeParams.id;
            $scope.sunting = function() {
                $http.put('{{URL::to('/dasbor/pegawai/sesi_sidang')}}', $scope.sesiSidang).success(function (data) {
                    update($rootScope, $http);
                    $location.path('/');
                });
            };
            update($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.sesi == $scope.sesiSidang.sesi) {
                        $scope.sesiSidang.waktu_mulai = val.waktu_mulai;
                        $scope.sesiSidang.waktu_selesai = val.waktu_selesai;
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
    .when('/', { templateUrl: 'daftarSesiSidang.html'})
    .when('/:method', { templateUrl: 'sesiSidangSunting.html'})
    .when('/:method/:id', { templateUrl: 'sesiSidangSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborSesiSidang">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="sesiSidangSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="sesiSidangSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama Sesi (Angka)</label>
                        <input ng-model="sesiSidang.sesi" type="text" class="form-control"  placeholder="Nama Sesi Sidang">
                    </div>
                    <div class="form-group" ng-class="{'has-error': timepickerForm.time2.$invalid}">
                        <label>Waktu Mulai</label>
                        <input type="text" class="form-control" size="5" ng-model="sesiSidang.waktu_mulai" data-time-format="HH:mm:ss" data-time-type="string" data-autoclose="1" bs-timepicker>
                    </div>
                    <div class="form-group" ng-class="{'has-error': timepickerForm.time2.$invalid}">
                        <label>Waktu Selesai</label>
                        <input type="text" class="form-control" size="5" ng-model="sesiSidang.waktu_selesai" data-time-format="HH:mm:ss" data-time-type="string" data-autoclose="1" bs-timepicker>
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Simpan" class="btn btn-success" ng-click="simpan()">Simpan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="sunting()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarSesiSidang.html">
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
        <div class="row" ng-controller="daftarSesiSidangController">
            <div class="col-md-12">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Sesi</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.sesi]]</td>
                            <td>[[item.waktu_mulai]]</td>
                            <td>[[item.waktu_selesai]]</td>
                            <td>
                                <a href="#/sunting/[[item.sesi]]">Sunting</a>
                                <a href="#/" ng-click="hapus([[item.sesi]])">Hapus</a>
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
