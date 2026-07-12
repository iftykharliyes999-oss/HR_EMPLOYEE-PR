<div class="primary-menu">

    <nav class="navbar navbar-expand-lg align-items-center">

        <div class="offcanvas offcanvas-start"
             tabindex="-1"
             id="offcanvasNavbar">

            <div class="offcanvas-header">

                <h5 class="mb-0">
                    Employee Panel
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="offcanvas">
                </button>

            </div>

            <div class="offcanvas-body">

                <ul class="navbar-nav justify-content-start flex-grow-1 gap-2">

                    {{-- Dashboard --}}

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('employee.dashboard') }}">

                            <i class="bx bx-home-circle"></i>

                            Dashboard

                        </a>

                    </li>


                    {{-- Apply Leave --}}

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('employee.leaves.create') }}">

                            <i class="bx bx-calendar-plus"></i>

                            Apply Leave

                        </a>

                    </li>


                    {{-- Leave History --}}

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('employee.leaves.index') }}">

                            <i class="bx bx-history"></i>

                            Leave History

                        </a>

                    </li>


                    {{-- Profile --}}

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('employee.profile') }}">

                            <i class="bx bx-user"></i>

                            My Profile

                        </a>

                    </li>


                    {{-- holidays --}}

  <li class="nav-item">

  <a class="nav-link"
   href="{{ route('employee.holidays.index') }}">

    <div class="parent-icon">
        <i class="bx bx-calendar-event"></i>
    </div>

    <div class="menu-title">
        Holidays
    </div>

</a>

</li>

<li class="nav-item">

    <a class="nav-link"
       href="{{ route('employee.calendar') }}">

        <i class="bx bx-calendar"></i>

        Attendance Calendar

    </a>

</li>


                </ul>

            </div>

        </div>

    </nav>

</div>
