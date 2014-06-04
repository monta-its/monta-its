@extends('layouts.dasbor')
@section('page_title')
Kelola Syarat
@stop
@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>
var app = angular.module('dasborKelolaSyarat', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http, callback) {
    // Sebutkan nama-nama syarat
    $rootScope.waktuSyarat = [{id: "pra_sit_in", nama:"Pra Sit In"},
                            {id: "pra_bimbingan", nama:"Pra Bimbingan"},
                            {id: "pra_seminar_proposal", nama:"Pra Seminar Proposal"},
                            {id: "pra_sidang_akhir", nama:"Pra Sidang Akhir"}];
    $rootScope.jenisMahasiswa = [{id: "reguler", nama:"Reguler"}, {id:"lintas_jalur", nama:"Lintas Jalur"}];

    $http.get('{{{URL::to('/dasbor/pegawai/syarat')}}}').success(function(data) {
        $rootScope.items = data;
        if(callback) callback();
    });
};

app.controller('syaratController', function($scope, $rootScope, $http) {
    $scope.hapus = function(id_syarat) {
        if(confirm('Yakin akan menghapus ini?')) {
            $http.delete('{{{URL::to('/dasbor/pegawai/syarat')}}}', {params: {'id_syarat': String(id_syarat)}}).success(function() {
                alert('Penghapusan sukses');
                update($rootScope, $http, function() {
                });
            });
        }
    };
});

app.controller('suntingSyaratController', function($scope, $rootScope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    $scope.syarat = {};
    if(method == "baru") {
        $scope.syarat.kode_syarat = "";
        $scope.syarat.nama_syarat = "";
        $scope.syarat.waktu_syarat = $routeParams.id;
        $scope.syarat.jenis_mahasiswa = "reguler";

        $scope.tambah = function() {
            $http.post('{{{URL::to('/dasbor/pegawai/syarat')}}}', $scope.syarat).success(function() {
                alert('Penambahan sukses');
                update($rootScope, $http, function() {
                    $location.path('/');
                });
            });
        };

    } else if(method == "sunting") {
        $scope.syarat.id_syarat = $routeParams.id;
        update($rootScope, $http, function() {
            for(idx in $rootScope.items) {
                if($rootScope.items[idx].id_syarat == $scope.syarat.id_syarat) {
                    $scope.syarat.kode_syarat = $rootScope.items[idx].kode_syarat;
                    $scope.syarat.nama_syarat = $rootScope.items[idx].nama_syarat;
                    $scope.syarat.waktu_syarat = $rootScope.items[idx].waktu_syarat;
                    $scope.syarat.jenis_mahasiswa = $rootScope.items[idx].jenis_mahasiswa;

                    $scope.sunting = function() {
                        $http.put('{{{URL::to('/dasbor/pegawai/syarat')}}}', $scope.syarat).success(function() {
                            alert('Penyuntingan sukses');
                            update($rootScope, $http, function() {
                                $location.path('/');
                            });
                        });
                    };
                }
            }
        });
    }
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});

app.config(function($routeProvider) {
    $routeProvider
    .when('/', { templateUrl: 'index.html'})
    .when('/:method', { templateUrl: 'edit.html'})
    .when('/:method/:id', { templateUrl: 'edit.html'})
});
</script>
<div class="row" ng-app="dasborKelolaSyarat">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="index.html">
        <div class="col-md-12" ng-controller="syaratController">
            <div class="panel panel-default" ng-repeat="ws in waktuSyarat">
                <div class="panel-heading">
                    Syarat [[ws.nama]] <a class="btn btn-primary btn-xs pull-right" href="#/baru/[[ws.id]]" >Tambah</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Syarat</th>
                                <th>Jenis Mahasiswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="syarat in items | filter: {'waktu_syarat': ws.id}">
                                <td>[[syarat.kode_syarat]]</td>
                                <td>[[syarat.nama_syarat]]</td>
                                <td>[[syarat.jenis_mahasiswa]]</td>
                                <td><a href="#/sunting/[[syarat.id_syarat]]">Sunting</a> | <a href="#/" ng-click="hapus([[syarat.id_syarat]])">Hapus</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="edit.html">
        <div class="col-md-12" ng-controller="suntingSyaratController">
                <div class="form-group">
                    <label for="kode_syarat">Kode Syarat</label>
                    <input type="text" name="kode_syarat" ng-model="syarat.kode_syarat" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="nama_syarat">Nama Syarat</label>
                    <input type="text" name="nama_syarat" ng-model="syarat.nama_syarat" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="waktu_syarat">Waktu Syarat</label>
                    <select name="waktu_syarat" ng-model="syarat.waktu_syarat" ng-options="item.id as item.nama for item in waktuSyarat" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_mahasiswa">Jenis Mahasiswa</label>
                    <select name="jenis_mahasiswa" ng-model="syarat.jenis_mahasiswa" ng-options="item.id as item.nama for item in jenisMahasiswa" class="form-control">
                        <option value=""></option>
                        <option value="reguler">Reguler</option>
                        <option value="lintas_jalur">Lintas Jalur</option>
                    </select>
                </div>
                <button class="btn btn-primary" ng-show="method=='baru'" ng-click="tambah()">Tambah</button>
                <button class="btn btn-primary" ng-show="method=='sunting'" ng-click="sunting()">Sunting</button>
        </div>
    </script>
</div>

@stop
