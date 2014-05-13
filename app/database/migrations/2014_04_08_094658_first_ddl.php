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
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('pegawai', function($table) {
            $table->string('nip_pegawai')->primary();
            $table->string('nama_lengkap')->index();
            $table->string('kata_sandi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen', function($table)
        {
            $table->string('nip_dosen')->primary();
            $table->string('nidn')->unique();
            $table->string('nama_dosen')->index();
            $table->string('gelar');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ruangan', function($table)
        {
            $table->string('kode_ruangan')->primary();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tugas_akhir', function($table)
        {
            $table->increments('kode_ta');
            $table->string('judul');
            $table->string('nrp_mahasiswa');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', array('pra_diajuakan', 'diajukan', 'siap_sidang_proposal', 'pengerjaan', 'siap_sidang_akhir', 'revisi', 'selesai', 'mengundurkan_diri'));
            $table->string('kode_bidang_minat');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen_pembimbing', function($table)
        {
            $table->integer('kode_ta');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sidang', function($table)
        {
            $table->increments('kode_sidang');
            $table->integer('kode_ta');
            $table->enum('jenis_sidang', array('proposal', 'akhir'));
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('penguji_sidang', function($table)
        {
            $table->integer('kode_sidang');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('evaluasi', function($table)
        {
            $table->integer('kode_ta');
            $table->string('jenis_penilaian');
            $table->string('nip_dosen');
            $table->integer('nilai');
            $table->string('deskripsi_nilai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bidang_minat', function($table)
        {
            $table->string('kode_bidang_minat')->primary();
            $table->string('nama_bidang_minat');
            $table->string('nip_dosen_koordinator');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dosen_bidang_minat', function($table)
        {
            $table->string('kode_bidang_minat');
            $table->string('nip_dosen');
            $table->timestamps();
            $table->softDeletes();
        });



        Schema::create('pos', function($table)
        {
            $table->increments('id_post');
            $table->string('nip_dosen');
            $table->string('kategori');
            $table->string('kata_kunci');
            $table->string('judul');
            $table->text('isi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pemberitahuan_dosen', function($table)
        {
            $table->string('nip_dosen');
            $table->string('isi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pemberitahuan_mahasiswa', function($table)
        {
            $table->string('nrp_mahasiswa');
            $table->string('isi');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('dosen');
        Schema::drop('ruangan');
        Schema::drop('tugas_akhir');
        Schema::drop('dosen_pembimbing');
        Schema::drop('sidang');
        Schema::drop('penguji_sidang');
        Schema::drop('bidang_minat');
        Schema::drop('dosen_bidang_minat');
        Schema::drop('pos');
        Schema::drop('pemberitahuan_dosen');
        Schema::drop('evaluasi');
        Schema::drop('pemberitahuan_mahasiswa');
	}

}
