<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstDdl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mahasiswa', function($table)
        {
            $table->string('nrp')->primary();
            $table->string('nama_lengkap')->index();
            $table->integer('angkatan');
            $table->integer('sks_tempuh');
            $table->integer('sks_lulus');
            $table->string('kode_jenjang_pendidikan');
            
            

        });

        Schema::create('jenjang_pendidikan', function($table)
        {
            $table->string('kode_jenjang_pendidikan')->primary();
            $table->string('nama_jenjang_pendidikan');
            
            
        });

        Schema::create('pegawai', function($table) {
            $table->string('nip')->primary();
            $table->string('nama_lengkap')->index();
            
            
        });

        Schema::create('dosen', function($table)
        {
            $table->string('nip')->primary();
            $table->string('nidn')->unique();
            $table->string('nama_lengkap');
            $table->integer('id_bidang_minat');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            
            
        });

        Schema::create('ruangan', function($table)
        {
            $table->increments('id_ruangan');
            $table->string('kode_ruangan');
            $table->string('nama_ruangan');
            
            
        });

        Schema::create('tugas_akhir', function($table)
        {
            $table->increments('id_tugas_akhir');
            $table->integer('id_penawaran_judul');
            $table->integer('id_bidang_keahlian');
            $table->string('nrp')->index();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('target_selesai');
            $table->string('status');
            
            
        });

        Schema::create('nilai_proposal', function($table)
        {
            $table->increments('id_nilai_proposal');
            $table->integer('nilai');
            $table->string('nip')->index();
            $table->integer('id_tugas_akhir');
            
            
        });

        Schema::create('nilai_akhir', function($table)
        {
            $table->increments('id_nilai_akhir');
            $table->integer('nilai');
            $table->string('nip')->index();
            $table->integer('id_tugas_akhir');
            
            
        });

        Schema::create('dosen_pembimbing', function($table)
        {
            $table->increments('id_dosen_pembimbing');
            $table->integer('id_tugas_akhir');
            $table->string('nip')->index();
            
            
        });

        Schema::create('sidang', function($table)
        {
            $table->increments('id_sidang');
            $table->integer('id_tugas_akhir');
            $table->enum('jenis_sidang', array('proposal', 'akhir'));
            $table->date('tanggal');
            $table->integer('sesi');
            $table->integer('disetujui');
            $table->integer('id_ruangan');
            
            
        });

        Schema::create('penguji_sidang', function($table)
        {
            $table->increments('id_penguji_sidang');
            $table->integer('id_sidang');
            $table->string('nip')->index();
            
            
        });

        Schema::create('bidang_minat', function($table)
        {
            $table->increments('id_bidang_minat');
            $table->string('kode_bidang_minat');
            $table->string('nama_bidang_minat');
            $table->text('deskripsi_bidang_minat');
            $table->string('nip_koordinator');
            
            
        });

        Schema::create('pos', function($table)
        {
            $table->increments('id_pos');
            $table->string('person_id')->index();
            $table->string('person_type');
            $table->string('judul');
            $table->text('isi');
            $table->boolean('apakah_terbit');
            
            
        });

        Schema::create('panduan', function($table)
        {
            $table->increments('id_panduan');
            $table->string('person_id')->index();
            $table->string('person_type');
            $table->string('judul_panduan');
            $table->text('isi_panduan');
            $table->integer('id_lampiran');
            
            
        });

        Schema::create('lampiran', function($table)
        {
            $table->increments('id_lampiran');
            $table->string('nama_lampiran');
            $table->enum('tipe_lampiran', array('file', 'url'));
            $table->string('path_lampiran');
            $table->string('person_id')->index();
            $table->string('person_type');
            
            
        });

        Schema::create('penawaran_judul', function($table) {
            $table->increments('id_penawaran_judul');
            $table->integer('id_bidang_keahlian');
            $table->string('nip')->index();
            $table->string('judul_tugas_akhir');
            $table->text('deskripsi');
            
            
        });

        Schema::create('bidang_keahlian', function($table) {
            $table->increments('id_bidang_keahlian');
            $table->integer('id_bidang_minat');
            $table->string('nama_bidang_keahlian');
            $table->string('deskripsi_bidang_keahlian');
            
            
        });

        Schema::create('bidang_keahlian_dosen', function($table) {
            $table->increments('id_bidang_keahlian_dosen');
            $table->integer('id_bidang_keahlian')->index();
            $table->string('nip')->index();
            
            
        });

        Schema::create('pemberitahuan', function($table)
        {
            $table->increments('id_pemberitahuan');
            $table->string('person_id')->index();
            $table->string('person_type');
            $table->string('isi');
            
            
        });

        Schema::create('syarat', function($table)
        {
            $table->increments('id_syarat');
            $table->string('kode_syarat')->unique();
            $table->string('nama_syarat');
            $table->enum('waktu_syarat', array('pra_sit_in', 'pra_bimbingan', 'pra_seminar_proposal', 'pra_sidang_akhir'));
            $table->enum('jenis_mahasiswa', array('reguler', 'lintas_jalur'));
            
            
        });

        Schema::create('syarat_mahasiswa', function($table) {
            $table->increments('id_syarat_mahasiswa');
            $table->integer('id_syarat');
            $table->string('nrp')->index();
            
            
        });

        Schema::create('sessions', function($table)
        {
            $table->string('id')->unique();
            $table->text('payload');
            $table->integer('last_activity');
        });

        Schema::create('pengaturan', function($table)
        {
            $table->string('nama')->primary();
            $table->string('nilai');
            $table->text('deskripsi');
            
            
        });

        Schema::create('status_tugas_akhir', function($table)
        {
            $table->string('nilai')->primary();
            $table->string('nama');
            
        });

        Schema::create('berkas_tugas_akhir', function($table)
        {
            $table->increments('id_berkas_tugas_akhir');
            $table->integer('id_tugas_akhir');
            $table->string('nama_berkas');
            $table->enum('jenis_berkas', array('proposal', 'akhir', 'lainnya'));
            $table->string('path');
            
            
        });

        Schema::create('sesi_sidang', function($table)
        {
            $table->integer('sesi')->primary();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            
            
        });

        Schema::create('jadwal_dosen', function($table)
        {
            $table->increments('id_jadwal_dosen');
            $table->string('nip')->index();
            $table->integer('hari');
            $table->integer('sesi');
            $table->integer('apakah_tersedia');
            
            
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('jenjang_pendidikan');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('ruangan');
        Schema::dropIfExists('tugas_akhir');
        Schema::dropIfExists('nilai_proposal');
        Schema::dropIfExists('nilai_akhir');
        Schema::dropIfExists('dosen_pembimbing');
        Schema::dropIfExists('sidang');
        Schema::dropIfExists('penguji_sidang');
        Schema::dropIfExists('bidang_minat');
        Schema::dropIfExists('pos');
        Schema::dropIfExists('panduan');
        Schema::dropIfExists('lampiran');
        Schema::dropIfExists('penawaran_judul');
        Schema::dropIfExists('bidang_keahlian');
        Schema::dropIfExists('bidang_keahlian_dosen');
        Schema::dropIfExists('pemberitahuan');
        Schema::dropIfExists('syarat');
        Schema::dropIfExists('syarat_mahasiswa');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('pengaturan');
        Schema::dropIfExists('status_tugas_akhir');
        Schema::dropIfExists('berkas_tugas_akhir');
        Schema::dropIfExists('sesi_sidang');
        Schema::dropIfExists('jadwal_dosen');
	}

}
