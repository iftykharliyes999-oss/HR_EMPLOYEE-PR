<div class="sidebar-wrapper" data-simplebar="true">

    <div class="sidebar-header">

        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}"
                 class="logo-icon"
                 alt="logo icon">
        </div>

        <div>
            <h4 class="logo-text">
                Employee Panel
            </h4>
        </div>

        <div class="toggle-icon ms-auto">
            <i class='bx bx-arrow-back'></i>
        </div>

    </div>

    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('employee.dashboard') }}">
                <div class="parent-icon">
                    <i class="bx bx-home-circle"></i>
                </div>

                <div class="menu-title">
                    Dashboard
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('employee.leaves.create') }}">
                <div class="parent-icon">
                    <i class="bx bx-calendar-plus"></i>
                </div>

                <div class="menu-title">
                    Apply Leave
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('employee.leaves.index') }}">
                <div class="parent-icon">
                    <i class="bx bx-calendar"></i>
                </div>

                <div class="menu-title">
                    My Leaves
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('profile.edit') }}">
                <div class="parent-icon">
                    <i class="bx bx-user"></i>
                </div>

                <div class="menu-title">
                    My Profile
                </div>
            </a>
        </li>

    </ul>

</div>
