@extends('manager.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Employee Performance
                </h4>

                <p class="text-muted mb-0">
                    Task progress and completion overview.
                </p>
            </div>

            <a href="{{ route('manager.tasks.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>
                Back

            </a>

        </div>

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <div class="d-flex flex-wrap align-items-center gap-3">

                    <img
                        src="{{ $employee->photo
                            ? asset('uploads/employees/' . $employee->photo)
                            : asset('assets/images/avatars/avatar-1.png') }}"
                        width="78"
                        height="78"
                        class="rounded-circle object-fit-cover"
                        alt="Employee">

                    <div>

                        <h4 class="fw-bold mb-1">
                            {{ $employee->name }}
                        </h4>

                        <p class="text-muted mb-1">
                            {{ $employee->designation ?? 'Employee' }}
                        </p>

                        <small>
                            {{ $employee->email }}
                        </small>

                    </div>

                    <div class="ms-auto text-end">

                        <small class="text-muted d-block">
                            Completion Rate
                        </small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $completionRate }}%
                        </h2>

                    </div>

                </div>

            </div>

        </div>

        <div class="row g-3 mb-4">

            <div class="col-md-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Total Tasks</p>
                        <h3 class="fw-bold mb-0">{{ $total }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Completed</p>
                        <h3 class="fw-bold text-success mb-0">{{ $completed }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Pending</p>
                        <h3 class="fw-bold text-warning mb-0">{{ $pending }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">In Progress</p>
                        <h3 class="fw-bold text-info mb-0">{{ $inProgress }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-xl">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Overdue</p>
                        <h3 class="fw-bold text-danger mb-0">{{ $overdue }}</h3>
                    </div>
                </div>

            </div>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-transparent border-0 py-3">

                <h5 class="fw-bold mb-1">
                    Task History
                </h5>

                <small class="text-muted">
                    All tasks assigned to this employee.
                </small>

            </div>

            <div class="card-body pt-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Submitted At</th>
                                <th>Action</th>
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

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $task->title }}
                                        </div>

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($task->description, 45) }}
                                        </small>

                                    </td>

                                    <td>

                                        <span class="badge bg-secondary">
                                            {{ $task->priority }}
                                        </span>

                                    </td>

                                    <td>

                                        @if($displayStatus === 'Completed')

                                            <span class="badge bg-success">
                                                Completed
                                            </span>

                                        @elseif($displayStatus === 'Overdue')

                                            <span class="badge bg-danger">
                                                Overdue
                                            </span>

                                        @elseif($displayStatus === 'In Progress')

                                            <span class="badge bg-info">
                                                In Progress
                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                {{ $displayStatus }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ optional($task->submitted_at)->format('d M Y, h:i A') ?? 'Not Submitted' }}
                                    </td>

                                    <td>

                                        <a href="{{ route('manager.tasks.show', $task) }}"
                                           class="btn btn-sm btn-light">

                                            <i class="bx bx-show"></i>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="text-center py-5">

                                        No task history found.

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

@endsection
