<div class="primary-menu">

    <nav class="navbar navbar-expand-lg align-items-center">

        <div class="offcanvas offcanvas-start"
             tabindex="-1"
             id="offcanvasNavbar"
             aria-labelledby="offcanvasNavbarLabel">

            {{-- Mobile Header --}}
            <div class="offcanvas-header border-bottom">

                <div class="d-flex align-items-center">

                    <img src="{{ asset('assets/images/logo-icon.png') }}"
                         class="logo-icon"
                         alt="TalentBridge Logo">

                    <h4 class="logo-text ms-2 mb-0">
                        TalentBridge Ltd
                    </h4>

                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close">
                </button>

            </div>

            <div class="offcanvas-body">

                <ul class="navbar-nav align-items-center flex-grow-1 gap-lg-1">

                    {{-- Dashboard --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">

                            <div class="parent-icon">
                                <i class="bx bx-home-alt"></i>
                            </div>

                            <div class="menu-title">
                                Dashboard
                            </div>

                        </a>

                    </li>

                    {{-- Managers --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.managers.*') ? 'active' : '' }}"
                           href="{{ route('admin.managers.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-user-plus"></i>
                            </div>

                            <div class="menu-title">
                                Managers
                            </div>

                        </a>

                    </li>

                    {{-- Employees --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}"
                           href="{{ route('admin.employees.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-group"></i>
                            </div>

                            <div class="menu-title">
                                Employees
                            </div>

                        </a>

                    </li>

                    {{-- Leave Management --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.leaves.*') ? 'active' : '' }}"
                           href="{{ route('admin.leaves.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-calendar-check"></i>
                            </div>

                            <div class="menu-title">
                                Leaves
                            </div>

                        </a>

                    </li>

                    {{-- Holiday Management --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.holidays.*') ? 'active' : '' }}"
                           href="{{ route('admin.holidays.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-calendar-event"></i>
                            </div>

                            <div class="menu-title">
                                Holidays
                            </div>

                        </a>

                    </li>

                    {{-- Notifications --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}"
                           href="{{ route('admin.notifications.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-bell"></i>
                            </div>

                            <div class="menu-title">
                                Notice
                            </div>

                        </a>

                    </li>

                    {{-- Create Notification --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.notifications.create') ? 'active' : '' }}"
                           href="{{ route('admin.notifications.create') }}">

                            <div class="parent-icon">
                                <i class="bx bx-message-square-add"></i>
                            </div>

                            <div class="menu-title">
                                Create Notice
                            </div>

                        </a>

                    </li>

                    {{-- Task Management --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.tasks.index') || request()->routeIs('admin.tasks.show') || request()->routeIs('admin.tasks.edit') ? 'active' : '' }}"
                           href="{{ route('admin.tasks.index') }}">

                            <div class="parent-icon">
                                <i class="bx bx-task"></i>
                            </div>

                            <div class="menu-title">
                                Tasks
                            </div>

                        </a>

                    </li>

                    {{-- Create Task --}}
                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('admin.tasks.create') ? 'active' : '' }}"
                           href="{{ route('admin.tasks.create') }}">

                            <div class="parent-icon">
                                <i class="bx bx-list-plus"></i>
                            </div>

                            <div class="menu-title">
                                Create Task
                            </div>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

</div>
