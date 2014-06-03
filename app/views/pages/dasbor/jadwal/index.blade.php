@extends('layouts.dasbor')
@section('page_title')
Jadwal Dosen Penguji
@stop
@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script>
var app = angular.module('dasborJadwalDosen', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

var update = function($rootScope, $http, callback) {
    // Ambil JadwalDosen
    $http.get('{{{URL::to('/dasbor/dosen/jadwal')}}}?mySelf=true').success(function(data) {
        $rootScope.jadwalDosen = data;
    });

    // SesiSidangController
    $http.get('{{{URL::to('/dasbor/umum/pegawai/sesi_sidang')}}}').success(function(data) {
        $rootScope.sesiSidang = data;
        if(callback) callback();
    });
}

app.controller('kelolaJadwalDosen', function($http, $rootScope, $scope) {
    // Nama nama hari
    $scope.hari = [];
    $scope.hari.push({id:1, nama:"Senin"});
    $scope.hari.push({id:2, nama:"Selasa"});
    $scope.hari.push({id:3, nama:"Rabu"});
    $scope.hari.push({id:4, nama:"Kamis"});
    $scope.hari.push({id:5, nama:"Jumat"});
    // Itu nama-nama hari KERJA (singing)

    update($rootScope, $http, function() {
        $scope.statusJadwal = function(sesi_dipilih, hari_dipilih) {
            for(idx in $rootScope.jadwalDosen) {
                if($rootScope.jadwalDosen[idx].sesi == sesi_dipilih && $rootScope.jadwalDosen[idx].hari == hari_dipilih) {
                    if($rootScope.jadwalDosen[idx].apakah_tersedia == 0) {
                        return 0;
                    } else {
                        return 1;
                    }
                }
            }

            return -1;
        };

        $scope.setTersedia = function(sesi_dipilih, hari_dipilih) {
            // POST or PUT, doesn't matter
            $http.post('{{{URL::to('/dasbor/dosen/jadwal')}}}', {hari: String(hari_dipilih), sesi: String(sesi_dipilih), apakah_tersedia: 1}).success(function(data) {
                update($rootScope, $http);
            });
        };

        $scope.setTidakTersedia = function(sesi_dipilih, hari_dipilih) {
            $http.post('{{{URL::to('/dasbor/dosen/jadwal')}}}', {hari: String(hari_dipilih), sesi: String(sesi_dipilih), apakah_tersedia: 0}).success(function(data) {
                update($rootScope, $http);
            });
        };
    });
});
app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div ng-app="dasborJadwalDosen">
<div ng-controller="kelolaJadwalDosen">
<div class="row">
    <div class="col-md-12">
        <p>Jadwal ketersediaan Bapak/Ibu sebagai dosen penguji seminar/sidang.</p>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Hari</th>
                    <th class="text-center" ng-repeat="sd in sesiSidang">Sesi [[sd.sesi]] ([[sd.waktu_mulai]] - [[sd.waktu_selesai]])</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="h in hari">
                    <td>[[h.nama]]</td>
                    <td class="text-center" ng-repeat="sd in sesiSidang">
                    <button class="label label-success" ng-click="setTidakTersedia([[sd.sesi]],[[h.id]])" ng-show="statusJadwal([[sd.sesi]],[[h.id]])==1">tersedia</button>
                    <button class="label label-danger"  ng-click="setTersedia([[sd.sesi]],[[h.id]])" ng-show="statusJadwal([[sd.sesi]],[[h.id]])==0">tidak tersedia</button>
                    <button class="label label-default"  ng-click="setTersedia([[sd.sesi]],[[h.id]])" ng-show="statusJadwal([[sd.sesi]],[[h.id]])==-1">belum ditentukan</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

@stop
