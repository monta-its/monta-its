@extends('layouts.dasbor')
@section('page_title')
Kelola Berita
@stop

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

var updateBerita = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/dosen/berita')}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};


app.controller('daftarBeritaController', function($scope, $http, $rootScope) {
    $scope.hapusBerita = function(id_pos) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/dosen/berita')}}', {'params': {'id_pos': String(id_pos)}}).success(function(data) {
                updateBerita($rootScope, $http);
                alert('Berita dihapus');
            });
        }
    };
    $scope.publish = function(id_pos, action) {
        var berita = {};

        $.each($rootScope.items, function(i, val) {
            if(val.id_pos == id_pos) {
                berita = val;
            }
        });

        berita.apakah_terbit = action;

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
    .when('/', { templateUrl: 'daftarBerita.html'})
    .when('/:method', { templateUrl: 'beritaSunting.html'})
    .when('/:method/:id', { templateUrl: 'beritaSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
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
                        <textarea ng-model="berita.isi" class="form-control" rows="10" name="isiBerita" id="isiBerita" placeholder="Isi Berita"></textarea>
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
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td>[[item.id_pos]]</td>
                            <td>[[item.judul]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a href="#/" ng-show="item.apakah_terbit" ng-click="publish([[item.id_pos]], false)">Non publikasi</a>
                                <a href="#/" ng-hide="item.apakah_terbit" ng-click="publish([[item.id_pos]], true)">Publikasi</a>
                                <a href="#/sunting/[[item.id_pos]]">Sunting</a>
                                <a href="#/" ng-click="hapusBerita([[item.id_pos]])">Hapus</a>
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
