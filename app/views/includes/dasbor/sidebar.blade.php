<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><span class=""></span>Menu Mahasiswa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('dasbor/sit_in') }}"><span class=""></span> Sit In</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/proposal') }}"><span class=""></span> Unggah Proposal</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><span class=""></span>Menu Dosen<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('dasbor/pembimbing') }}">Dosen Pembimbing</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/penguji') }}">Dosen Penguji</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><span class=""></span>Menu Pegawai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('dasbor/berita') }}"><span class=""></span> Berita</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/panduan') }}"><span class=""></span> Panduan</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/bidang_keahlian') }}"><span class=""></span> Bidang Keahlian</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/topik') }}"><span class=""></span> Topik</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/judul') }}"><span class=""></span> Judul</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/sidang') }}"><span class=""></span> Sidang</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/prodi') }}"><span class=""></span> Laboratorium</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/pengguna/mahasiswa/tambah') }}"><span class=""></span> Tambah Mahasiswa</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
