<!DOCTYPE html>
<html>
<head>
  @include('includes.head')
</head>

<body>
  @include('includes.header')

  <div class="container">
    @if (isset($breadcrumbs))
      @include('includes.breadcrumb')
    @else
      <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Beranda</a></li>
        <li class="active">@yield('page_title')</li>
      </ol>
    @endif
    <!-- content -->
    <div class="row">
    
      <!-- sidebar left -->
      <div class="col-md-3">
      <div class="panel panel-default">
          <div class="panel-body">
            @include('includes.sidebar')
          </div>
      </div>
      </div>

      <!-- primary -->
      <div class="col-md-9">
        @yield('content')
      </div>

    </div> <!-- .row -->

  </div>
  <div class="container">
    @include('includes.footer')
  </div>
</body>
</html>