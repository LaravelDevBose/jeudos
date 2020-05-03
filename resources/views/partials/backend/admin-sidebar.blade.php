<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{url('admin')}}">
                    <!-- logo for regular state and mobile devices -->
                    <img src="{{asset('backend/images/logo-text.png')}}" style="border-radius: 0">
                </a>
            </div>
            <div class="profile-pic">
                @if(!empty($user->profile_image_url) && !is_null($user->profile_image_url))
                    <img src="{{asset($user->profile_image_url)}}" class="rounded-circle" alt="">
                @else
                    <img src="{{asset('backend/images/user.png')}}" class="rounded-circle" alt="">
                @endif
                <div class="profile-info"><h4>{{auth()->user()->name}}</h4>
                    <div class="list-icons-item dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><span
                                class="badge badge-ring fill badge-primary mr-2"></span>{{ucfirst(auth()->user()->getRoleNames()[0])}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{url('admin/profile')}}" class="dropdown-item">Profile</a>
                            <a href="{{url('logout')}}" class="dropdown-item">logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header nav-small-cap">PERSONAL</li>

            <li class="@yield('dashboard')">
                <a href="{{url('admin')}}">
                    <i class="ti-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-bolt"></i><span>Influencers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/influencers/requests')}}"><i class="ti-more"></i>Requests </a></li>
                    <li><a href="{{url('admin/influencers')}}"><i class="ti-more"></i>Influencers</a></li>
                </ul>
            </li>
            <li class="@yield('profile')">
                <a href="{{url('admin/profile')}}">
                    <i class="ti-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="@yield('income')">
                <a href="{{url('income')}}">
                    <i class="ti-money"></i>
                    <span>Income</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/categories')}}" class="@yield('categories')">
                    <i class="ti-flag-alt-2"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/faqs')}}" class="@yield('faqs')">
                    <i class="ti-info-alt"></i>
                    <span>FAQs</span>
                </a>
            </li>
            <li class="@yield('logout')">
                <a href="{{url('logout')}}">
                    <i class="ti-power-off"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
