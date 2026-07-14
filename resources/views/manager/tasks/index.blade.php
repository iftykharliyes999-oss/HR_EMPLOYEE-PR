@extends('manager.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">Team Tasks</h4>

                <p class="text-muted mb-0">
                    Monitor assigned tasks and employee progress.
                </p>
            </div>

            <a href="{{ route('manager.tasks.create') }}"
               class="btn btn-primary px-4">

                <i class="bx bx-plus me-1"></i>
                Assign Task

            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show shadow-sm">

                <i class="bx bx-check-circle me-1"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>

        @endif

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

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">Assigned Tasks</h5>

                        <small class="text-muted">
                            Tasks assigned to your employees.
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
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Performance</th>
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

                                    <td style="min-width: 230px;">

                                        <a href="{{ route('manager.tasks.show', $task) }}"
                                           class="fw-semibold text-dark">

                                            {{ \Illuminate\Support\Str::limit($task->title, 35) }}

                                        </a>

                                        <div class="small text-muted mt-1">

                                            {{ \Illuminate\Support\Str::limit($task->description, 45) }}

                                        </div>

                                    </td>

                                    <td style="min-width: 200px;">

                                        <div class="d-flex align-items-center gap-2">

                                            <img
                                                src="{{ $task->employee?->photo
                                                    ? asset('uploads/employees/' . $task->employee->photo)
                                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                                width="40"
                                                height="40"
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

                                    <td>

                                        @switch($displayStatus)

                                            @case('Completed')
                                                <span class="badge bg-success">
                                                    Completed
                                                </span>
                                                @break

                                            @case('In Progress')
                                                <span class="badge bg-info">
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
                                                    Overdue
                                                </span>
                                                @break

                                            @default
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                        @endswitch

                                    </td>

                                    <td>

                                        <div class="{{ $isOverdue ? 'text-danger fw-semibold' : '' }}">

                                            <i class="bx bx-calendar me-1"></i>

                                            {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}

                                        </div>

                                    </td>

                                    <td>

                                        @if($task->employee)

                                            <a href="{{ route('manager.tasks.employee.report', $task->employee) }}"
                                               class="btn btn-sm btn-outline-primary">

                                                <i class="bx bx-bar-chart-alt-2 me-1"></i>
                                                Report

                                            </a>

                                        @else

                                            <span class="text-muted">N/A</span>

                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('manager.tasks.show', $task) }}"
                                           class="btn btn-sm btn-light">

                                            <i class="bx bx-show"></i>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8"
                                        class="text-center py-5">

                                        <i class="bx bx-task-x display-4 text-muted"></i>

                                        <h5 class="fw-bold mt-3">
                                            No Tasks Found
                                        </h5>

                                        <p class="text-muted">
                                            Assign the first task to an employee.
                                        </p>

                                        <a href="{{ route('manager.tasks.create') }}"
                                           class="btn btn-primary">

                                            <i class="bx bx-plus me-1"></i>
                                            Assign Task

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
