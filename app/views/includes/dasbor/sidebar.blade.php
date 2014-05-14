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
                <a href="{{ URL::to('dasbor') }}"><span class="glyphicon glyphicon-dashboard"></span> Dasbor</a>
            </li>
            <li>
                <a href="{{ URL::to('dasbor/berita') }}"><span class="glyphicon glyphicon-add"></span> Berita</a>
            </li>
            <li>
                <a href="#"><span class="glyphicon glyphicon-user"></span> Pembimbing & Penguji<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('dasbor/pembimbing') }}">Dosen Pembimbing</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('dasbor/penguji') }}">Dosen Penguji</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ URL::to('dasbor/proposal') }}"><span class="glyphicon glyphicon-upload"></span> Unggah Proposal</a>
            </li>
            <li>
                <a href="{{ URL::to('dasbor/pengguna/mahasiswa/tambah') }}"><span class="glyphicon glyphicon-add"></span> Tambah Mahasiswa</a>
            </li>
            <li>
                <a href="{{ URL::to('dasbor/sit_in') }}"><span class="glyphicon glyphicon-add"></span> Sit In</a>
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->