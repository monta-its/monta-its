@extends('layouts.dasbor')
@section('page_title')
Kelola dan Unggah Berkas
@stop

@section('content')
<script type="text/javascript" src="{{URL::to('assets/angular/angular-file-upload-shim.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-file-upload.min.js')}}"></script>
<script>
var app = angular.module('dasborBerkas', ['ngRoute', 'angularFileUpload'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/mahasiswa/berkas')}}').success(function(data) {
        $rootScope.items = data;
    });

    // Ambil data tugas akhir
    $http.get('{{URL::to('/dasbor/umum/dosen/tugas_akhir')}}').success(function(data) {
        $rootScope.tugasAkhir = data;
        if(callback) callback();
    });
};

app.controller('daftarBerkasController', function($scope, $http, $rootScope) {
    $scope.hapus = function(id_berkas_tugas_akhir) {
        if(confirm('Yakin hapus berkas tersebut')) {
            $http.delete('{{URL::to('/dasbor/mahasiswa/berkas')}}', {params: {'id_berkas_tugas_akhir': String(id_berkas_tugas_akhir)}}).success(function(data) {
                alert(data.pesan);
                update($rootScope, $http);
            });
        }
    };
});

app.controller('unggahBerkasController', function($scope, $http, $rootScope, $upload, $location) {
    $scope.jenisBerkas = [{nama: "proposal", teks: "Berkas Proposal"}, {nama: "akhir", teks: "Berkas Akhir"},{nama:"lainnya", teks:"Berkas Lainnya"}];

    // Set data unggahan baru
    $scope.berkas = {};

    // Fungsi aksi event
    $scope.pilihBerkas = function($files) {
        $scope.berkas.berkas_lampiran = $files[0];
    };

    update($rootScope, $http, function() {
        $scope.berkas.jenis_berkas = "lainnya"; // Pilihan default: Berkas Lainnya
        if($rootScope.tugasAkhir.length > 0) {
            $scope.berkas.id_tugas_akhir = $rootScope.tugasAkhir[0].id_tugas_akhir;
        } else {
            alert('Anda belum memiliki Tugas Akhir.')
            $location.go('/');
        }


        $scope.unggahBerkas = function() {
            $upload.upload({
                url: '{{URL::to('/dasbor/mahasiswa/berkas')}}',
                method: 'POST',
                data: $scope.berkas,
                file: $scope.berkas.berkas_lampiran
            }).success(function(data, status, headers, config) {
                alert(data.pesan);
                update($rootScope, $http);
                $location.path('/');
            }).error(function() {
                alert('Pengunggahan berkas gagal')
                update($rootScope, $http);
                $location.path('/');
            });
        }
    });
});

app.config(function($routeProvider) {
    $routeProvider
    .when('/', { templateUrl: 'daftarBerkas.html'})
    .when('/unggah', { templateUrl: 'unggahBerkas.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborBerkas">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="daftarBerkas.html">
        <div ng-controller="daftarBerkasController">
            <div class="row" >
                <div class="col-md-6">
                    <a href="#/unggah" class="btn btn-default">Unggah Berkas Baru</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br />
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Berkas</th>
                                <th class="text-center col-md-2">Jenis Berkas</th>
                                <th class="text-center col-md-3">Waktu Unggah</th>
                                <th class="text-center col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in items">
                                <td>[[item.nama_berkas]]</td>
                                <td class="text-center">[[item.jenis_berkas]]</td>
                                <td class="text-center">[[item.updated_at]]</td>
                                <td class="text-center">
                                    <a href="{{URL::to('/')}}/[[item.path]]">Unduh</a>
                                    <a href="#/" ng-click="hapus([[item.id_berkas_tugas_akhir]])">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="unggahBerkas.html">
        <div class="row" ng-controller="unggahBerkasController">
            <div class="col-md-12">
                <p>Pada laman ini, Anda dapat menggunggah berkas berupa berkas proposal, buku sidang atau berkas lainnya yang berhubungan dengan Tugas Akhir. Silakan pilih berkas dari media penyimpanan, pilih jenis berkasnya dan klik tombol <strong>Unggah</strong></p>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="file" class="form-control"  ng-file-select="pilihBerkas($files)" placeholder="Berkas Unggah" />
                </div>
                <div class="form-group">
                    <select class="form-control" ng-model="berkas.jenis_berkas" ng-options="jb.nama as jb.teks for jb in jenisBerkas" ></select>
                </div>
                <div class="form-group">
                    <select class="form-control" ng-model="berkas.id_tugas_akhir" ng-options="ta.id_tugas_akhir as ta.penawaran_judul.judul_tugas_akhir for ta in tugasAkhir" ></select>
                </div>
                <button ng-click="unggahBerkas()" class="btn btn-success">Unggah Berkas</button>
            </div>
        </div>
    </script>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
