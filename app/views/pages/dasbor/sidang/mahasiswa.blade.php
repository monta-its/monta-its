@extends('layouts.dasbor')
@section('page_title')
Kelola Pengajuan Sidang
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
                    $http.get('{{URL::to('/dasbor/umum/pegawai/sesi_sidang')}}').success(function(data) {
                        $rootScope.sesiSidang = data;
                        $http.get('{{URL::to('/dasbor/umum/mahasiswa/')}}?mySelf=true').success(function(data) {
                            $rootScope.mahasiswa = data;
                            if(callback) callback();
                        });
                    });
                });
            });

        });

    });



};

var updateDosenUp = function($rootScope, $http, id_bidang_minat, hari, sesi, callback) {
    $http.get('{{URL::to('/dasbor/pengguna/dosen')}}?hari=' + String(hari) + '&sesi=' + String(sesi) + '&bidangMinat=' + JSON.stringify(id_bidang_minat)).success(function(data){
        $rootScope.dosen = data;
        if(callback) callback();
    });
}


app.controller('daftarSidangController', function($scope, $http, $rootScope) {
    $scope.hapus = function(id_sidang) {
        if(confirm("Yakin untuk menghapus ini?")) {
            $http.delete('{{URL::to('/dasbor/mahasiswa/sidang')}}', {'params': {'id_sidang': String(id_sidang)}}).success(function(data) {
                update($rootScope, $http);
                alert('Pengajuan Sidang dihapus');
            });
        }
    };
});

app.controller('sidangSuntingController', function($rootScope, $scope, $http, $routeParams, $location) {
    $scope.jenisSidang = [];
    $scope.sidang = {};
    var method = $routeParams.method;
    $scope.updateDosen = function() {
        var id_bidang_minat = [];
        var sesi = $scope.sidang.sesi;

        var hari = (new Date($scope.sidang.tanggal)).getDay();

        $.each($scope.sidang.tugasAkhir.penawaran_judul.topik.bidang_keahlian.bidang_minat, function(i, val) {
            id_bidang_minat.push(val.id_bidang_minat)
        });

        updateDosenUp($rootScope, $http, id_bidang_minat, hari, sesi);
    };

    $scope.method = method;
    $scope.updateJenisSidang = function() {
        if($rootScope.mahasiswa.lolos_syarat_seminar_proposal == true) {
            $scope.jenisSidang.push({jenis: "proposal", nama: "Seminar Proposal"});
        }

        if($rootScope.mahasiswa.lolos_syarat_sidang_akhir == true) {
            $scope.jenisSidang.push({jenis: "akhir", nama: "Sidang Akhir"});
        }

        if($scope.jenisSidang.length == 0) {
            alert('Anda belum lulus syarat Seminar Proposal atau Sidang Akhir');
            $location.path('/');
        }
    }
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
        update($rootScope, $http, function() {
            $scope.updateJenisSidang();
            $scope.sidang.tugasAkhir = {};
            $scope.sidang.pengujiSidang = [];
            $scope.sidang.ruangan = {};
            $scope.sidang.jenis_sidang = "akhir";

            var date = new Date();
            $scope.sidang.tanggal = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate();

            if($rootScope.sesiSidang.length > 0) {
                $scope.sidang.sesi = $rootScope.sesiSidang[0].sesi;
            } else {
                alert('Jadwal Sesi Sidang belum didefinisikan, hubungi Pegawai untuk info lebih lanjut.');
                $location.path('/');
            }
        });
        $scope.simpan = function() {
            if($scope.sidang.pengujiSidang.length == 4) {
                $http.post("{{{URL::to('/dasbor/mahasiswa/sidang')}}}", $scope.sidang).success(function(data) {
                    alert('Pengajuan baru dibuat.');
                    $location.path("/");
                    update($rootScope, $http);
                });
            } else {
                alert('Jumlah Dosen Penguji harus berjumlah (empat) orang.');
            }
        };
    } else if (method == "sunting") {
        if($routeParams.id) {
            $scope.sunting = function() {
                // Cek jumlah pengujiSidang apakah 4
                if($scope.sidang.pengujiSidang.length == 4) {
                    $http.put("{{{URL::to('/dasbor/mahasiswa/sidang')}}}", $scope.sidang).success(function(data) {
                        alert('Penyuntingan berhasil');
                        $location.path("/");
                        update($rootScope, $http);
                    });
                } else {
                    alert('Jumlah Dosen Penguji harus berjumlah (empat) orang.');
                }
            }
            $scope.sidang.pengujiSidang = [];
            update($rootScope, $http, function() {
                $scope.updateJenisSidang();
                $.each($rootScope.items, function(i, val) {
                    if(val.id_sidang == $routeParams.id) {
                        $scope.sidang.id_sidang  = val.id_sidang
                        $scope.sidang.jenis_sidang = val.jenis_sidang;
                        $scope.sidang.sesi = val.sesi;
                        $scope.sidang.tanggal = val.tanggal;
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
<div ng-app="dasborSidang">
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
                    <select class="form-control" ng-model="sidang.tugasAkhir" ng-options="item as item.penawaran_judul.judul_tugas_akhir for item in tugasAkhir" ng-change="updateDosen()" ></select>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" size="10" class="form-control" ng-model="sidang.tanggal" data-time-type="string" date-time-format="yyyy-MM-dd" data-autoclose="1" ng-change="updateDosen()" bs-datepicker>
                </div>
                <div class="form-group">
                    <label>Sesi Sidang</label>
                    <select class="form-control" ng-model="sidang.sesi" ng-options="item.sesi as (item.waktu_mulai + ' - ' + item.waktu_selesai) for item in sesiSidang" ng-change="updateDosen()"></select>
                </div>
                <div class="form-group">
                    <label>Ruangan</label>
                    <select class="form-control" ng-model="sidang.ruangan" ng-options="item as item.nama_ruangan for item in ruangan" ></select>
                </div>
                <div class="form-group">
                    <label>Dosen Penguji</label>
                    <div class="panel panel-default">
                        <form role="form" ng-submit="tambahDosenPenguji()">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" ng-options="item.nip_dosen as item.nip_dosen + ' - ' + item.pegawai.nama_lengkap for item in dosen" ng-model="dosenPengujiDipilih" class="form-control" placeholder="Masukkan NIP/Nama Dosen" bs-typeahead />
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Penguji</button>
                                
                            </div>
                            <table class="table table-condensed table-striped">
                                <thead ng-show="sidang.pengujiSidang.length != 0">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Dosen</th>
                                        <th class="text-center">NIP</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in sidang.pengujiSidang">
                                        <td class="col-md-2 text-center">[[$index + 1]].</td>
                                        <td>[[item.pegawai.nama_lengkap]]</td>
                                        <td class="col-md-4 text-center">[[item.nip_dosen]]</td>
                                        <td class="col-md-2 text-center"><button ng-click="hapusDosenPenguji([[item.nip_dosen]])" class="btn btn-xs btn-danger">Hapus</button></td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <br />
                    <div ng-repeat="item in items">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span ng-show="item.jenis_sidang == 'proposal'">Seminar Proposal</span>
                                <span ng-show="item.jenis_sidang == 'akhir'">Sidang Akhir</span>
                                <div class="btn-toolbar pull-right">
                                    <div class="btn-group">
                                        <a href="#/" ng-click="hapus([[item.id_sidang]])" class="btn btn-xs btn-danger pull-right">Hapus</a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="#/sunting/[[item.id_sidang]]" class="btn btn-xs btn-default pull-right">Sunting</a>     
                                    </div>
                                </div>
                            </div>
                            <table class="table table-condensed table-striped">
                                <tbody>
                                    <tr>
                                        <td class="col-md-2"><strong>Judul TA</strong></td>
                                        <td>[[item.tugas_akhir.penawaran_judul.judul_tugas_akhir]]</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><strong>Mahasiswa</strong></td>
                                        <td>[[item.tugas_akhir.mahasiswa.nama_lengkap]] ([[item.tugas_akhir.mahasiswa.nrp_mahasiswa]])</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><strong>Dosen Penguji</strong></td>
                                        <td>
                                            <span ng-repeat="penguji in item.penguji_sidang">
                                                <a href="{{ URL::to('/dosen/') }}/[[penguji.nip_dosen]]" title="">[[penguji.pegawai.nama_lengkap]]</a><span ng-show="!$last"> · </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><strong>Sesi</strong></td>
                                        <td>ke-[[item.sesi_sidang.sesi]]: pukul [[item.sesi_sidang.waktu_mulai]] - [[item.sesi_sidang.waktu_selesai]] WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><strong>Status</strong></td>
                                        <td ng-show="item.disetujui == -1">Ditolak</td>
                                        <td ng-show="item.disetujui == 0">Diajukan</td>
                                        <td ng-show="item.disetujui == 1">Disetujui</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>
</div>
@stop

@section('scripts')
    @include('includes.dasbor.scripts')
@stop