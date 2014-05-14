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


        for($i = 0; $i < 10; $i++)
        {
            $mahasiswa = Mahasiswa::create(
                array(
                    'nrp_mahasiswa' => $faker->unique->randomNumber(12),
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
            $pegawai->nip_pegawai = $faker->unique->randomNumber(12);
            $pegawai->nama_lengkap = $faker->name;
            $pegawai->kata_sandi = Hash::make('password');
            $pegawai->save();


            if(rand(0,1) == 1) {
                $dosen = new Dosen;
                $dosen->nidn = $faker->unique->randomNumber(20);
                $dosen->gelar = "Lektor";
                $pegawai->dosen()->save($dosen);
                $dosen->save();

                for($j = 0; $j < 3; $j++)
                {
                   $pemberitahuan = new PemberitahuanDosen;
                   $pemberitahuan->isi = $faker->sentence();
                   $dosen->pemberitahuan()->save($pemberitahuan);

                }


                for($j=0; $j<5; $j++)
                {
                    $pos = new Pos;
                    $pos->kategori = "Penawaran";
                    $pos->kata_kunci = "Sembarang";
                    $pos->judul = $faker->sentence();
                    $pos->isi = $faker->text();
                    $dosen->pos()->save($pos);
                }

                $ta = new TugasAkhir;
                $ta->judul = $faker->sentence();
                $ta->mahasiswa()->associate($mahasiswa);
                $ta->tanggal_mulai = "2014-01-01";
                $ta->tanggal_selesai = "2014-05-05";
                $ta->status = "pra_diajukan";
                $ta->bidangMinat()->associate($bidang_minat);
                $ta->save();
                $ta->dosenPembimbing()->save($dosen);
                $ta->save();

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
