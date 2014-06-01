<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    @yield('custom_head')
</head>
<body>
    @include('includes.dasbor_header')
    <div class="container">
        <!-- content -->
        <div class="row">
            <!-- sidebar left -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('includes.dasbor_sidebar')
                    </div>
                </div>
            </div>
            <!-- primary -->
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>
                        @yield('page_title')
                        </h1>
                        <br />
                        @yield('content')
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div>
    <div class="container">
        @include('includes.footer')
    </div>
    @yield('scripts')    
</body>
</html>