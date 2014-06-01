<!-- Sidebar -->
<ul class="nav">
<?php
    $auth = Auth::user();
?>
@if ($auth->peran == 0)
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa') }}"><span class=""></span> Dasbor</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/sit_in') }}"><span class=""></span> Sit In</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/berkas') }}"><span class=""></span> Unggah Berkas</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/pembimbing') }}">Dosen Pembimbing</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/penguji') }}">Dosen Penguji</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/mahasiswa/sidang') }}">Sidang</a>
    </li>
@endif
@if ($auth->peran == 2 || $auth->peran == 3)
    <li>
        <a href="{{ URL::to('dasbor/dosen') }}"><span class=""></span> Dasbor</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/bimbingan') }}"><span class=""></span> Bimbingan</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/sit_in') }}"><span class=""></span> Sit In</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/berita') }}"><span class=""></span> Berita</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/panduan') }}"><span class=""></span> Panduan</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/bidang_keahlian') }}"><span class=""></span> Bidang Keahlian</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/topik') }}"><span class=""></span> Topik</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/judul') }}"><span class=""></span> Penawaran Judul</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/sidang') }}"><span class=""></span> Sidang</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/prodi') }}"><span class=""></span> Laboratorium</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/dosen/pengguna/mahasiswa/tambah') }}"><span class=""></span> Tambah Mahasiswa</a>
    </li>
@endif
@if ($auth->peran == 1 || $auth->peran == 3)
    <li>
        <a href="{{ URL::to('dasbor/pegawai/syarat') }}"><span class=""></span> Syarat</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/pegawai/sidang') }}"><span class=""></span> Sidang</a>
    </li>
    <li>
        <a href="{{ URL::to('dasbor/pegawai/pengguna/mahasiswa/tambah') }}"><span class=""></span> Tambah Mahasiswa</a>
    </li>
@endif
</ul>
