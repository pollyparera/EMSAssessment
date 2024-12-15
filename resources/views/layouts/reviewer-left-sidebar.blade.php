 <!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button">
            <i class="zmdi zmdi-menu text-light"></i>
        </button>
        <a href="{{route('reviewer-dashboard')}}"><span class="text-white">EMS Task</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
            <div class="user-info">
                <a class="image" href="#"><img src="{{asset('assets/images/profile_av.jpg')}}" alt="User"/></a>
                <div class="detail">
                <h4>{{Auth::guard('web')->user()->name}}</h4>
                </div>
            </div>
            </li>
            <li >
            <a href="{{route('reviewer-dashboard')}}"><i class="zmdi zmdi-widgets"></i><span>Dashboard</span></a>
            </li>
            <a href="{{route('reviewer-logout')}}"><i class="zmdi zmdi-power"></i><span>Sign Out</span></a>
            </li>
        </ul>
    </div>
</aside>

<!-- Left Sidebar -->