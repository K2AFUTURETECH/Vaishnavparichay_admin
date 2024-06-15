<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <a href="{url('admin.admindashboard')}"><img src="{{ url('assets1/img/default.png') }}"></a>
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        ADMIN
                        <span class="user-level">Administrator</span>
                        {{-- <span class="caret"></span> --}}
                    </span>
                </a>
                <div class="clearfix"></div>

            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a href="{{ route('admin.admindashboard') }}">
                    <i class="la la-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('admin.admindashboard') }}">
                    <i class="la la-user"></i>
                    <p>Family</p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('admin.admindashboard') }}">
                    <i class="la la-user"></i>
                    <p>Member</p>
                </a>
            </li>
            <hr>
            <li class="nav-item active">
                <a href="{{ route('admin.admindashboard') }}">
                    <i class="la la-user"></i>
                    <p>Gotra </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('state.list') }}">
                    <i class="la la-building"></i>
                    <p>State </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('dist.list') }}">
                    <i class="la la-building"></i>
                    <p>District </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('tehsil.list') }}">
                    <i class="la la-building"></i>
                    <p>Tehsils</p>
                </a>
            </li>





        </ul>

        </ul>

    </div>
</div>
