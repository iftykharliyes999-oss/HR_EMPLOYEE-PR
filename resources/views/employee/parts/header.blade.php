<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="topbar-logo-header d-none d-lg-flex">
						<div class="">
							<img src="{{asset('')}}assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
						</div>
						<div class="">
							<h4 class="logo-text">TalentBridge Ltd</h4>
						</div>
					</div>
					<div class="mobile-toggle-menu d-block d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"><i class='bx bx-menu'></i></div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					 <div class="top-menu ms-auto">

    <ul class="navbar-nav align-items-center gap-2">

        {{-- Date --}}
        <li class="nav-item d-none d-lg-flex">

            <span class="badge bg-light text-dark border px-3 py-2">

                <i class='bx bx-calendar'></i>

                {{ now()->format('d M Y') }}

            </span>

        </li>

        {{-- Notification --}}
        <li class="nav-item dropdown dropdown-large">

            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
               href="#"
               data-bs-toggle="dropdown">

                @php

                    $notificationCount = \App\Models\Notification::where('status','Published')->count();

                    $latestNotifications = \App\Models\Notification::where('status','Published')
                        ->latest()
                        ->take(5)
                        ->get();

                @endphp

                @if($notificationCount > 0)
                    <span class="alert-count">
                        {{ $notificationCount }}
                    </span>
                @endif

                <i class='bx bx-bell'></i>

            </a>

            <div class="dropdown-menu dropdown-menu-end">

                <div class="msg-header">

                    <p class="msg-header-title">
                        Company Notifications
                    </p>

                    <p class="msg-header-badge">
                        {{ $notificationCount }} New
                    </p>

                </div>

                <div class="header-notifications-list">

                    @forelse($latestNotifications as $notification)

                        <a class="dropdown-item"
                           href="{{ route('employee.notifications.show',$notification) }}">

                            <div class="d-flex align-items-center">

                                <div class="notify bg-light-primary text-primary">

                                    <i class='bx bx-bell'></i>

                                </div>

                                <div class="flex-grow-1">

                                    <h6 class="msg-name">

                                        {{ Str::limit($notification->title,28) }}

                                        <span class="msg-time float-end">

                                            {{ $notification->created_at->diffForHumans() }}

                                        </span>

                                    </h6>

                                    <p class="msg-info">

                                        {{ Str::limit($notification->message,45) }}

                                    </p>

                                </div>

                            </div>

                        </a>

                    @empty

                        <div class="text-center p-4">

                            <i class='bx bx-bell-off fs-1 text-muted'></i>

                            <p class="text-muted mt-2 mb-0">

                                No Notifications Available

                            </p>

                        </div>

                    @endforelse

                </div>

                <div class="text-center msg-footer">

                    <a href="{{ route('employee.dashboard') }}"
                       class="btn btn-primary w-100">

                        Back to Dashboard

                    </a>

                </div>

            </div>

        </li>

    </ul>

</div>

<div class="user-box dropdown px-3">

    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
       href="#"
       role="button"
       data-bs-toggle="dropdown">

        <img src="{{ Auth::user()->photo
            ? asset('uploads/employees/'.Auth::user()->photo)
            : asset('assets/images/avatars/avatar-1.png') }}"
             class="user-img rounded-circle"
             alt="Employee">

        <div class="user-info">

            <p class="user-name mb-0">

                {{ Auth::user()->name }}

            </p>

            <p class="designattion mb-0">

                {{ Auth::user()->designation ?? 'Employee' }}

            </p>

        </div>

    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow">

        <li>

            <div class="d-flex align-items-center p-3">

                <img src="{{ Auth::user()->photo
                    ? asset('uploads/employees/'.Auth::user()->photo)
                    : asset('assets/images/avatars/avatar-1.png') }}"
                     width="60"
                     height="60"
                     class="rounded-circle">

                <div class="ms-3">

                    <h6 class="mb-0">

                        {{ Auth::user()->name }}

                    </h6>

                    <small class="text-muted">

                        {{ Auth::user()->designation ?? 'Employee' }}

                    </small>

                    <br>

                    <small class="text-primary">

                        {{ Auth::user()->email }}

                    </small>

                </div>

            </div>

        </li>

        <li><hr class="dropdown-divider"></li>

        <li>

            <a class="dropdown-item"
               href="#">

                <i class='bx bx-user'></i>

                My Profile

            </a>

        </li>

        <li>

            <a class="dropdown-item"
               href="{{ route('employee.dashboard') }}">

                <i class='bx bx-home'></i>

                Dashboard

            </a>

        </li>

        <li>

            <a class="dropdown-item"
               href="#">

                <i class='bx bx-bell'></i>

                Company Notifications

            </a>

        </li>

        <li>

            <a class="dropdown-item"
               href="#">

                <i class='bx bx-lock'></i>

                Change Password

            </a>

        </li>

        <li><hr class="dropdown-divider"></li>

        <li>

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button class="dropdown-item text-danger">

                    <i class='bx bx-log-out'></i>

                    Logout

                </button>

            </form>

        </li>

    </ul>

</div>
				</nav>
			</div>
		</header>
