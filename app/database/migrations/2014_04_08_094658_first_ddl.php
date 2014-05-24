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
            $table->string('nrp_mahasiswa')->primary();
            $table->string('nama_lengkap')->index();
            $table->string('kata_sandi');
            $table->integer('angkatan');
            $table->integer('sks_tempuh');
            $table->integer('sks_lulus');
            $table->boolean('aktif');
            $table->string('kode_jenjang_pendidikan');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('jenjang_pendidikan', function($table)
        {
            $table->string('kode_jenjang_pendidikan')->primary();
            $table->string('nama_jenjang_pendidikan');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('pegawai', function($table) {
            $table->string('nip_pegawai')->primary();
            $table->string('nama_lengkap')->index();
            $table->string('kata_sandi');
            $table->boolean('aktif');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen', function($table)
        {
            $table->string('nip_dosen')->primary();
            $table->string('nidn')->unique();
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->boolean('hak_akses_pegawai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ruangan', function($table)
        {
            $table->increments('id_ruangan');
            $table->string('kode_ruangan');
            $table->string('nama_ruangan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tugas_akhir', function($table)
        {
            $table->increments('id_tugas_akhir');
            $table->integer('id_penawaran_judul');
            $table->string('nrp_mahasiswa');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', array('pra_diajuakan', 'diajukan', 'siap_sidang_proposal', 'pengerjaan', 'siap_sidang_akhir', 'revisi', 'selesai', 'mengundurkan_diri'));
            $table->integer('id_topik');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen_pembimbing', function($table)
        {
            $table->increments('id_dosen_pembimbing');
            $table->integer('id_tugas_akhir');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sidang', function($table)
        {
            $table->increments('id_sidang');
            $table->integer('id_tugas_akhir');
            $table->enum('jenis_sidang', array('proposal', 'akhir'));
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->integer('id_ruangan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('penguji_sidang', function($table)
        {
            $table->increments('id_penguji_sidang');
            $table->integer('id_sidang');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('evaluasi', function($table)
        {
            $table->increments('id_evaluasi');
            $table->integer('id_tugas_akhir');
            $table->string('jenis_penilaian');
            $table->string('nip_dosen');
            $table->integer('nilai');
            $table->string('deskripsi_nilai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bidang_minat', function($table)
        {
            $table->increments('id_bidang_minat');
            $table->string('kode_bidang_minat');
            $table->string('nama_bidang_minat');
            $table->text('deskripsi_bidang_minat');
            $table->string('nip_dosen_koordinator');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen_bidang_minat', function($table)
        {
            $table->increments('id_dosen_bidang_minat');
            $table->integer('id_bidang_minat');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pos', function($table)
        {
            $table->increments('id_pos');
            $table->string('nip_pegawai');
            $table->string('judul');
            $table->text('isi');
            $table->boolean('apakah_terbit');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('panduan', function($table)
        {
            $table->increments('id_panduan');
            $table->string('nip_pegawai');
            $table->string('judul_panduan');
            $table->text('isi_panduan');
            $table->integer('id_lampiran');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('lampiran', function($table)
        {
            $table->increments('id_lampiran');
            $table->string('nama_lampiran');
            $table->enum('tipe_lampiran', array('file', 'url'));
            $table->string('path_lampiran');
            $table->string('nip_pegawai');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('penawaran_judul', function($table) {
            $table->increments('id_penawaran_judul');
            $table->integer('id_topik');
            $table->string('nip_dosen');
            $table->string('judul_tugas_akhir');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('topik', function($table) {
            $table->increments('id_topik');
            $table->integer('id_bidang_keahlian');
            $table->string('topik');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('bidang_keahlian', function($table) {
            $table->increments('id_bidang_keahlian');
            $table->string('nama_bidang_keahlian');
            $table->string('deskripsi_bidang_keahlian');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('bidang_keahlian_dosen', function($table) {
            $table->increments('id_bidang_keahlian_dosen');
            $table->integer('id_bidang_keahlian');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('bidang_keahlian_bidang_minat', function($table) {
            $table->increments('id_bidang_keahlian_bidang_minat');
            $table->integer('id_bidang_keahlian');
            $table->integer('id_bidang_minat');
            $table->timestamps();
            $table->softdeletes();
        });

        Schema::create('pemberitahuan_pegawai', function($table)
        {
            $table->increments('id_pemberitahuan_pegawai');
            $table->string('nip_pegawai');
            $table->string('isi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pemberitahuan_mahasiswa', function($table)
        {
            $table->increments('id_pemberitahuan_mahasiswa');
            $table->string('nrp_mahasiswa');
            $table->string('isi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('syarat', function($table)
        {
            $table->increments('id_syarat');
            $table->string('kode_syarat')->unique();
            $table->string('nama_syarat');
            $table->enum('waktu_syarat', array('pra_sit_in', 'pra_bimbingan', 'pra_sidang_proposal', 'pra_sidang_akhir'));
            $table->enum('jenis_mahasiswa', array('reguler', 'lintas_jalur'));
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('syarat_mahasiswa', function($table) {
            $table->increments('id_syarat_mahasiswa');
            $table->integer('id_syarat');
            $table->string('nrp_mahasiswa');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sessions', function($table)
        {
            $table->string('id')->unique();
            $table->text('payload');
            $table->integer('last_activity');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('mahasiswa');
        Schema::drop('jenjang_pendidikan');
        Schema::drop('dosen');
        Schema::drop('ruangan');
        Schema::drop('tugas_akhir');
        Schema::drop('dosen_pembimbing');
        Schema::drop('sidang');
        Schema::drop('penguji_sidang');
        Schema::drop('bidang_minat');
        Schema::drop('dosen_bidang_minat');
        Schema::drop('pos');
        Schema::drop('pemberitahuan_pegawai');
        Schema::drop('evaluasi');
        Schema::drop('pemberitahuan_mahasiswa');
        Schema::drop('pegawai');
        Schema::drop('panduan');
        Schema::drop('lampiran');
        Schema::drop('penawaran_judul');
        Schema::drop('topik');
        Schema::drop('bidang_keahlian');
        Schema::drop('bidang_keahlian_dosen');
        Schema::drop('bidang_keahlian_bidang_minat');
        Schema::drop('sessions');
        Schema::drop('syarat');
        Schema::drop('syarat_mahasiswa');
	}

}
