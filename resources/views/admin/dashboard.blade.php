@extends('admin.master')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        {{-- Welcome --}}
        <div class="card border-0 shadow-sm radius-10 mb-4">
            <div class="card-body">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                    <div>
                        <h4 class="fw-bold mb-1">
                            Welcome back, {{ auth()->user()->name }} 👋
                        </h4>

                        <p class="text-muted mb-0">
                            {{ now()->format('l, d F Y') }} —
                            Here is today’s HR overview.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('admin.tasks.create') }}"
                           class="btn btn-primary">

                            <i class="bx bx-task me-1"></i>
                            Create Task

                        </a>

                        <a href="{{ route('admin.notifications.create') }}"
                           class="btn btn-outline-primary">

                            <i class="bx bx-bell me-1"></i>
                            Create Notification

                        </a>

                    </div>

                </div>

            </div>
        </div>

        {{-- Main HR Statistics --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Total Employees</p>
                            <h3 class="fw-bold mb-0">{{ $totalEmployee }}</h3>
                        </div>

                        <div class="rounded-circle bg-light-primary text-primary p-3">
                            <i class="bx bx-group fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Total Managers</p>
                            <h3 class="fw-bold mb-0">{{ $totalManager }}</h3>
                        </div>

                        <div class="rounded-circle bg-light-success text-success p-3">
                            <i class="bx bx-user-check fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Verified Employees</p>
                            <h3 class="fw-bold mb-0">{{ $verifiedEmployee }}</h3>
                        </div>

                        <div class="rounded-circle bg-light-info text-info p-3">
                            <i class="bx bx-badge-check fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Pending Verification</p>
                            <h3 class="fw-bold mb-0">{{ $pendingEmployee }}</h3>
                        </div>

                        <div class="rounded-circle bg-light-warning text-warning p-3">
                            <i class="bx bx-time-five fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Attendance Statistics --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Present Today</p>
                            <h3 class="fw-bold text-success mb-0">
                                {{ $presentToday }}
                            </h3>
                        </div>

                        <div class="rounded-circle bg-light-success text-success p-3">
                            <i class="bx bx-check-circle fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Late Today</p>
                            <h3 class="fw-bold text-warning mb-0">
                                {{ $lateToday }}
                            </h3>
                        </div>

                        <div class="rounded-circle bg-light-warning text-warning p-3">
                            <i class="bx bx-alarm fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Absent Today</p>
                            <h3 class="fw-bold text-danger mb-0">
                                {{ $absentToday }}
                            </h3>
                        </div>

                        <div class="rounded-circle bg-light-danger text-danger p-3">
                            <i class="bx bx-user-x fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted mb-1">Working Hours Today</p>
                            <h3 class="fw-bold text-primary mb-0">
                                {{ number_format((float) $workingHours, 1) }}
                            </h3>
                        </div>

                        <div class="rounded-circle bg-light-primary text-primary p-3">
                            <i class="bx bx-time fs-3"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Task Statistics --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-5 g-3 mb-4">

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Total Tasks</p>
                        <h3 class="fw-bold mb-0">
                            {{ $taskStats['total'] }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Completed</p>
                        <h3 class="fw-bold text-success mb-0">
                            {{ $taskStats['completed'] }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Pending</p>
                        <h3 class="fw-bold text-warning mb-0">
                            {{ $taskStats['pending'] }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">In Progress</p>
                        <h3 class="fw-bold text-info mb-0">
                            {{ $taskStats['progress'] }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Overdue</p>
                        <h3 class="fw-bold text-danger mb-0">
                            {{ $taskStats['overdue'] }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- Managers Overview --}}
<div class="card border-0 shadow-sm radius-10 mb-4">

    <div class="card-header bg-transparent border-0 py-3">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">

            <div>
                <h5 class="fw-bold mb-1">
                    Managers Overview
                </h5>

                <p class="text-muted mb-0">
                    Department, designation and assigned employee information.
                </p>
            </div>

            <a href="{{ route('admin.managers.index') }}"
               class="btn btn-sm btn-outline-primary">

                View All Managers

            </a>

        </div>

    </div>

    <div class="card-body pt-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>Manager</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Employees</th>
                        <th>Joining Date</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($managers as $manager)

                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <img
                                        src="{{ $manager->photo
                                            ? asset('uploads/managers/' . $manager->photo)
                                            : asset('assets/images/avatars/avatar-1.png') }}"
                                        width="44"
                                        height="44"
                                        class="rounded-circle object-fit-cover"
                                        alt="Manager">

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $manager->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $manager->email }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>
                                {{ $manager->designation ?? 'Manager' }}
                            </td>

                            <td>

                                @if($manager->department)

                                    <span class="badge bg-light-primary text-primary">
                                        {{ $manager->department }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        Not Assigned
                                    </span>

                                @endif

                            </td>

                            <td>

                                <span class="badge bg-light-success text-success px-3 py-2">

                                    <i class="bx bx-group me-1"></i>

                                    {{ $manager->employees_count }}

                                </span>

                            </td>

                            <td>
                                {{ optional($manager->joining_date)->format('d M Y') ?? 'N/A' }}
                            </td>

                            <td>

                                @if($manager->verification_status === 'Verified')

                                    <span class="badge bg-success">
                                        Verified
                                    </span>

                                @elseif($manager->verification_status === 'Pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Active
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <i class="bx bx-user-x display-5 text-muted"></i>

                                <p class="text-muted mt-3 mb-0">
                                    No managers found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

        {{-- Task Chart and Top Performer --}}
        <div class="row g-4 mb-4">

            <div class="col-xl-8">

                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Company Task Overview
                                </h5>

                                <p class="text-muted mb-0">
                                    Company-wide task status distribution.
                                </p>
                            </div>

                            <i class="bx bx-pie-chart-alt-2 fs-2 text-primary"></i>

                        </div>

                        <div id="adminTaskChart"></div>

                    </div>
                </div>

            </div>

            <div class="col-xl-4">

                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <div>
                                <h5 class="fw-bold mb-1">Top Performer</h5>
                                <p class="text-muted mb-0">
                                    Highest task completion rate.
                                </p>
                            </div>

                            <i class="bx bx-trophy fs-2 text-warning"></i>

                        </div>

                        @if($topPerformer && $topPerformer->employee)

                            @php
                                $topRate = $topPerformer->total_tasks > 0
                                    ? round(
                                        ($topPerformer->completed_tasks / $topPerformer->total_tasks) * 100,
                                        1
                                    )
                                    : 0;
                            @endphp

                            <div class="text-center py-3">

                                <img
                                    src="{{ $topPerformer->employee->photo
                                        ? asset('uploads/employees/' . $topPerformer->employee->photo)
                                        : asset('assets/images/avatars/avatar-1.png') }}"
                                    width="90"
                                    height="90"
                                    class="rounded-circle object-fit-cover border border-3 border-white shadow-sm"
                                    alt="Top Performer">

                                <h5 class="fw-bold mt-3 mb-1">
                                    {{ $topPerformer->employee->name }}
                                </h5>

                                <p class="text-muted mb-3">
                                    {{ $topPerformer->employee->designation ?? 'Employee' }}
                                </p>

                                <div class="row g-2">

                                    <div class="col-6">
                                        <div class="border rounded p-3">

                                            <small class="text-muted d-block">
                                                Completed
                                            </small>

                                            <h4 class="fw-bold text-success mb-0">
                                                {{ $topPerformer->completed_tasks }}
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="border rounded p-3">

                                            <small class="text-muted d-block">
                                                Success Rate
                                            </small>

                                            <h4 class="fw-bold text-primary mb-0">
                                                {{ $topRate }}%
                                            </h4>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="text-center py-5">

                                <i class="bx bx-user-x display-5 text-muted"></i>

                                <p class="text-muted mt-3 mb-0">
                                    No completed task data available.
                                </p>

                            </div>

                        @endif

                    </div>
                </div>

            </div>

        </div>

        {{-- Departments and Employee Status --}}
        <div class="row g-4 mb-4">

            <div class="col-xl-7">

                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body">

                        <h5 class="fw-bold mb-1">
                            Employees by Department
                        </h5>

                        <p class="text-muted mb-4">
                            Department-wise employee distribution.
                        </p>

                        @php
                            $maxDepartment = $departments->max('total') ?: 1;
                        @endphp

                        @forelse($departments as $department)

                            <div class="mb-4">

                                <div class="d-flex justify-content-between mb-2">

                                    <span>
                                        {{ $department->department ?: 'Not Assigned' }}
                                    </span>

                                    <span class="fw-semibold">
                                        {{ $department->total }}
                                    </span>

                                </div>

                                <div class="progress" style="height: 8px;">

                                    <div class="progress-bar"
                                         style="width: {{
                                            ($department->total / $maxDepartment) * 100
                                         }}%">
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-5">
                                <p class="text-muted mb-0">
                                    No department data available.
                                </p>
                            </div>

                        @endforelse

                    </div>
                </div>

            </div>

            <div class="col-xl-5">

                <div class="card border-0 shadow-sm radius-10 h-100">
                    <div class="card-body">

                        <h5 class="fw-bold mb-1">
                            Employee Status
                        </h5>

                        <p class="text-muted mb-4">
                            Current employee account summary.
                        </p>

                        <div class="row g-3 text-center">

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold mb-1">{{ $totalEmployee }}</h4>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold text-success mb-1">
                                        {{ $verifiedEmployee }}
                                    </h4>
                                    <small class="text-muted">Verified</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold text-warning mb-1">
                                        {{ $pendingEmployee }}
                                    </h4>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold text-primary mb-1">
                                        {{ $newEmployeesThisMonth }}
                                    </h4>
                                    <small class="text-muted">New This Month</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold mb-1">{{ $maleEmployee }}</h4>
                                    <small class="text-muted">Male</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded p-3">
                                    <h4 class="fw-bold mb-1">{{ $femaleEmployee }}</h4>
                                    <small class="text-muted">Female</small>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        {{-- Clock In / Clock Out --}}
        <div class="card border-0 shadow-sm radius-10 mb-4">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Today’s Clock-In / Clock-Out
                        </h5>

                        <p class="text-muted mb-0">
                            Employee attendance activity for today.
                        </p>
                    </div>

                    <span class="badge bg-light-primary text-primary px-3 py-2">
                        {{ $todayAttendance->count() }} Records
                    </span>

                </div>

            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>Employee</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Working Time</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($todayAttendance as $attendance)

                                @php
                                    $clockIn = $attendance->clock_in
                                        ? \Carbon\Carbon::parse($attendance->clock_in)
                                        : null;

                                    $clockOut = $attendance->clock_out
                                        ? \Carbon\Carbon::parse($attendance->clock_out)
                                        : null;

                                    $duration = $clockIn && $clockOut
                                        ? $clockIn->diffForHumans($clockOut, true)
                                        : null;
                                @endphp

                                <tr>

                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <img
                                                src="{{ $attendance->user?->photo
                                                    ? asset('uploads/employees/' . $attendance->user->photo)
                                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                                width="44"
                                                height="44"
                                                class="rounded-circle object-fit-cover"
                                                alt="Employee">

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $attendance->user->name ?? 'Unknown Employee' }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $attendance->user->designation ?? 'Employee' }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        @if($clockIn)

                                            <span class="text-success fw-semibold">
                                                <i class="bx bx-log-in-circle me-1"></i>
                                                {{ $clockIn->format('h:i A') }}
                                            </span>

                                        @else

                                            <span class="text-muted">Not Clocked In</span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($clockOut)

                                            <span class="text-danger fw-semibold">
                                                <i class="bx bx-log-out-circle me-1"></i>
                                                {{ $clockOut->format('h:i A') }}
                                            </span>

                                        @else

                                            <span class="badge bg-light-warning text-warning">
                                                Still Working
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $duration ?? 'In Progress' }}
                                    </td>

                                    <td>

                                        @if($clockOut)

                                            <span class="badge bg-success">
                                                Completed
                                            </span>

                                        @elseif($clockIn)

                                            <span class="badge bg-info">
                                                Working
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Absent
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-5">

                                        <i class="bx bx-time-five display-5 text-muted"></i>

                                        <p class="text-muted mt-3 mb-0">
                                            No attendance records found for today.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- Recent Tasks --}}
        <div class="card border-0 shadow-sm radius-10 mb-4">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <h5 class="fw-bold mb-1">Recent Tasks</h5>
                        <p class="text-muted mb-0">
                            Latest assigned employee tasks.
                        </p>
                    </div>

                    <a href="{{ route('admin.tasks.index') }}"
                       class="btn btn-sm btn-outline-primary">

                        View All

                    </a>

                </div>

            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>Employee</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentTasks as $task)

                                @php
                                    $isOverdue = $task->due_date
                                        && $task->due_date->isPast()
                                        && $task->status !== 'Completed';

                                    $taskStatus = $isOverdue
                                        ? 'Overdue'
                                        : $task->status;
                                @endphp

                                <tr>

                                    <td>

                                        <a href="{{ route('admin.tasks.show', $task) }}"
                                           class="fw-semibold text-dark">

                                            {{ \Illuminate\Support\Str::limit($task->title, 40) }}

                                        </a>

                                    </td>

                                    <td>
                                        {{ $task->employee->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $task->priority }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($taskStatus === 'Completed')

                                            <span class="badge bg-success">Completed</span>

                                        @elseif($taskStatus === 'Overdue')

                                            <span class="badge bg-danger">Overdue</span>

                                        @elseif($taskStatus === 'In Progress')

                                            <span class="badge bg-info">In Progress</span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                {{ $taskStatus }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="text-center py-5">

                                        No recent tasks found.

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- Recent Employees --}}
        <div class="card border-0 shadow-sm radius-10">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <h5 class="fw-bold mb-1">Recent Employees</h5>
                        <p class="text-muted mb-0">
                            Recently added employee accounts.
                        </p>
                    </div>

                    <a href="{{ route('admin.employees.index') }}"
                       class="btn btn-sm btn-outline-primary">

                        View All

                    </a>

                </div>

            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Joining Date</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($employees as $employee)

                                <tr>

                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <img
                                                src="{{ $employee->photo
                                                    ? asset('uploads/employees/' . $employee->photo)
                                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                                width="42"
                                                height="42"
                                                class="rounded-circle object-fit-cover"
                                                alt="Employee">

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $employee->name }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $employee->email }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>
                                        {{ $employee->designation ?? 'Not Assigned' }}
                                    </td>

                                    <td>
                                        {{ $employee->department ?? 'Not Assigned' }}
                                    </td>

                                    <td>
                                        {{ optional($employee->joining_date)->format('d M Y') ?? 'N/A' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-5">

                                        No employees found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.querySelector('#adminTaskChart');

    if (!chartElement || typeof ApexCharts === 'undefined') {
        return;
    }

    const chartData = @json($taskChart);

    const totalTasks = chartData.reduce(function (total, value) {
        return total + Number(value);
    }, 0);

    const chartOptions = {
        series: chartData,

        chart: {
            type: 'donut',
            height: 360,
            toolbar: {
                show: false
            }
        },

        labels: [
            'Completed',
            'Pending',
            'In Progress',
            'Overdue'
        ],

        legend: {
            position: 'bottom',
            fontSize: '14px'
        },

        dataLabels: {
            enabled: totalTasks > 0
        },

        stroke: {
            width: 3
        },

        plotOptions: {
            pie: {
                donut: {
                    size: '66%',

                    labels: {
                        show: true,

                        name: {
                            show: true
                        },

                        value: {
                            show: true
                        },

                        total: {
                            show: true,
                            label: 'Total Tasks',

                            formatter: function () {
                                return totalTasks;
                            }
                        }
                    }
                }
            }
        },

        noData: {
            text: 'No task data available'
        },

        responsive: [
            {
                breakpoint: 576,

                options: {
                    chart: {
                        height: 300
                    }
                }
            }
        ]
    };

    const taskChart = new ApexCharts(
        chartElement,
        chartOptions
    );

    taskChart.render();
});
</script>

@endsection
