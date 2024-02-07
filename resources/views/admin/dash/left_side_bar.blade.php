<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{url('/dashboard')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/settings-contents') }}" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-business-time"></i>
                        <span>Daily Business</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript: void(0);">Vending</a></li>
                        <li><a href="javascript: void(0);">Clear Temper</a></li>
                        <li><a href="javascript: void(0);">Clear Credit</a></li>
                        <li><a href="{{url('/account-contents')}}">Open an Account &nbsp;&nbsp;<span class="badge rounded-pill bg-danger">New</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-calendar-day"></i>
                        <span>Report <span class="badge rounded-pill bg-danger ">Coming</span></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript: void(0);">Vending Record</a></li>
                        <li><a href="javascript: void(0);">Clear Temper Record</a></li>
                        <li><a href="javascript: void(0);">Clear Credit Record</a></li>
                        <li><a href="javascript: void(0);">Login History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-coins"></i>
                        <span>Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/meter-manage')}}">Meter Management</a></li>
                        <li><a href="{{url('/meter-type-master')}}">Meter Type Master</a></li>
                        <li><a href="{{url('/customer-manage')}}">Customer Management</a></li>
                        <li><a href="{{url('/price-management')}}">Price Management</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
