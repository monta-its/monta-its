@extends('layouts.dasbor')
@section('page_title')
Kelola Penawaran Judul
@stop

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

var updateJudul = function($rootScope, $http, callback) {
    $('#app').hide();
    $http.get('{{URL::to('/dasbor/dosen/judul')}}').success(function(data) {
        $rootScope.items = data;
        $('#app').show();
    });

};


app.controller('daftarJudulController', function($scope, $http, $rootScope, $routeParams) {
    if($routeParams) {
        $scope.searchText = $routeParams.searchText;
    }
    $scope.hapusJudul = function(id_penawaran_judul) {
        if(confirm("Yakin untuk menghapus ini?")) {
        $http.delete('{{URL::to('/dasbor/dosen/judul')}}', {'params': {'id_penawaran_judul': String(id_penawaran_judul)}}).success(function(data) {
            updateJudul($rootScope, $http);
            alert(data.pesan);
        });}
    };
});

app.controller('judulSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    if(method == "baru") {
        $scope.judul = {};
        $scope.judul.judul_tugas_akhir = "";
        $scope.judul.deskripsi = "";
        $scope.tambahJudul = function() {
            $http.post('{{{URL::to('/dasbor/dosen/judul')}}}', $scope.judul).success(function(data) {console.log(data);
                if(data.error) {
                    alert('Data belum lengkap.')
                } else {
                    updateJudul($rootScope, $http)
                    $location.path('/');
                    alert(data.pesan);
                }
            });
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.judul = {};
            $scope.judul.id_penawaran_judul = $routeParams.id;
            $scope.suntingJudul = function() {
                $http.put('{{URL::to('/dasbor/dosen/judul')}}', $scope.judul).success(function (data) {
                    if(data.error) {
                        alert('Data belum lengkap.')
                    } else {
                        updateJudul($rootScope, $http)
                        $location.path('/');
                        alert(data.pesan);
                    }
                });
            };
            updateJudul($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_penawaran_judul == $scope.judul.id_penawaran_judul) {
                        $scope.judul.judul_tugas_akhir = val.judul_tugas_akhir;
                        $scope.judul.deskripsi = val.deskripsi;
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
    .when('/', { templateUrl: 'daftarJudul.html'})
    .when('/:method', { templateUrl: 'judulSunting.html'})
    .when('/:method/:id', { templateUrl: 'judulSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div id="app" ng-app="dasborJudul" style="display:none;">
    <ng-view>
    </ng-view>

    <script type="text/ng-template" id="judulSunting.html">

        <form role="form" action="" method="post" accept-charset="utf-8" ng-controller="judulSuntingController">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input ng-model="judul.judul_tugas_akhir" type="text" class="form-control" placeholder="Judul Tugas Akhir">
                    </div>
                    <div class="form-group">
                        <textarea ng-model="judul.deskripsi" class="form-control" rows="10" placeholder="Deskripsi"></textarea>
                    </div>
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
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Status</th>
                            <th class="text-center col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: searchText | orderBy:'created_at':true">
                            <td><a href="{{ URL::to('/judul') }}/[[item.id_penawaran_judul]]">[[item.judul_tugas_akhir]]</a></td>
                            <td class="text-center">[[item.tugasAkhir ? "Diambil": "Belum Diambil"]]</td>
                            <td class="text-center">
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
