@extends('layouts.dasbor')

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborisi_panduan', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateisi_panduan($rootScope, $http);
});

var updateisi_panduan = function($rootScope, $http) {
    $http.get('{{URL::to('/dasbor/dosen/isi_panduan')}}').success(function(data) {
        $rootScope.items = data;
    });
};


app.controller('daftarisi_panduanController', function($scope, $http, $rootScope) {
    $scope.hapusisi_panduan = function(id_isi_panduan) {
        $http.delete('{{URL::to('/dasbor/dosen/isi_panduan')}}', {'params': {'id_isi_panduan': String(id_isi_panduan)}}).success(function(data) {
            updateisi_panduan($rootScope, $http);
            alert('isi_panduan dihapus');
        });
    };
});

app.controller('isi_panduanSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.isi_panduan = {};
        $scope.isi_panduan.judul_isi_panduan = "";
        $scope.isi_panduan.isi = "";
        $scope.isi_panduan.lampiran = "";
        $scope.terbitkanisi_panduan = function() {
            $http.post('{{{URL::to('/dasbor/dosen/isi_panduan')}}}', $scope.isi_panduan).success(function(data) {
                updateisi_panduan($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.isi_panduan = {};
            $scope.isi_panduan.id_isi_panduan = $routeParams.id;
            $scope.suntingisi_panduan = function() {
                $http.put('{{URL::to('/dasbor/dosen/isi_panduan')}}', $scope.isi_panduan).success(function (data) {
                    updateisi_panduan($rootScope, $http);
                    $location.path('/');
                });
            };
            console.log($rootScope.items);
            $.each($rootScope.items, function(i, val) {
                if(val.id_isi_panduan === $scope.isi_panduan.id_isi_panduan) {
                    $scope.isi_panduan.judul_isi_panduan = val.judul_isi_panduan;
                    $scope.isi_panduan.isi = val.isi;
                    $scope.isi_panduan.lampiran = val.lampiran;
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
    .when('/', { templateUrl: 'daftarisi_panduan.html'})
    .when('/:method', { templateUrl: 'isi_panduanSunting.html'})
    .when('/:method/:id', { templateUrl: 'isi_panduanSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola isi_panduan</h1>
    </div>
</div>
<div ng-app="dasborisi_panduan">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="isi_panduanSunting.html">

        <div class="row">
        </div>
        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="isi_panduanSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="isi_panduan.judul_isi_panduan" type="text" class="form-control input-lg" id="judul_isi_panduanisi_panduan" name="judul_isi_panduanisi_panduan" placeholder="judul_isi_panduan isi_panduan">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="isi_panduan.isi" class="form-control" rows="10" name="isiisi_panduan" id="isiisi_panduan"></textarea>
                    </div>
                    <div class="form-group">
                        <input placeholder="Masukkan URL/pranala menuju lampiran (dari Dropbox/Google Drive)" ng-model="isi_panduan.lampiran" class="form-control" rows="10" name="lampiranisi_panduan" id="lampiranisi_panduan" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Terbitkan" class="btn btn-success" ng-click="terbitkanisi_panduan()">Terbitkan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="suntingisi_panduan()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarisi_panduan.html">
        <div class="row" >
            <div class="col-md-6">
                <a href="#/baru" class="btn btn-default">Buat Baru</a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input ng-model="searchText" type="text" class="form-control input-xs"  placeholder="Pencarian">
                </div>
            </div>
        <div class="row" ng-controller="daftarisi_panduanController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>judul_isi_panduan</th>
                            <th>Penulis</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.id_isi_panduan]]</td>
                            <td>[[item.judul_isi_panduan]]</td>
                            <td>[[item.pegawai.nama_lengkap]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a href="#/sunting/[[item.id_isi_panduan]]">Sunting</a>
                                <a href="#/" ng-click="hapusisi_panduan([[item.id_isi_panduan]])">Hapus</a>
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
