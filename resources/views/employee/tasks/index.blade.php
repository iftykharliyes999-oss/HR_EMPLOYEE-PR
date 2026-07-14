@extends('employee.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">My Tasks</h4>
                <p class="text-muted mb-0">
                    View your assigned tasks and track progress.
                </p>
            </div>
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

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Tasks</p>
                            <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
                        </div>

                        <div class="rounded-circle bg-light-primary text-primary p-3">
                            <i class="bx bx-task fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
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

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
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

            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
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

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-transparent border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Assigned Tasks</h5>
                        <small class="text-muted">
                            Latest tasks assigned to you.
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
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Manager</th>
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

                                        <a href="{{ route('employee.tasks.show', $task) }}"
                                           class="fw-semibold text-dark">

                                            {{ \Illuminate\Support\Str::limit($task->title, 35) }}

                                        </a>

                                        <div class="small text-muted mt-1">
                                            {{ \Illuminate\Support\Str::limit($task->description, 50) }}
                                        </div>

                                    </td>

                                    <td>
                                        @switch($task->priority)

                                            @case('Urgent')
                                                <span class="badge bg-danger">Urgent</span>
                                                @break

                                            @case('High')
                                                <span class="badge bg-warning text-dark">High</span>
                                                @break

                                            @case('Medium')
                                                <span class="badge bg-info">Medium</span>
                                                @break

                                            @default
                                                <span class="badge bg-secondary">Low</span>

                                        @endswitch
                                    </td>

                                    <td>
                                        @switch($displayStatus)

                                            @case('Completed')
                                                <span class="badge bg-success">Completed</span>
                                                @break

                                            @case('In Progress')
                                                <span class="badge bg-info">In Progress</span>
                                                @break

                                            @case('Rejected')
                                                <span class="badge bg-dark">Rejected</span>
                                                @break

                                            @case('Overdue')
                                                <span class="badge bg-danger">Overdue</span>
                                                @break

                                            @default
                                                <span class="badge bg-warning text-dark">Pending</span>

                                        @endswitch
                                    </td>

                                    <td>
                                        <div class="{{ $isOverdue ? 'text-danger fw-semibold' : '' }}">
                                            <i class="bx bx-calendar me-1"></i>
                                            {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $task->manager->name ?? 'Admin' }}
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('employee.tasks.show', $task) }}"
                                           class="btn btn-sm btn-primary">

                                            <i class="bx bx-show me-1"></i>
                                            View

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-5">

                                        <i class="bx bx-task-x display-4 text-muted"></i>

                                        <h5 class="fw-bold mt-3">
                                            No Tasks Assigned
                                        </h5>

                                        <p class="text-muted mb-0">
                                            You currently have no assigned tasks.
                                        </p>

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
