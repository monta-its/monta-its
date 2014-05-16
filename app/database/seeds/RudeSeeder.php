<?php

use Simta\Models\Mahasiswa;
use Simta\Models\Pegawai;
use Simta\Models\Dosen;
use Simta\Models\Pos;
use Simta\Models\PemberitahuanMahasiswa;
use Simta\Models\PemberitahuanDosen;
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

class RudeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $faker = Faker\Factory::create();

        $ruangan = new Ruangan;
        $ruangan->kode_ruangan = $faker->unique->word;
        $ruangan->save();

        $bidang_minat = new BidangMinat;
        $bidang_minat->kode_bidang_minat = $faker->unique->word;
        $bidang_minat->save();

        $bidang_keahlian = new BidangKeahlian;
        $bidang_keahlian->nama_bidang_keahlian = $faker->unique->word;
        $bidang_keahlian->save();

        $topik = new Topik;
        $topik->topik = $faker->unique->word;
        $topik->deskripsi = $faker->sentence();
        $topik->bidangMinat()->associate($bidang_minat);
        $topik->save();


        for($i = 0; $i < 10; $i++)
        {
            $mahasiswa = Mahasiswa::create(
                array(
                    'nrp_mahasiswa' => $faker->unique->randomNumber(7),
                    'nama_lengkap' => $faker->name,
                    'kata_sandi' => Hash::make('password'),
                    'angkatan' => 2011
                )
            );

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
            $pegawai->save();


            if(rand(0,1) == 1) {
                $dosen = new Dosen;
                $dosen->nidn = $faker->unique->randomNumber(7);
                $dosen->gelar = "Lektor";
                $dosen->hak_akses_pegawai = rand(0,1);
                $pegawai->dosen()->save($dosen);
                $dosen->bidangKeahlian()->save($bidang_keahlian);
                $dosen->save();

                $penawaran_judul = new PenawaranJudul;
                $penawaran_judul->judul = $faker->sentence();
                $penawaran_judul->deskripsi = $faker->text();
                $penawaran_judul->topik()->associate($topik);
                $penawaran_judul->dosen()->associate($dosen);
                $penawaran_judul->save();

                for($j = 0; $j < 3; $j++)
                {
                   $pemberitahuan = new PemberitahuanDosen;
                   $pemberitahuan->isi = $faker->sentence();
                   $pemberitahuan->save();
                   $dosen->pemberitahuan()->save($pemberitahuan);

                }


                for($j=0; $j<5; $j++)
                {
                    $pos = new Pos;
                    $pos->judul = $faker->sentence();
                    $pos->isi = $faker->text();
                    $pos->save();
                    $dosen->pos()->save($pos);
                }

                for($j=0; $j<3; $j++)
                {
                    $panduan = new Panduan;
                    $panduan->judul = $faker->sentence();
                    $panduan->isi = $faker->text();
                    $panduan->save();
                    $dosen->panduan()->save($pos);
                    $dosen->save();

                }

                $ta = new TugasAkhir;
                $ta->judul = $faker->sentence();
                $ta->mahasiswa()->associate($mahasiswa);
                $ta->tanggal_mulai = "2014-01-01";
                $ta->tanggal_selesai = "2014-05-05";
                $ta->status = "pra_diajukan";
                $ta->topik()->associate($topik);
                $ta->save();
                $ta->dosenPembimbing()->save($dosen);
                $ta->save();

                $sitin = new Sitin;
                $sitin->mahasiswa()->associate($mahasiswa);
                $sitin->dosen()->associate($dosen);
                $sitin->topik()->associate($topik);
                $sitin->save();

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

                for($j=0; $j<2; $j++)
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
	}

}
