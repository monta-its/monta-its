<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a href="{{ URL::to('/') }}" class="navbar-brand">SIMTA Teknik Mesin ITS</a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- nama situs dan menu utama (rata kiri) -->
    <div class="navbar-collapse collapse navbar-inverse-collapse" id="navbar-main">
      <!-- menu akun -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->nama_lengkap . ' - ' . Auth::user()->nomor_induk  }}<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ URL::to('/') }}">
                <span class="glyphicon glyphicon-home"></span> Beranda
              </a>
            </li>
            <li>
              <a href="{{ URL::to('/logout') }}">
                <span class="glyphicon glyphicon-log-out"></span> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
