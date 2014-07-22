@extends('layouts.dasbor')
@section('page_title')
Sit In
@stop

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script>

var app = angular.module('dasborSitInDosen', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http) {
    $('#app').hide();
    $http.get('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}').success(function(data) {
        $rootScope.items = data;
        var count_sit_in_saat_ini = 0;
        var count_permintaan_sit_in = 0;
        var count_pembatalan_sit_in = 0;
        for (var i = data.length - 1; i >= 0; i--) {
            if (data[i].status == 1) {
                count_sit_in_saat_ini++;
            } else if (data[i].status == 0) {
                count_permintaan_sit_in++;
            } else if (data[i].status == -1) {
                count_pembatalan_sit_in++;
            }
        };

        if (count_sit_in_saat_ini == 0) {
            $('.sit_in_saat_ini').css('display', '');
            $('#sit_in_saat_ini').css('display', 'none');
        } else {
            $('#sit_in_saat_ini').css('display', '');
            $('.sit_in_saat_ini').css('display', 'none');
        }

        if (count_permintaan_sit_in == 0) {
            $('.permintaan_sit_in').css('display', '');
            $('#permintaan_sit_in').css('display', 'none');
        } else {
            $('#permintaan_sit_in').css('display', '');
            $('.permintaan_sit_in').css('display', 'none');
        }

        if (count_pembatalan_sit_in == 0) {
            $('.pembatalan_sit_in').css('display', '');
            $('#pembatalan_sit_in').css('display', 'none');
        } else {
            $('#pembatalan_sit_in').css('display', '');
            $('.pembatalan_sit_in').css('display', 'none');
        }
        $('#app').show();
    });

}

app.controller('sitInController', function($scope, $http, $rootScope) {
    $scope.batalkanSitIn = function(id_sit_in) {
        $http.delete('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}', {params: {'id_sit_in': String(id_sit_in)}}).success(function(data) {
            alert(data.pesan);
            update($rootScope, $http);
        });
    };
    $scope.setujuiSitIn = function(id_sit_in) {
        if(confirm("Apakah Anda yakin untuk menyetujui Sitin yang dipilih?")) {
            sitIn = {}
            sitIn.id_sit_in = String(id_sit_in);
            $http.put('{{URL::to('/dasbor/dosen/mahasiswa/sit_in')}}', sitIn).success(function(data) {
                alert("Penyetujuan berhasil.");
                update($rootScope, $http);
            });
        }
    }
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div id="app" ng-app="dasborSitInDosen" style="display:none;">
    <div ng-controller="sitInController">
        <div class="row">
            <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Sit In Saat Ini
                </div>
                <div class="sit_in_saat_ini panel-footer" style="display:none;">
                    Tidak ada data
                </div>
                <table id="sit_in_saat_ini" class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: 1}: true">
                            <th class="text-center">[[$index+1]]</th>
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Permintaan Sit In
                </div>
                <div class="permintaan_sit_in panel-footer" style="display:none;">
                    Tidak ada data
                </div>
                <table id="permintaan_sit_in" class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                            <th class="col-md-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: 0}: true">
                            <th class="text-center">[[$index+1]]</th>
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a ng-click="setujuiSitIn([[item.id_sit_in]])" class="btn btn-warning btn-xs">Setujui</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Pembatalan Sit In
                </div>
                <div class="pembatalan_sit_in panel-footer" style="display:none;">
                    Tidak ada data
                </div>
                <table id="pembatalan_sit_in" class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="col-md-2 text-center">NRP</th>
                            <th class="col-md-3 text-center">Waktu Permintaan</th>
                            <th class="col-md-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in items | filter: {status: -1}: true">
                            <th class="text-center">[[$index+1]]</th>
                            <td>[[item.mahasiswa.nama_lengkap]]</td>
                            <td>[[item.mahasiswa.nrp_mahasiswa]]</td>
                            <td>[[item.updated_at]]</td>
                            <td>
                                <a ng-click="batalkanSitIn([[item.id_sit_in]])" class="btn btn-warning btn-xs">Terima Pembatalan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
