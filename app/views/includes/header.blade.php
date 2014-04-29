<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a href="." class="navbar-brand">SIMTA ITS</a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- nama situs dan menu utama (rata kiri) -->
    <div class="navbar-collapse collapse navbar-inverse-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('topik') }}">Topik TA</a></li>
        <li class="dropdown">
          <a href="{{ URL::to('sidang') }}" class="dropdown-toggle" data-toggle="dropdown">Sidang TA<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ URL::to('sidang/proposal') }}">Sidang Proposal</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ URL::to('sidang/ta') }}">Sidang TA</a>
            </li>
          </ul>
        </li>
        <li><a href="{{ URL::to('berita') }}">Berita</a></li>
        <li><a href="{{ URL::to('panduan') }}">Panduan TA</a></li>
      </ul>

      <!-- menu akun -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Michael Schumacher<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Pengaturan akun</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div> 
</div> 