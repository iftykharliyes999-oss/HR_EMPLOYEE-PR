<header>
    <div class="topbar d-flex align-items-center">

        <nav class="navbar navbar-expand gap-3 w-100">

            {{-- Logo --}}
            <div class="topbar-logo-header d-none d-lg-flex align-items-center">

                <img src="{{ asset('assets/images/logo-icon.png') }}"
                     class="logo-icon"
                     alt="TalentBridge Logo">

                <h4 class="logo-text mb-0 ms-2">
                    TalentBridge Ltd
                </h4>

            </div>

            {{-- Mobile Menu --}}
            <div class="mobile-toggle-menu d-block d-lg-none"
                 data-bs-toggle="offcanvas"
                 data-bs-target="#offcanvasNavbar">

                <i class="bx bx-menu"></i>

            </div>

            {{-- Search --}}
            <div class="search-bar flex-grow-1">

                <div class="position-relative search-bar-box">

                    <input type="text"
                           class="form-control search-control"
                           placeholder="Search employees, managers, tasks...">

                    <span class="position-absolute top-50 search-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>

                    <span class="position-absolute top-50 search-close translate-middle-y">
                        <i class="bx bx-x"></i>
                    </span>

                </div>

            </div>

            @php
                $adminUser = auth()->user();

                $latestNotifications = \App\Models\Notification::query()
                    ->where('status', 'Published')
                    ->where(function ($query) {
                        $query->whereNull('publish_at')
                            ->orWhere('publish_at', '<=', now());
                    })
                    ->where(function ($query) {
                        $query->whereNull('expire_at')
                            ->orWhere('expire_at', '>=', now());
                    })
                    ->latest()
                    ->take(5)
                    ->get();

                $notificationCount = $latestNotifications->count();

                $adminPhoto = $adminUser->photo
                    ? asset('uploads/employees/' . $adminUser->photo)
                    : asset('assets/images/avatars/avatar-1.png');
            @endphp

            {{-- Right Menu --}}
            <div class="top-menu ms-auto">

                <ul class="navbar-nav align-items-center gap-2">

                    {{-- Current Date --}}
                    <li class="nav-item d-none d-xl-flex">

                        <span class="badge bg-light text-dark border px-3 py-2">

                            <i class="bx bx-calendar me-1"></i>

                            {{ now()->format('d M Y') }}

                        </span>

                    </li>

                    {{-- Quick Create --}}
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                           href="#"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">

                            <i class="bx bx-plus-circle"></i>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                            <li>

                                <h6 class="dropdown-header">
                                    Quick Create
                                </h6>

                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('admin.employees.create') }}">

                                    <i class="bx bx-user-plus fs-5 me-2 text-primary"></i>

                                    <span>Add Employee</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('admin.managers.create') }}">

                                    <i class="bx bx-group fs-5 me-2 text-success"></i>

                                    <span>Add Manager</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('admin.tasks.create') }}">

                                    <i class="bx bx-task fs-5 me-2 text-warning"></i>

                                    <span>Create Task</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('admin.notifications.create') }}">

                                    <i class="bx bx-bell-plus fs-5 me-2 text-danger"></i>

                                    <span>Create Notification</span>

                                </a>

                            </li>

                        </ul>

                    </li>

                    {{-- Notifications --}}
                    <li class="nav-item dropdown dropdown-large">

                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                           href="#"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">

                            @if($notificationCount > 0)

                                <span class="alert-count">
                                    {{ $notificationCount }}
                                </span>

                            @endif

                            <i class="bx bx-bell"></i>

                        </a>

                        <div class="dropdown-menu dropdown-menu-end shadow">

                            <div class="msg-header">

                                <p class="msg-header-title mb-0">
                                    Company Notifications
                                </p>

                                <p class="msg-header-badge mb-0">
                                    {{ $notificationCount }} Active
                                </p>

                            </div>

                            <div class="header-notifications-list">

                                @forelse($latestNotifications as $notification)

                                    <a class="dropdown-item"
                                       href="{{ route('admin.notifications.show', $notification) }}">

                                        <div class="d-flex align-items-start">

                                            <div class="notify bg-light-primary text-primary flex-shrink-0">

                                                @switch($notification->priority)

                                                    @case('Urgent')
                                                        <i class="bx bx-error-circle text-danger"></i>
                                                        @break

                                                    @case('Important')
                                                        <i class="bx bx-info-circle text-warning"></i>
                                                        @break

                                                    @default
                                                        <i class="bx bx-bell"></i>

                                                @endswitch

                                            </div>

                                            <div class="flex-grow-1 ms-3">

                                                <h6 class="msg-name mb-1">

                                                    {{ \Illuminate\Support\Str::limit($notification->title, 32) }}

                                                    <span class="msg-time float-end">

                                                        {{ $notification->created_at->diffForHumans() }}

                                                    </span>

                                                </h6>

                                                <p class="msg-info mb-1">

                                                    {{ \Illuminate\Support\Str::limit($notification->message, 55) }}

                                                </p>

                                                <small>

                                                    @switch($notification->priority)

                                                        @case('Urgent')
                                                            <span class="badge bg-danger">
                                                                Urgent
                                                            </span>
                                                            @break

                                                        @case('Important')
                                                            <span class="badge bg-warning text-dark">
                                                                Important
                                                            </span>
                                                            @break

                                                        @default
                                                            <span class="badge bg-success">
                                                                Normal
                                                            </span>

                                                    @endswitch

                                                </small>

                                            </div>

                                        </div>

                                    </a>

                                @empty

                                    <div class="text-center py-5 px-3">

                                        <i class="bx bx-bell-off display-5 text-muted"></i>

                                        <h6 class="fw-bold mt-3 mb-1">
                                            No notifications
                                        </h6>

                                        <small class="text-muted">
                                            There are no active company notifications.
                                        </small>

                                    </div>

                                @endforelse

                            </div>

                            <div class="text-center msg-footer">

                                <a href="{{ route('admin.notifications.index') }}"
                                   class="btn btn-primary w-100">

                                    <i class="bx bx-list-ul me-1"></i>

                                    View All Notifications

                                </a>

                            </div>

                        </div>

                    </li>

                </ul>

            </div>

            {{-- Profile --}}
            <div class="user-box dropdown px-3">

                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">

                    <img src="{{ $adminPhoto }}"
                         class="user-img rounded-circle"
                         alt="{{ $adminUser->name }}">

                    <div class="user-info d-none d-md-block">

                        <p class="user-name mb-0">
                            {{ $adminUser->name }}
                        </p>

                        <p class="designattion mb-0">
                            {{ $adminUser->designation ?? 'Administrator' }}
                        </p>

                    </div>

                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">

                    {{-- Profile Summary --}}
                    <li>

                        <div class="d-flex align-items-center p-3">

                            <img src="{{ $adminPhoto }}"
                                 width="58"
                                 height="58"
                                 class="rounded-circle object-fit-cover"
                                 alt="{{ $adminUser->name }}">

                            <div class="ms-3">

                                <h6 class="fw-bold mb-1">
                                    {{ $adminUser->name }}
                                </h6>

                                <small class="text-muted d-block">
                                    {{ $adminUser->designation ?? 'Administrator' }}
                                </small>

                                <small class="text-primary">
                                    {{ $adminUser->email }}
                                </small>

                            </div>

                        </div>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    {{-- Dashboard --}}
                    <li>

                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('admin.dashboard') }}">

                            <i class="bx bx-home-circle fs-5 me-2"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>

                    {{-- Employees --}}
                    <li>

                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('admin.employees.index') }}">

                            <i class="bx bx-group fs-5 me-2"></i>

                            <span>Employees</span>

                        </a>

                    </li>

                    {{-- Managers --}}
                    <li>

                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('admin.managers.index') }}">

                            <i class="bx bx-user-check fs-5 me-2"></i>

                            <span>Managers</span>

                        </a>

                    </li>

                    {{-- Tasks --}}
                    <li>

                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('admin.tasks.index') }}">

                            <i class="bx bx-task fs-5 me-2"></i>

                            <span>Task Management</span>

                        </a>

                    </li>

                    {{-- Notifications --}}
                    <li>

                        <a class="dropdown-item d-flex align-items-center"
                           href="{{ route('admin.notifications.index') }}">

                            <i class="bx bx-bell fs-5 me-2"></i>

                            <span>Notifications</span>

                        </a>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    {{-- Logout --}}
                    <li>

                        <form action="{{ route('logout') }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="dropdown-item d-flex align-items-center text-danger">

                                <i class="bx bx-log-out-circle fs-5 me-2"></i>

                                <span>Logout</span>

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </nav>

    </div>
</header>
