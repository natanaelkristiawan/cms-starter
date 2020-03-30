<!DOCTYPE html>
<html>

<head>

@include('theme.admin.partials.metadata')

</head>

<body class="fixed-sidebar">

    <div id="wrapper">

        @include('theme.admin.partials.sidebar')

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to YES CMS.</span>
                        </li>

                        <li>
                            <a href="{{ route('admin.logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            @yield('content')
            <div class="footer">
                <div>
                    <strong>Copyright</strong> YES CMS &copy; 2020
                </div>
            </div>
        </div>
    </div>

    @include('theme.admin.partials.footer')

</body>

</html>
