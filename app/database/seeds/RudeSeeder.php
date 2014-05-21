<?php

use Simta\Models\Mahasiswa;
use Simta\Models\Pegawai;
use Simta\Models\Dosen;
use Simta\Models\Pos;
use Simta\Models\PemberitahuanMahasiswa;
use Simta\Models\PemberitahuanPegawai;
use Simta\Models\TugasAkhir;
use Simta\Models\Sidang;
use Simta\Models\Evaluasi;
use Simta\Models\Ruangan;
use Simta\Models\BidangMinat;
use Simta\Models\BidangKeahlian;
use Simta\Models\Panduan;
use Simta\Models\Topik;
use Simta\Models\TeknikMesin\SitIn;
use Simta\Models\PenawaranJudul;
use Simta\Models\Lampiran;
use Simta\Models\JenjangPendidikan;

class RudeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        $jenjang_pendidikan = JenjangPendidikan::find('S1');
        if ($jenjang_pendidikan == null)
        {
            $jenjang_pendidikan = new JenjangPendidikan;
            $jenjang_pendidikan->kode_jenjang_pendidikan = 'S1';
            $jenjang_pendidikan->save();
        }

        $ruangan = new Ruangan;
        $ruangan->kode_ruangan = $faker->unique->word;
        $ruangan->nama_ruangan = $faker->sentence();
        $ruangan->save();

        $bidang_minat = new BidangMinat;
        $bidang_minat->kode_bidang_minat = $faker->unique->word;
        $bidang_minat->nama_bidang_minat = $faker->sentence();
        $bidang_minat->deskripsi_bidang_minat = $faker->text();
        $bidang_minat->save();

        $bidang_keahlian = new BidangKeahlian;
        $bidang_keahlian->nama_bidang_keahlian = $faker->unique->word;
        $bidang_keahlian->deskripsi_bidang_keahlian = $faker->text();
        $bidang_keahlian->save();
        $bidang_keahlian->bidangMinat()->save($bidang_minat);

        $topik = new Topik;
        $topik->topik = $faker->unique->word;
        $topik->deskripsi = $faker->text();
        $topik->bidangKeahlian()->associate($bidang_keahlian);
        $topik->save();

        $counter = 0;

        for($i = 0; $i < 10; $i++)
        {
            $mahasiswa = Mahasiswa::create(
                array(
                    'nrp_mahasiswa' => $faker->unique->randomNumber(7),
                    'nama_lengkap' => $faker->name,
                    'kata_sandi' => Hash::make('password'),
                    'angkatan' => 2011,
                    'sks_tempuh' => 110,
                    'sks_lulus' => 95,
                    'aktif' => 1
                )
            );

            $mahasiswa->jenjangPendidikan()->associate($jenjang_pendidikan);
            $mahasiswa->save();

            for($j = 0; $j < 3; $j++)
            {
               $pemberitahuan = new PemberitahuanMahasiswa;
               $pemberitahuan->isi = $faker->sentence();
               $mahasiswa->pemberitahuan()->save($pemberitahuan);
            }

            $pegawai = new Pegawai;
            $pegawai->nip_pegawai = $faker->unique->randomNumber(7);
            $pegawai->nama_lengkap = $faker->name;
            $pegawai->kata_sandi = Hash::make('password');
            $pegawai->aktif = 1;
            $pegawai->save();


            if(rand(0,1) == 1) {
                $dosen = new Dosen;
                $dosen->nidn = $faker->unique->randomNumber(7);
                $dosen->hak_akses_pegawai = rand(0,1);
                $dosen->pegawai()->associate($pegawai);
                $dosen->gelar_depan = "Ir.";
                $dosen->gelar_belakang = "S.Kom.";
                $dosen->save();

                $bidang_minat->dosen()->save($dosen);
                $bidang_keahlian->dosen()->save($dosen);

                if($counter == 0)
                {
                    $bidang_minat->dosenKoordinator()->associate($dosen);
                    $dosen->save();
                    $bidang_minat->save();
                    $counter = 1;
                }

                // this one not belongs to any TugasAkhir
                $penawaran_judul1 = new PenawaranJudul;
                $penawaran_judul1->judul_tugas_akhir = $faker->sentence();
                $penawaran_judul1->deskripsi = $faker->text();
                $penawaran_judul1->topik()->associate($topik);
                $penawaran_judul1->dosen()->associate($dosen);
                $penawaran_judul1->save();

                // see TugasAkhir bellow to see its relationship
                $penawaran_judul = new PenawaranJudul;
                $penawaran_judul->judul_tugas_akhir = $faker->sentence();
                $penawaran_judul->deskripsi = $faker->text();
                $penawaran_judul->topik()->associate($topik);
                $penawaran_judul->dosen()->associate($dosen);
                $penawaran_judul->save();

                if(rand(0,1) == 1) 
                {

                }

                for($j = 0; $j < 3; $j++)
                {
                   $pemberitahuan = new PemberitahuanPegawai;
                   $pemberitahuan->isi = $faker->sentence();
                   $pemberitahuan->save();
                   $pegawai->pemberitahuan()->save($pemberitahuan);
                }

                for($j = 0; $j < 5; $j++)
                {
                    $pos = new Pos;
                    $pos->judul = $faker->sentence();
                    $pos->isi = $faker->text();
                    $pos->apakah_terbit = true;
                    $pos->save();
                    $dosen->pos()->save($pos);
                }

                for($j = 0; $j < 3; $j++)
                {
                    $panduan = new Panduan;
                    $panduan->judul_panduan = $faker->sentence();
                    $panduan->isi_panduan = $faker->text();
                    $panduan->pegawai()->associate($dosen->pegawai);
                    $panduan->save();

                    if(rand(0,1) == 1) 
                    {
                        $lampiran = new Lampiran;
                        $lampiran->nama_lampiran = $faker->word();
                        $lampiran->tipe_lampiran = 'url';
                        $lampiran->path_lampiran = 'http://www.google.com/';
                        $panduan->lampiran()->associate($lampiran);
                        $panduan->save();
                    }
                    else 
                    {
                        $lampiran = new Lampiran;
                        $lampiran->nama_lampiran = $faker->word();
                        $lampiran->tipe_lampiran = 'file';
                        $lampiran->path_lampiran = 'files/' . $panduan->pegawai->nip_pegawai . '/' . $lampiran->nama_lampiran;
                        $panduan->lampiran()->associate($lampiran);
                        $panduan->save();
                    }
                }

                if(rand(0,1) == 1) 
                {   
                    $ta = new TugasAkhir;
                    $ta->mahasiswa()->associate($mahasiswa);
                    $ta->tanggal_mulai = "2014-01-01";
                    $ta->tanggal_selesai = "2014-05-05";
                    $ta->status = "pra_diajukan";
                    $ta->topik()->associate($topik);
                    $ta->save();
                    $ta->dosenPembimbing()->save($dosen);
                    $ta->save();
                    $ta->penawaranJudul()->associate($penawaran_judul);
                    $ta->save();

                    if(rand(0,1) == 1) 
                    {
                        $sidang = new Sidang;
                        $sidang->jenis_sidang = "proposal";
                        $sidang->waktu_mulai = "2014-01-01 00:00:00";
                        $sidang->waktu_selesai = "2014-02-02 10:10:10";
                        $sidang->ruangan()->associate($ruangan);
                        $sidang->tugasAkhir()->associate($ta);
                        $sidang->save();

                        $penguji = Dosen::orderBy(DB::raw('RAND()'))->take(1)->get();
                        $penguji = $penguji[0];

                        $sidang->pengujiSidang()->save($penguji);
                        $sidang->save();

                        for($j = 0; $j < 2; $j++)
                        {
                            $evaluasi = new Evaluasi;
                            $evaluasi->jenis_penilaian = "Nilai Dosen";
                            $evaluasi->dosen()->associate($penguji);
                            $evaluasi->tugasAkhir()->associate($ta);
                            $evaluasi->nilai = rand(60,100);
                            $evaluasi->save();
                        }
                    }                    
                }
                else
                {
                    $sitin = new Sitin;
                    $sitin->disetujui = 0;
                    $sitin->mahasiswa()->associate($mahasiswa);
                    $sitin->dosen()->associate($dosen);
                    $sitin->topik()->associate($topik);
                    $sitin->save();
                }
            }
        }
    }

}
