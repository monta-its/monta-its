<?php

use Simta\Models\Mahasiswa;
use Simta\Models\Pegawai;
use Simta\Models\Dosen;
use Simta\Models\Pos;
use Simta\Models\Pemberitahuan;
use Simta\Models\TugasAkhir;
use Simta\Models\Sidang;
use Simta\Models\NilaiAkhir;
use Simta\Models\NilaiProposal;
use Simta\Models\Ruangan;
use Simta\Models\BidangMinat;
use Simta\Models\BidangKeahlian;
use Simta\Models\Panduan;
use Simta\Models\TeknikMesin\SitIn;
use Simta\Models\PenawaranJudul;
use Simta\Models\Lampiran;
use Simta\Models\JenjangPendidikan;
use Simta\Models\Syarat;
use Simta\Models\Pengaturan;
use Simta\Models\StatusTugasAkhir;
use Simta\Models\BerkasTugasAkhir;
use Simta\Models\SesiSidang;
use Simta\Models\JadwalDosen;
use Simta\Models\User;
use Simta\Models\Group;

class RudeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection()->disableQueryLog();

        $faker = Faker\Factory::create();

        try
        {
            StatusTugasAkhir::create(array('nilai' => 'pengerjaan', 'nama' => 'Pengerjaan'));
            StatusTugasAkhir::create(array('nilai' => 'siap_seminar', 'nama' => 'Siap Seminar'));
            StatusTugasAkhir::create(array('nilai' => 'siap_sidang', 'nama' => 'Siap Sidang'));
            StatusTugasAkhir::create(array('nilai' => 'revisi_proposal', 'nama' => 'Revisi Proposal'));
            StatusTugasAkhir::create(array('nilai' => 'revisi_akhir', 'nama' => 'Revisi Akhir'));
            StatusTugasAkhir::create(array('nilai' => 'selesai', 'nama' => 'Selesai'));
            StatusTugasAkhir::create(array('nilai' => 'mengundurkan_diri', 'nama' => 'Mengundurkan Diri'));
        }
        catch (Exception $e)
        {

        }

        // SesiSidang
        try
        {
            SesiSidang::create(array('sesi' => '1', 'waktu_mulai' => '08:00', 'waktu_selesai' => '12:00'));
            SesiSidang::create(array('sesi' => '2', 'waktu_mulai' => '13:00', 'waktu_selesai' => '17:00'));
            SesiSidang::create(array('sesi' => '3', 'waktu_mulai' => '18:30', 'waktu_selesai' => '22:30'));
        }
        catch (Exception $e)
        {

        }

        while(Syarat::where('waktu_syarat', '=', 'pra_sit_in')->count() < 4)
        {
            try
            {
                Syarat::create(array(
                    'kode_syarat' => $faker->unique->word,
                    'nama_syarat' => $faker->unique->word,
                    'waktu_syarat' => 'pra_sit_in',
                    'jenis_mahasiswa' => 'reguler'
                ));
            } catch (Exception $e)
            {

            }

        }
                                                echo "checkpoint 86\n";

        while(Syarat::where('waktu_syarat', '=', 'pra_bimbingan')->count() < 4)
        {
            try
            {
                Syarat::create(array(
                    'kode_syarat' => $faker->unique->word,
                    'nama_syarat' => $faker->unique->word,
                    'waktu_syarat' => 'pra_bimbingan',
                    'jenis_mahasiswa' => 'reguler'
                ));
            }
            catch (Exception $e)
            {

            }

        }

        while(Syarat::where('waktu_syarat', '=', 'pra_seminar_proposal')->count() < 4)
        {
            try
            {
                Syarat::create(array(
                    'kode_syarat' => $faker->unique->word,
                    'nama_syarat' => $faker->unique->word,
                    'waktu_syarat' => 'pra_seminar_proposal',
                    'jenis_mahasiswa' => 'reguler'
                ));
            }
            catch (Exception $e)
            {

            }

        }
                                                echo "checkpoint 122\n";

        while(Syarat::where('waktu_syarat', '=', 'pra_sidang_akhir')->count() < 4)
        {
            try
            {
                Syarat::create(array(
                    'kode_syarat' => $faker->unique->word,
                    'nama_syarat' => $faker->unique->word,
                    'waktu_syarat' => 'pra_sidang_akhir',
                    'jenis_mahasiswa' => 'reguler'
                ));
            }
            catch (Exception $e)
            {

            }
        }

        $syaratSitIn = Syarat::where('waktu_syarat', '=', 'pra_sit_in')->get();
        $syaratBimbingan = Syarat::where('waktu_syarat', '=', 'pra_bimbingan')->get();
        $syaratSeminar = Syarat::where('waktu_syarat', '=', 'pra_seminar_proposal')->get();
        $syaratSidang = Syarat::where('waktu_syarat', '=', 'pra_sidang_akhir')->get();

        $jenjang_pendidikan = JenjangPendidikan::find('S1');
        if ($jenjang_pendidikan == null)
        {
            $jenjang_pendidikan = new JenjangPendidikan;
            $jenjang_pendidikan->kode_jenjang_pendidikan = 'S1';
            $jenjang_pendidikan->save();
        }
                                                echo "checkpoint 152\n";

        for($i=0; $i<5; $i++)
        {
            try
            {
                $pengaturan = new Pengaturan;
                $pengaturan->nama = $faker->unique->word;
                $pengaturan->nilai = $faker->word;
                $pengaturan->deskripsi = $faker->sentence();
                $pengaturan->save();
            }
            catch (Exception $e)
            {

            }
        }

        $ruangan = new Ruangan;
        $ruangan->kode_ruangan = $faker->unique->word;
        $ruangan->nama_ruangan = $faker->sentence();
        $ruangan->save();

        /*
        BidangMinat::create(
            'nama_bidang_minat' => 'Mekanika & Mesin Fluida',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Mekanika Benda Padat',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Metalurgi',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Otomasi Industri',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Otomotif',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Perancangan & Pengembangan Produk',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Proses Manufaktur',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Sistem Manufaktur',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Teknik Cor',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Teknik Pembakaran & Bahan Bakar',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Thermodinamika & Perpindahan Panas',
            'deskripsi_bidang_minat' => ''
        );
        BidangMinat::create(
            'nama_bidang_minat' => 'Vibrasi & Sistem Dinamis',
            'deskripsi_bidang_minat' => ''
        );
        */
                                                echo "checkpoint 224\n";

        $bidang_minat = new BidangMinat;
        $bidang_minat->kode_bidang_minat = $faker->unique->word;
        $bidang_minat->nama_bidang_minat = $faker->sentence();
        $bidang_minat->deskripsi_bidang_minat = $faker->text();
        $bidang_minat->save();

        $bidang_keahlian = new BidangKeahlian;
        $bidang_keahlian->nama_bidang_keahlian = $faker->unique->word;
        $bidang_keahlian->deskripsi_bidang_keahlian = $faker->text();
        $bidang_keahlian->bidangMinat()->associate($bidang_minat);
        $bidang_keahlian->save();
        $counter = 0;

        $mhsGroup = Group::with('user')->where('name_group', '=', 'mahasiswa')->first();
        $dosenGroup = Group::with('user')->where('name_group', '=', 'dosen')->first();
        $pegawaiGroup = Group::with('user')->where('name_group', '=', 'pegawai')->first();
        $mhsUser = $mhsGroup->user;
        $dosenUser = $dosenGroup->user;
        $pegawaiUser = $pegawaiGroup->user;
                                                echo "checkpoint 245\n";

        $mhsUser_index = 0;
        $dosenUser_index = 0;
        $pegawaiUser_index = 0;

        for($i = 0; $i < 10; $i++)
        {
            $mahasiswa = Mahasiswa::create(
                array(
                    'nrp' => $faker->unique->randomNumber(7),
                    'nama_lengkap' => $faker->name,
                    'angkatan' => 2011,
                    'sks_tempuh' => 110,
                    'sks_lulus' => 95,
                )
            );

            $mahasiswa->user()->save($mhsUser[$mhsUser_index++]);

            $mahasiswa->jenjangPendidikan()->associate($jenjang_pendidikan);
            $mahasiswa->save();

            for($j = 0; $j < 3; $j++)
            {
               $pemberitahuan = new Pemberitahuan;
               $pemberitahuan->isi = $faker->sentence();
               $mahasiswa->pemberitahuan()->save($pemberitahuan);
            }
                                                echo "checkpoint 276\n";

            /**
             * PEGAWAI
             */
            
            $pegawai = new Pegawai;
            $pegawai->nip = $faker->unique->randomNumber(7);
            $pegawai->nama_lengkap = $pegawaiUser[$pegawaiUser_index]->name_user;
            $pegawai->save();
            $pegawai->user()->save($pegawaiUser[$pegawaiUser_index++]);
            $pegawai->save();

            /**
             * DOSEN
             */

            $dosen = new Dosen;
            $dosen->nama_lengkap = $dosenUser[$dosenUser_index]->name_user;
            $dosen->nip = $faker->unique->randomNumber(7);
            $dosen->nidn = $faker->unique->randomNumber(7);
            $dosen->gelar_depan = "Ir.";
            $dosen->gelar_belakang = "S.Kom.";
            $dosen->save();
            $dosen->user()->save($dosenUser[$dosenUser_index++]);
            $dosen->bidangMinat()->associate($bidang_minat);
            $dosen->bidangKeahlian()->save($bidang_keahlian);
            $dosen->save();

            $nip = $dosen->nip;
            unset($dosen);
            $dosen = Dosen::find($nip);

            for($k=0; $k<5; $k++)
            {
                $jadwalDosen = new JadwalDosen;
                $jadwalDosen->hari = rand(1,5);
                $jadwalDosen->sesi = rand(1,SesiSidang::count());
                $jadwalDosen->apakah_tersedia = rand(0,1);
                $jadwalDosen->dosen()->associate($dosen);
                $jadwalDosen->save();
            }

            if($counter == 0)
            {
                $bidang_minat->dosenKoordinator()->associate($dosen);
                $bidang_minat->save();
                $counter = 1;
            }

            // this one not belongs to any TugasAkhir
            $penawaran_judul = new PenawaranJudul;
            $penawaran_judul->judul_tugas_akhir = $faker->sentence();
            $penawaran_judul->deskripsi = $faker->sentence();
            $penawaran_judul->dosen()->associate($dosen);
            $penawaran_judul->bidangKeahlian()->associate($bidang_keahlian);
            $penawaran_judul->save();
                                            echo "checkpoint 310\n";
            // see TugasAkhir bellow to see its relationship
            $penawaran_judul = new PenawaranJudul;
            $penawaran_judul->judul_tugas_akhir = $faker->sentence();
            $penawaran_judul->deskripsi = $faker->sentence();
            $penawaran_judul->dosen()->associate($dosen);
            $penawaran_judul->bidangKeahlian()->associate($bidang_keahlian);
            $penawaran_judul->save();
                                            echo "checkpoint 317\n";
            for($j = 0; $j < 3; $j++)
            {
               $pemberitahuan = new Pemberitahuan;
               $pemberitahuan->isi = $faker->sentence();
               $pemberitahuan->save();
               $dosen->pemberitahuan()->save($pemberitahuan);
            }
                                            echo "checkpoint 325\n";
            for($j = 0; $j < 5; $j++)
            {
                $pos = new Pos;
                $pos->judul = $faker->sentence();
                $pos->isi = $faker->text();
                $pos->apakah_terbit = true;
                $pos->save();
                $dosen->pos()->save($pos);
            }

            echo "checkpoint 358\n";

            $nip = $dosen->nip;
            unset($dosen);
            $dosen = Dosen::find($nip);

            for($j = 0; $j < 3; $j++)
            {
                $panduan = new Panduan;
                $panduan->judul_panduan = $faker->sentence();
                $panduan->isi_panduan = $faker->text();
                $panduan->save();
                $dosen->panduan()->save($panduan);

                echo "checkpoint 368\n";

                $lampiran = new Lampiran;
                if(rand(0,1) == 1)
                {
                    $lampiran->nama_lampiran = $faker->word();
                    $lampiran->tipe_lampiran = 'url';
                    $lampiran->path_lampiran = 'http://www.google.com/';
                }
                else
                {
                    $lampiran->nama_lampiran = $faker->word();
                    $lampiran->tipe_lampiran = 'file';
                    $lampiran->path_lampiran = 'files/' . $dosen->nip . '/' . $lampiran->nama_lampiran;
                }

                echo "checkpoint 384\n";
                $lampiran->save();
                $panduan->id_lampiran = $lampiran->id_lampiran;
                $panduan->save();
                // $lampiran->person()->associate($dosen);
                $dosen->lampiran()->save($lampiran);
                $lampiran->save();

                echo "checkpoint 391\n";
            }
                                            echo "checkpoint 363\n";

            $acak = rand(0,2);
            if($acak == 1)
            {
                foreach ($syaratSitIn as $syarat) {
                    $mahasiswa->syarat()->save($syarat);
                }

                foreach ($syaratBimbingan as $syarat) {
                    $mahasiswa->syarat()->save($syarat);
                }

                $ta = new TugasAkhir;
                $ta->mahasiswa()->associate($mahasiswa);
                $ta->tanggal_mulai = "2014-01-01";
                $ta->tanggal_selesai = "2014-05-05";
                $ta->target_selesai = "2014-08-08";
                $ta->status = "pengerjaan";
                $ta->save();
                $ta->dosenPembimbing()->save($dosen);
                $ta->save();
                $ta->penawaranJudul()->associate($penawaran_judul);
                $ta->save();

                $berkas = new BerkasTugasAkhir;
                $berkas->nama_berkas = $faker->word();
                $berkas->path = '/'.$faker->word();
                $berkas->save();
                $ta->berkas()->save($berkas);
                                            echo "checkpoint 392\n";
                if(rand(0,1) == 1)
                {
                    foreach ($syaratSeminar as $syarat) {
                        $mahasiswa->syarat()->save($syarat);
                    }

                    $seminar = new Sidang;
                    $seminar->jenis_sidang = "proposal";
                    $seminar->sesi = rand(1,SesiSidang::count());
                    $seminar->tanggal = "2014-12-12";
                    $seminar->disetujui = 1;
                    $seminar->ruangan()->associate($ruangan);
                    $seminar->tugasAkhir()->associate($ta);
                    $seminar->save();

                    if ($seminar->disetujui == 1)
                    {
                        for($j = 0; $j < 4; $j++)
                        {
                            $penguji = Dosen::orderBy(DB::raw('RAND()'))->take(1)->get();
                            $penguji = $penguji[0];

                            $seminar->pengujiSidang()->save($penguji);
                            $seminar->save();

                            $nilaiProposal = new NilaiProposal;
                            $nilaiProposal->dosen()->associate($penguji);
                            $nilaiProposal->tugasAkhir()->associate($ta);
                            $nilaiProposal->nilai = rand(60,100);
                            $nilaiProposal->save();
                        }

                        if(rand(2,3) == 2)
                        {
                            foreach ($syaratSidang as $syarat) {
                                $mahasiswa->syarat()->save($syarat);
                            }

                            $sidang = new Sidang;
                            $sidang->jenis_sidang = "akhir";
                            $sidang->sesi = rand(1,SesiSidang::count());
                            $sidang->tanggal = "2014-12-30";
                            $sidang->disetujui = 1;
                            $sidang->ruangan()->associate($ruangan);
                            $sidang->tugasAkhir()->associate($ta);
                            $sidang->save();
                                            echo "checkpoint 439\n";
                            if ($sidang->disetujui == 1)
                            {
                                for($j = 0; $j < 4; $j++)
                                {
                                    $penguji = Dosen::orderBy(DB::raw('RAND()'))->take(1)->get();
                                    $penguji = $penguji[0];

                                    $sidang->pengujiSidang()->save($penguji);
                                    $sidang->save();

                                    $nilaiAkhir = new NilaiAkhir;
                                    $nilaiAkhir->dosen()->associate($penguji);
                                    $nilaiAkhir->tugasAkhir()->associate($ta);
                                    $nilaiAkhir->nilai = rand(60,100);
                                    $nilaiAkhir->save();
                                }
                            }
                        }
                    }
                }
            }
            else if ($acak == 0)
            {
                foreach ($syaratSitIn as $syarat) {
                    $mahasiswa->syarat()->save($syarat);
                }

                $sitin = new SitIn;
                $sitin->status = 0;
                $sitin->mahasiswa()->associate($mahasiswa);
                $sitin->dosen()->associate($dosen);
                $sitin->save();
            }

        }

        DB::connection()->enableQueryLog();
    }

}
