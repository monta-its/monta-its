<!DOCTYPE html>
<html>

<head>
    @include('includes.dasbor.head')
</head>

<body>

    <div id="wrapper">

        @include('includes.dasbor.navigation')

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @yield('scripts')

</body>

</html>
