@extends('layouts.dasbor')

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborBerita', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    updateBerita($rootScope, $http);
});

var updateBerita = function($rootScope, $http) {
    $http.get('{{URL::to('/dasbor/dosen/berita')}}').success(function(data) {
        $rootScope.items = data;
    });
};


app.controller('daftarBeritaController', function($scope, $http, $rootScope) {
    $scope.hapusBerita = function(id_post) {
        $http.delete('{{URL::to('/dasbor/dosen/berita')}}', {'params': {'id_post': String(id_post)}}).success(function(data) {
            updateBerita($rootScope, $http);
            alert('Berita dihapus');
        });
    };
    $scope.publish = function(id_post, action) {
        var berita = {};

        $.each($rootScope.items, function(i, val) {
            if(val.id_post == id_post) {
                berita = val;
            }
        });

        berita.is_published = action;

        $http.put('{{{URL::to('/dasbor/dosen/berita')}}}', berita).success(function(data) {
            updateBerita($rootScope, $http)
            $location.path('/');
        })
    };
});

app.controller('beritaSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.berita = {};
        $scope.berita.judul = "";
        $scope.berita.isi = "";
        $scope.berita.is_published = true;
        $scope.terbitkanBerita = function() {
            $http.post('{{{URL::to('/dasbor/dosen/berita')}}}', $scope.berita).success(function(data) {
                updateBerita($rootScope, $http)
                $location.path('/');
            })
        };
        $scope.simpanBerita = function() {
            $scope.berita.is_published = false;
            $http.post('{{{URL::to('/dasbor/dosen/berita')}}}', $scope.berita).success(function(data) {
                updateBerita($rootScope, $http)
                $location.path('/');
            })
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.berita = {};
            $scope.berita.id_post = $routeParams.id;
            $scope.suntingBerita = function() {
                $http.put('{{URL::to('/dasbor/dosen/berita')}}', $scope.berita).success(function (data) {
                    updateBerita($rootScope, $http);
                    $location.path('/');
                });
            };
            $.each($rootScope.items, function(i, val) {
                if(val.id_post === $scope.berita.id_post) {
                    $scope.berita.judul = val.judul;
                    $scope.berita.isi = val.isi;
                    $scope.berita.is_published = val.is_published;
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
    .when('/', { templateUrl: 'daftarBerita.html'})
    .when('/:method', { templateUrl: 'beritaSunting.html'})
    .when('/:method/:id', { templateUrl: 'beritaSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Kelola Berita</h1>
    </div>
</div>
<div ng-app="dasborBerita">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="beritaSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="beritaSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="berita.judul" type="text" class="form-control input-lg" id="judulBerita" name="judulBerita" placeholder="Judul Berita">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="berita.isi" class="form-control" rows="10" name="isiBerita" id="isiBerita"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Terbitkan" class="btn btn-success" ng-click="terbitkanBerita()">Terbitkan</button>
                    <button ng-show="method=='baru'" type="submit" name="aksi" value="Simpan" class="btn btn-success" ng-click="simpanBerita()">Simpan</button>
                    <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="suntingBerita()">Sunting</button>
                </div>
            </div>
        </form>
    </script>
    <script type="text/ng-template" id="daftarBerita.html">
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
        <div class="row" ng-controller="daftarBeritaController">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText">
                            <td>[[item.id_post]]</td>
                            <td>[[item.judul]]</td>
                            <td>[[item.dosen.pegawai.nama_lengkap]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a href="#" ng-show="item.is_published" ng-click="publish([[item.id_post]], false)">Non publikasi</a>
                                <a href="#" ng-hide="item.is_published" ng-click="publish([[item.id_post]], true)">Publikasi</a>
                                <a href="#/sunting/[[item.id_post]]">Sunting</a>
                                <a href="#" ng-click="hapusBerita([[item.id_post]])">Hapus</a>
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
