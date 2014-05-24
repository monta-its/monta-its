@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborBidangMinat', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateBidangMinat($rootScope, $http);
});

var updateBidangMinat = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/dosen/prodi')}}').success(function(data) {
        $rootScope.items = data;
        // Ambil data dosen untuk milih koordinator
        $http.get('{{URL::to('/dasbor/pengguna/dosen')}}').success(function(data) {
            $rootScope.dosens = data;
            if(callback) callback();
        });
    });

};


app.controller('daftarBidangMinatController', function($scope, $http, $rootScope) {
    $scope.hapusBidangMinat = function(kode_bidang_minat) {
        $http.delete('{{URL::to('/dasbor/dosen/prodi')}}', {'params': {'kode_bidang_minat': String(kode_bidang_minat)}}).success(function(data) {
            updateBidangMinat($rootScope, $http);
            alert('Prodi dihapus');
        });
    };
});

app.controller('bidangMinatSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.bidangMinat = {};
        $scope.kode_bidang_minat = "";
        $scope.bidangMinat.nama_bidang_minat = "";
        $scope.bidangMinat.deskripsi_bidang_minat = "";
        $scope.tambahBidangMinat = function() {
            $http.post('{{{URL::to('/dasbor/dosen/prodi')}}}', $scope.bidangMinat).success(function(data) {
                updateBidangMinat($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.bidangMinat = {};
            $scope.bidangMinat.kode_bidang_minat = $routeParams.id;
            $scope.suntingBidangMinat = function() {
                $http.put('{{URL::to('/dasbor/dosen/prodi')}}', $scope.bidangMinat).success(function (data) {
                    updateBidangMinat($rootScope, $http);
                    $location.path('/');
                });
            };
            updateBidangMinat($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.kode_bidang_minat === $scope.bidangMinat.kode_bidang_minat) {
                        $scope.bidangMinat.nama_bidang_minat = val.nama_bidang_minat;
                        $scope.bidangMinat.deskripsi_bidang_minat = val.deskripsi_bidang_minat;
                        $.each($rootScope.dosens, function(j, val2) {
                            if(val2.nip_dosen == val.nip_dosen_koordinator) {
                                $scope.bidangMinat.dosenKoordinator = val2;
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
    .when('/', { templateUrl: 'daftarBidangMinat.html'})
    .when('/:method', { templateUrl: 'bidangMinatSunting.html'})
    .when('/:method/:id', { templateUrl: 'bidangMinatSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Program Studi</h1>
    </div>
</div>
<div ng-app="dasborBidangMinat">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="bidangMinatSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="bidangMinatSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-show="method=='baru'" ng-model="bidangMinat.kode_bidang_minat" type="text" class="form-control input-lg" placeholder="Kode Prodi (Nomor / Singkatan)">
                        <input ng-model="bidangMinat.nama_bidang_minat" type="text" class="form-control input-lg" placeholder="Nama Prodi">
                        <textarea ng-model="bidangMinat.deskripsi_bidang_minat" type="text" class="form-control input-lg" placeholder="Deskripsi Prodi" rows="10"></textarea>
                        <select ng-model="bidangMinat.dosenKoordinator" ng-options="dosen.pegawai.nama_lengkap for dosen in dosens"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Tambah" class="btn btn-success" ng-click="tambahBidangMinat()">Tambah</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="suntingBidangMinat()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarBidangMinat.html">
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
        <div class="row" ng-controller="daftarBidangMinatController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Prodi</th>
                            <th>Dosen Koordinator</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.kode_bidang_minat]]</td>
                            <td>[[item.nama_bidang_minat]]</td>
                            <td>[[item.dosen_koordinator.pegawai.nama_lengkap]]</td>
                            <td>
                                <a href="#/sunting/[[item.kode_bidang_minat]]">Sunting</a>
                                <a href="#/" ng-click="hapusBidangMinat([[item.kode_bidang_minat]])">Hapus</a>
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
