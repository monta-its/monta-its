@include('includes.header_image')
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
      <?php
      $l_menu = array(
      array(
      'type' => 'local',
      'url' => 'berita',
      'text' => 'Berita TA',
      'isParent' => false
      ),
      array(
      'type' => 'local',
      'url' => 'panduan',
      'text' => 'Panduan TA',
      'isParent' => false
      ),
      array(
      'type' => 'local',
      'url' => 'sidang',
      'text' => 'Sidang',
      'isParent' => true,
      'children' => array(
      array(
      'type' => 'local',
      'url' => 'sidang/proposal',
      'text' => 'Seminar Proposal',
      'isParent' => false
      ),
      array(
      'type' => 'local',
      'url' => 'sidang/ta',
      'text' => 'Sidang TA',
      'isParent' => false
      )
      )
      )
      );
      ?>
      <ul class="nav navbar-nav">
        @foreach ($l_menu as $menu)
        @if ($menu['isParent'] && isset($menu['children']))
        <li class="dropdown">
          <a href="{{ URL::to($menu['url']) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $menu['text'] }}<b class="caret"></b></a>
          <ul class="dropdown-menu">
            @foreach ($menu['children'] as $child)
            <li>
              <a href="{{ URL::to($child['url']) }}">{{ $child['text'] }}</a>
            </li>
            @endforeach
          </ul>
        </li>
        @else
        <li><a href="{{ URL::to($menu['url']) }}">{{ $menu['text'] }}</a></li>
        @endif
        @endforeach
      </ul>
      <!-- menu akun -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          @if (Auth::check())
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name_user . ' - ' . Auth::user()->person_id  }}<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ URL::to('/dasbor') }}">
              <span class="glyphicon glyphicon-cog"></span> Dasbor
              </a>
            </li>
            <li>
              <a href="{{ URL::to('/logout') }}">
              <span class="glyphicon glyphicon-log-out"></span> Logout
              </a>
            </li>
          </ul>
          @else
          <a href="{{ URL::to('login') }}">
          <span class="glyphicon glyphicon-log-in"></span> Login
          </a>
          @endif
        </li>
      </ul>
    </div>
  </div>
</div>