<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" class="{{ 'dashboard' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="/kelas" class="{{ 'kelas' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-exit"></i> <span>Kelas</span></a></li>
                <li><a href="/aula" class="{{ 'aula' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-apartment"></i> <span>Aula</span></a></li>
                <li><a href="/lab" class="{{ 'lab' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-keyboard"></i> <span>Lab</span></a></li>
                <li><hr style="margin-left: 20px; margin-right: 20px;"></li>
                <li><a href="/account" class="{{ 'account' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-users"></i><span>Acoount</span></a></li>
                <li><a href="/reservation" class="{{ 'reservation' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-book"></i><span>Reservation</span></a></li>
                <li><hr style="margin-left: 20px; margin-right: 20px;"></li>
                <li><a href="/time" class="{{ 'time' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-clock"></i><span>Time</span></a></li>
            </ul>
        </nav>
    </div>
</div>