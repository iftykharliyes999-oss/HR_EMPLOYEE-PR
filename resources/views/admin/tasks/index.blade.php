@extends('admin.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">Task Management</h4>
                <p class="text-muted mb-0">
                    Assign, monitor and manage employee tasks.
                </p>
            </div>

            <a href="{{ route('admin.tasks.create') }}"
               class="btn btn-primary px-4">

                <i class="bx bx-plus me-1"></i>
                Create Task

            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm"
                 role="alert">

                <i class="bx bx-check-circle me-1"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- Statistics Cards --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">Total Tasks</p>
                                <h3 class="fw-bold mb-0">
                                    {{ $stats['total'] }}
                                </h3>
                            </div>

                            <div class="rounded-circle bg-light-primary text-primary p-3">
                                <i class="bx bx-task fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">Completed</p>
                                <h3 class="fw-bold text-success mb-0">
                                    {{ $stats['completed'] }}
                                </h3>
                            </div>

                            <div class="rounded-circle bg-light-success text-success p-3">
                                <i class="bx bx-check-circle fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">Pending</p>
                                <h3 class="fw-bold text-warning mb-0">
                                    {{ $stats['pending'] }}
                                </h3>
                            </div>

                            <div class="rounded-circle bg-light-warning text-warning p-3">
                                <i class="bx bx-time-five fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">In Progress</p>
                                <h3 class="fw-bold text-info mb-0">
                                    {{ $stats['progress'] }}
                                </h3>
                            </div>

                            <div class="rounded-circle bg-light-info text-info p-3">
                                <i class="bx bx-loader-circle fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">Overdue</p>
                                <h3 class="fw-bold text-danger mb-0">
                                    {{ $stats['overdue'] }}
                                </h3>
                            </div>

                            <div class="rounded-circle bg-light-danger text-danger p-3">
                                <i class="bx bx-error-circle fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        {{-- Task Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">All Tasks</h5>
                        <small class="text-muted">
                            Latest assigned employee tasks
                        </small>
                    </div>

                    <span class="badge bg-light-primary text-primary px-3 py-2">
                        {{ $tasks->total() }} Records
                    </span>

                </div>

            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Employee</th>
                                <th>Manager</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($tasks as $task)

                                @php
                                    $isOverdue = $task->due_date
                                        && $task->due_date->isPast()
                                        && $task->status !== 'Completed';

                                    $displayStatus = $isOverdue
                                        ? 'Overdue'
                                        : $task->status;
                                @endphp

                                <tr>

                                    <td>
                                        {{ ($tasks->firstItem() ?? 1) + $loop->index }}
                                    </td>

                                    {{-- Task --}}
                                    <td style="min-width: 230px;">

                                        <div class="d-flex align-items-center gap-3">

                                            <div class="rounded-circle bg-light-primary text-primary p-2">
                                                <i class="bx bx-clipboard fs-4"></i>
                                            </div>

                                            <div>

                                                <a href="{{ route('admin.tasks.show', $task) }}"
                                                   class="fw-semibold text-dark">

                                                    {{ \Illuminate\Support\Str::limit($task->title, 35) }}

                                                </a>

                                                <div class="small text-muted mt-1">

                                                    {{ \Illuminate\Support\Str::limit($task->description, 45) }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Employee --}}
                                    <td style="min-width: 190px;">

                                        <div class="d-flex align-items-center gap-2">

                                            <img
                                                src="{{ $task->employee?->photo
                                                    ? asset('uploads/employees/' . $task->employee->photo)
                                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                                width="38"
                                                height="38"
                                                class="rounded-circle object-fit-cover"
                                                alt="Employee">

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $task->employee->name ?? 'N/A' }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $task->employee->designation ?? 'Employee' }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Manager --}}
                                    <td>

                                        @if($task->manager)

                                            <div class="fw-semibold">
                                                {{ $task->manager->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $task->manager->designation ?? 'Manager' }}
                                            </small>

                                        @else

                                            <span class="text-muted">Not Assigned</span>

                                        @endif

                                    </td>

                                    {{-- Priority --}}
                                    <td>

                                        @switch($task->priority)

                                            @case('Urgent')
                                                <span class="badge bg-danger">
                                                    Urgent
                                                </span>
                                                @break

                                            @case('High')
                                                <span class="badge bg-warning text-dark">
                                                    High
                                                </span>
                                                @break

                                            @case('Medium')
                                                <span class="badge bg-info">
                                                    Medium
                                                </span>
                                                @break

                                            @default
                                                <span class="badge bg-secondary">
                                                    Low
                                                </span>

                                        @endswitch

                                    </td>

                                    {{-- Status --}}
                                    <td>

                                        @switch($displayStatus)

                                            @case('Completed')
                                                <span class="badge bg-success">
                                                    <i class="bx bx-check me-1"></i>
                                                    Completed
                                                </span>
                                                @break

                                            @case('In Progress')
                                                <span class="badge bg-info">
                                                    <i class="bx bx-loader-circle me-1"></i>
                                                    In Progress
                                                </span>
                                                @break

                                            @case('Rejected')
                                                <span class="badge bg-dark">
                                                    Rejected
                                                </span>
                                                @break

                                            @case('Overdue')
                                                <span class="badge bg-danger">
                                                    <i class="bx bx-error me-1"></i>
                                                    Overdue
                                                </span>
                                                @break

                                            @default
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bx bx-time me-1"></i>
                                                    Pending
                                                </span>

                                        @endswitch

                                    </td>

                                    {{-- Due Date --}}
                                    <td>

                                        <div class="{{ $isOverdue ? 'text-danger fw-semibold' : '' }}">

                                            <i class="bx bx-calendar me-1"></i>

                                            {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}

                                        </div>

                                        @if($task->due_date)

                                            <small class="text-muted">
                                                {{ $task->due_date->diffForHumans() }}
                                            </small>

                                        @endif

                                    </td>

                                    {{-- Action --}}
                                    <td class="text-center">

                                        <div class="dropdown">

                                            <button
                                                class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-nocaret"
                                                type="button"
                                                data-bs-toggle="dropdown">

                                                <i class="bx bx-dots-vertical-rounded fs-5"></i>

                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                                                <li>

                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.tasks.show', $task) }}">

                                                        <i class="bx bx-show me-2 text-primary"></i>
                                                        View Details

                                                    </a>

                                                </li>

                                                <li>

                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.tasks.edit', $task) }}">

                                                        <i class="bx bx-edit me-2 text-warning"></i>
                                                        Edit Task

                                                    </a>

                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>

                                                    <form
                                                        action="{{ route('admin.tasks.destroy', $task) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this task?');">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="dropdown-item text-danger">

                                                            <i class="bx bx-trash me-2"></i>
                                                            Delete Task

                                                        </button>

                                                    </form>

                                                </li>

                                            </ul>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8"
                                        class="text-center py-5">

                                        <div class="mb-3">

                                            <i class="bx bx-task-x display-4 text-muted"></i>

                                        </div>

                                        <h5 class="fw-bold">
                                            No Tasks Found
                                        </h5>

                                        <p class="text-muted">
                                            Create and assign the first task to an employee.
                                        </p>

                                        <a href="{{ route('admin.tasks.create') }}"
                                           class="btn btn-primary">

                                            <i class="bx bx-plus me-1"></i>
                                            Create Task

                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if($tasks->hasPages())

                    <div class="d-flex justify-content-center mt-4">

                        {{ $tasks->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection
