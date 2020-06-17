<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href="index.html"><img src="{{asset('admin/assets/img/logo9.png')}}" alt="dinusclass Logo"></a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <form class="navbar-form navbar-left" method="get" action="{{ 'kelas' == request()->path() ? 'kelas' : '' }}
            {{ 'aula' == request()->path() ? 'aula' : '' }}
            {{ 'lab' == request()->path() ? 'lab' : '' }}
            {{ 'account' == request()->path() ? 'account' : '' }}
            {{ 'reservation' == request()->path() ? 'reservation' : '' }}
            {{ 'time' == request()->path() ? 'time' : '' }}
            {{ 'room' == request()->path() ? 'room' : '' }}">
            <div class="input-group">
                <input type="search" name="cari" class="form-control" placeholder="Pencarian..">
                <span class="input-group-btn"><button type="submit" class="btn btn-primary">Cari</button></span>
            </div>
        </form>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{{asset('admin/assets/img/user.png')}}" class="img-circle" alt="Avatar"> --}}
                        <span>{{auth()->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        {{-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                        <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                        <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> --}}
                        <li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
