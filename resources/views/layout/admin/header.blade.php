<div class="logo-header">
    {{-- <a href="index.html" class="logo">
        Admin Dashboard
    </a> --}}
    <img src="{{ asset('assets1/img/logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
        aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
</div>
<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">


        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img
                        src="assets1/img/default.png" alt="user-img" width="36"
                        class="img-circle"><span>Admin</span></span> </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <div class="user-box">
                            <div class="u-img"><img src="assets1/img/default.png" alt="user"></div>
                            <div class="u-text">
                                <h4>ADMIN</h4>
                                <a href="" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                </ul>

            </li>
        </ul>
    </div>
</nav>
</div>
