@extends('layouts.dasbor')
@section('page_title')
Kelola Sidang
@stop

@section('content')

<script type="text/javascript" src="{{URL::to('assets/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-route.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/angular/angular-strap.tpl.min.js')}}"></script>
<script>
var app = angular.module('dasborSidang', ['ngRoute', 'mgcrea.ngStrap'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).run(function($rootScope, $http) {
    update($rootScope, $http);
});

var update = function($rootScope, $http, callback) {
    $http.get('{{URL::to('/dasbor/pengguna/dosen')}}').success(function(data){
        $rootScope.dosen = data;
        $http.get('{{URL::to('/dasbor/mahasiswa/sidang')}}').success(function(data) {
            $rootScope.items = data;
            $http.get('{{URL::to('/dasbor/umum/dosen/tugas_akhir')}}').success(function(data) {
                $rootScope.tugasAkhir = data;
                $http.get('{{URL::to('/dasbor/umum/pegawai/ruangan')}}').success(function(data){
                    $rootScope.ruangan = data;
                    if(callback) callback();
                });
            });

        });

    });



};


app.controller('daftarSidangController', function($scope, $http, $rootScope) {
    $scope.hapus = function(id_sidang) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/mahasiswa/sidang')}}', {'params': {'id_sidang': String(id_sidang)}}).success(function(data) {
                update($rootScope, $http);
                alert('Sidang dihapus');
            });
        }
    };
});

app.controller('sidangSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    var method = $routeParams.method;
    $scope.method = method;
    $scope.jenisSidang = [
    {
        jenis: "proposal", nama: "Seminar Proposal"
    },
    {
        jenis: "akhir", nama: "Sidang Akhir"
    }
    ];
    $scope.tambahDosenPenguji = function() {
        if($scope.sidang) {
            if($scope.sidang.pengujiSidang) {
                $.each($rootScope.dosen, function(i, val) {
                    if(val.nip_dosen == $scope.dosenPengujiDipilih) {
                        if(!(val in $scope.sidang.pengujiSidang)) {
                            var doNot = false;
                            $.each($scope.sidang.pengujiSidang, function(i, sid) {
                                if(sid.nip_dosen == $scope.dosenPengujiDipilih)
                                {
                                    doNot = true;
                                }
                            });
                            if(!doNot) $scope.sidang.pengujiSidang.push(val);
                        }
                        $scope.dosenPengujiDipilih = "";
                    }
                });
            }
        }
    }
    $scope.hapusDosenPenguji = function(nip_dosen) {
        if($scope.sidang) {
            if($scope.sidang.pengujiSidang) {
                $.each($scope.sidang.pengujiSidang, function(i, val) {
                    if(val.nip_dosen == nip_dosen) {
                        $scope.sidang.pengujiSidang.splice(i,1);
                        return;
                    }
                });
            }
        }
    }
    if(method == "baru") {
        $scope.sidang = {};
        $scope.sidang.tugasAkhir = {};
        $scope.sidang.pengujiSidang = [];
        $scope.sidang.ruangan = {};
        $scope.sidang.jenis_sidang = "proposal";
        $scope.sidang.waktu_mulai = "";
        $scope.sidang.waktu_selesai = "";
        $scope.simpan = function() {
            $http.post("{{{URL::to('/dasbor/mahasiswa/sidang')}}}", $scope.sidang).success(function(data) {
                alert('Sidang baru dibuat.');
                $location.path("/");
                update($rootScope, $http);
            });
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.sunting = function() {
                $http.put("{{{URL::to('/dasbor/mahasiswa/sidang')}}}", $scope.sidang).success(function(data) {
                    alert('Penyuntingan berhasil');
                    $location.path("/");
                    update($rootScope, $http);
                });
            }
            $scope.sidang = {};
            $scope.sidang.pengujiSidang = [];
            update($rootScope, $http, function() {
                $.each($rootScope.items, function(i, val) {
                    if(val.id_sidang == $routeParams.id) {
                        $scope.sidang.id_sidang  = val.id_sidang
                        $scope.sidang.jenis_sidang = val.jenis_sidang;
                        $scope.sidang.waktu_mulai = val.waktu_mulai;
                        $scope.sidang.waktu_selesai = val.waktu_selesai;
                        $.each($rootScope.tugasAkhir, function(i, ta) {
                            if(ta.id_tugas_akhir == val.tugas_akhir.id_tugas_akhir) {
                                $scope.sidang.tugasAkhir = ta;
                            }
                        });
                        $.each($rootScope.ruangan, function(i, ruang) {
                            if(ruang.id_ruangan == val.ruangan.id_ruangan) {
                                $scope.sidang.ruangan = ruang;
                            }
                        });
                        $.each($rootScope.dosen, function(i, dos) {
                            $.each(val.penguji_sidang, function(i, peng) {
                                if(dos.nip_dosen == peng.nip_dosen) {
                                    console.log(dos);
                                    $scope.sidang.pengujiSidang.push(dos);
                                }
                            });
                        });
                    }
                });
            });
        }
    } else {
        $location.path('/');
    }

});

app.config(function($routeProvider) {
    $routeProvider
    .when('/', { templateUrl: 'daftarSidang.html'})
    .when('/:method', { templateUrl: 'sidangSunting.html'})
    .when('/:method/:id', { templateUrl: 'sidangSunting.html'})
});

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
});
</script>
<div class="row" ng-app="dasborSidang">
    <ng-view>
    </ng-view>
    <script type="text/ng-template" id="sidangSunting.html">
        <div class="row" ng-controller="sidangSuntingController">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Jenis Sidang</label>
                    <select class="form-control" ng-model="sidang.jenis_sidang" ng-options="item.jenis as item.nama for item in jenisSidang"></select>
                </div>

                <div class="form-group">
                    <label>Tugas Akhir</label>
                    <select class="form-control" ng-model="sidang.tugasAkhir" ng-options="item as item.penawaran_judul.judul_tugas_akhir for item in tugasAkhir" ></select>
                </div>
                <div class="form-group">
                    <label>Ruangan</label>
                    <select class="form-control" ng-model="sidang.ruangan" ng-options="item as item.nama_ruangan for item in ruangan" ></select>
                </div>

                <div class="form-group">
                    <label>Mulai</label>
                    <div class="form-group">
                      <input type="text" size="10" class="form-control" ng-model="sidang.waktu_mulai" data-autoclose="1" placeholder="Tanggal Mulai" bs-datepicker>
                    </div>
                    <div class="form-group">
                      <input type="text" size="8" class="form-control" ng-model="sidang.waktu_mulai" data-autoclose="1" placeholder="Waktu Mulai" bs-timepicker>
                    </div>
                  </div>
                <div class="form-group">
                    <label>Selesai</label>
                    <div class="form-group">
                      <input type="text" size="10" class="form-control" ng-model="sidang.waktu_selesai" data-autoclose="1" placeholder="Tanggal Selesai" bs-datepicker>
                    </div>
                    <div class="form-group">
                      <input type="text" size="8" class="form-control" ng-model="sidang.waktu_selesai" data-autoclose="1" placeholder="Waktu Selesai" bs-timepicker>
                    </div>
                  </div>
                <div class="form-group">
                    <label>Dosen Penguji</label>
                    <div class="form-group">
                        <form ng-submit="tambahDosenPenguji()">
                        <input type="text" ng-options="item.nip_dosen as item.nip_dosen + ' - ' + item.pegawai.nama_lengkap for item in dosen" ng-model="dosenPengujiDipilih" class="form-control" placeholder="Masukkan NIP/Nama Dosen" bs-typeahead></input><button type="submit" class="btn">Tambah</button>
                        <ul>
                            <li ng-repeat="item in sidang.pengujiSidang">
                                [[item.pegawai.nama_lengkap]] <button ng-click="hapusDosenPenguji([[item.nip_dosen]])" class="btn">Hapus</button>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>


            </div>
            <div class="col-md-4">
                <button ng-show="method=='baru'" type="submit" name="aksi" value="Simpan" class="btn btn-success" ng-click="simpan()">Simpan</button>
                <button ng-show="method=='sunting'" type="submit" name="aksi" value="Sunting" class="btn btn-success" ng-click="sunting()">Sunting</button>
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="daftarSidang.html">
        <div ng-controller="daftarSidangController">
            <div class="row">
                <div class="col-md-12">
                    <a href="#/baru" class="btn btn-default">Buat Baru</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Jenis Sidang</th>
                                <th>Judul TA</th>
                                <th>Mahasiswa</th>
                                <th>Dosen Penguji</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in items">
                                <td>[[item.jenis_sidang]]</td>
                                <td>[[item.tugas_akhir.penawaran_judul.judul_tugas_akhir]]</td>
                                <td>[[item.tugas_akhir.mahasiswa.nama_lengkap]] ([[item.tugas_akhir.mahasiswa.nrp_mahasiswa]])</td>
                                <td>
                                    <span ng-repeat="penguji in item.penguji_sidang">
                                        [[penguji.pegawai.nama_lengkap]] </br>
                                    </span>
                                </td>
                                <td>[[item.waktu_mulai]]</td>
                                <td>[[item.waktu_selesai]]</td>
                                <td>
                                    <a href="#/sunting/[[item.id_sidang]]">Sunting</a>
                                    <a href="#/" ng-click="hapus([[item.id_sidang]])">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop
