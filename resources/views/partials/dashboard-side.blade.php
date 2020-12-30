<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="d-xs-block d-md-none ">
            <div class="d-flex justify-content-end pt-3 mr-3 sidenav-toggler sidenav-toggler-dark"
                data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner text-success">
                    <i class="fa fa-arrow-left"></i>
                </div>
            </div>
        </div>

        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('app-assets/img/brand/logo.png') }}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="dashboard.html">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Food and Beverages</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/categories') ? 'active' : '' }}" href="/categories">
                            <i class="ni ni-archive-2"></i>
                            <span class="nav-link-text">Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/items') ? 'active' : '' }}" href="/items">
                            <i class="ni ni-basket"></i>
                            <span class="nav-link-text">Items</span>
                        </a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Restaurant Management</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/tables') ? 'active' : '' }}" href="/tables">
                            <i class="ni ni-support-16"></i>
                            <span class="nav-link-text">Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/customers') ? 'active' : '' }}" href="/customers">
                            <i class="ni ni-satisfied"></i>
                            <span class="nav-link-text">Customers</span>
                        </a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Financial</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('/orders') ? 'active' : '' }}" href="/orders">
                            <i class="ni ni-box-2"></i>
                            <span class="nav-link-text">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('/transactions') ? 'active' : '' }}" href="/transactions">
                            <i class="ni ni-single-copy-04"></i>
                            <span class="nav-link-text">Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('/reports') ? 'active' : '' }}" href="/reports">
                            <i class="ni ni-collection"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">HR Management</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/users') ? 'active' : '' }}" href="/users ">
                            <i class="ni ni-single-02"></i>
                            <span class="nav-link-text">Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/attendances') ? 'active' : '' }}" href="/attendances">
                            <i class="ni ni-time-alarm"></i>
                            <span class="nav-link-text">Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/payslips') ? 'active' : '' }}" href="/payslips">
                            <i class="ni ni-money-coins"></i>
                            <span class="nav-link-text">Payslips</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
