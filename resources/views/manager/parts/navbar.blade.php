<div class="primary-menu">

    <nav class="navbar navbar-expand-lg align-items-center">

        <div class="offcanvas offcanvas-start"
             tabindex="-1"
             id="offcanvasNavbar">

            <div class="offcanvas-header">

                <h5 class="mb-0">
                    Manager Panel
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
                           href="{{ route('manager.dashboard') }}">

                            <i class="bx bx-home-circle"></i>

                            Dashboard

                        </a>

                    </li>

                    {{-- Leave Requests --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('manager.leaves.index') }}">

                            <i class="bx bx-calendar-check"></i>

                            Leave Requests

                        </a>

                    </li>

                    {{-- Holidays --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('manager.holidays.index') }}">

                            <i class="bx bx-calendar-event"></i>

                            Holidays

                        </a>

                    </li>

                    {{-- Profile --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('manager.profile') }}">

                            <i class="bx bx-user"></i>

                            My Profile

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

</div>
