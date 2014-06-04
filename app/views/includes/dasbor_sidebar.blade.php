<!-- Sidebar -->
<ul class="nav">
<?php
    $auth = Auth::user();
?>
@if ($auth->peran == 0)
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa') }}">Dasbor</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/sit_in') }}">Sit In</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/berkas') }}">Unggah Berkas</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/sidang') }}">Sidang</a>
    </li>
@endif
@if ($auth->peran == 2 || $auth->peran == 3)
    <li>
        <a href="{{ URL::to('dasbor/dosen') }}">Dasbor</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/sit_in') }}">Sit In</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/bimbingan') }}">Bimbingan</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/jadwal') }}">Jadwal</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/berita') }}">Berita</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/panduan') }}">Panduan</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/prodi') }}">Laboratorium</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/bidang_keahlian') }}">Bidang Keahlian</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/topik') }}">Topik</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/judul') }}">Penawaran Judul</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/sidang') }}">Sidang</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/pengguna/mahasiswa/tambah') }}">Tambah Mahasiswa</a>
    </li>
@endif
@if ($auth->peran == 1 || $auth->peran == 3)
    <li>
        <a href="{{ URL::to('dasbor/pegawai/syarat_mahasiswa') }}">Syarat Mahasiswa</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/pegawai/syarat') }}">Syarat</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/pegawai/sidang') }}">Sidang</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/tambah') }}">Tambah Mahasiswa</a>
    </li>
@endif
</ul>
