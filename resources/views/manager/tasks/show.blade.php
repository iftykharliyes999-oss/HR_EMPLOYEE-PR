@extends('manager.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">Task Details</h4>
                <p class="text-muted mb-0">
                    Review task information and employee submission.
                </p>
            </div>

            <a href="{{ route('manager.tasks.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>
                Back

            </a>

        </div>

        @php
            $isOverdue = $task->due_date
                && $task->due_date->isPast()
                && $task->status !== 'Completed';

            $displayStatus = $isOverdue
                ? 'Overdue'
                : $task->status;
        @endphp

        <div class="row g-4">

            <div class="col-xl-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">

                            <div>
                                <h3 class="fw-bold mb-1">
                                    {{ $task->title }}
                                </h3>

                                <small class="text-muted">
                                    Task #{{ $task->id }}
                                </small>
                            </div>

                            <div class="d-flex gap-2">

                                @switch($task->priority)

                                    @case('Urgent')
                                        <span class="badge bg-danger fs-6">Urgent</span>
                                        @break

                                    @case('High')
                                        <span class="badge bg-warning text-dark fs-6">High</span>
                                        @break

                                    @case('Medium')
                                        <span class="badge bg-info fs-6">Medium</span>
                                        @break

                                    @default
                                        <span class="badge bg-secondary fs-6">Low</span>

                                @endswitch

                                @switch($displayStatus)

                                    @case('Completed')
                                        <span class="badge bg-success fs-6">Completed</span>
                                        @break

                                    @case('In Progress')
                                        <span class="badge bg-info fs-6">In Progress</span>
                                        @break

                                    @case('Rejected')
                                        <span class="badge bg-dark fs-6">Rejected</span>
                                        @break

                                    @case('Overdue')
                                        <span class="badge bg-danger fs-6">Overdue</span>
                                        @break

                                    @default
                                        <span class="badge bg-warning text-dark fs-6">Pending</span>

                                @endswitch

                            </div>

                        </div>

                        <hr>

                        <h6 class="fw-bold mb-2">Description</h6>

                        <div class="border rounded p-3 bg-light mb-4">
                            {!! nl2br(e($task->description)) !!}
                        </div>

                        <div class="row g-3 mb-4">

                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Start Date
                                    </small>

                                    <strong>
                                        {{ optional($task->start_date)->format('d M Y') ?? 'Not Set' }}
                                    </strong>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Due Date
                                    </small>

                                    <strong class="{{ $isOverdue ? 'text-danger' : '' }}">
                                        {{ optional($task->due_date)->format('d M Y') ?? 'Not Set' }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                        @if($task->attachment)

                            <div class="mb-4">

                                <h6 class="fw-bold">Task Attachment</h6>

                                <a href="{{ asset($task->attachment) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary">

                                    <i class="bx bx-download me-1"></i>
                                    Download Attachment

                                </a>

                            </div>

                        @endif

                        <hr>

                        <h5 class="fw-bold mb-3">
                            Employee Submission
                        </h5>

                        @if($task->submitted_at)

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <div class="border rounded p-3 h-100">

                                        <small class="text-muted d-block mb-1">
                                            Submitted At
                                        </small>

                                        <strong>
                                            {{ $task->submitted_at->format('d M Y, h:i A') }}
                                        </strong>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="border rounded p-3 h-100">

                                        <small class="text-muted d-block mb-1">
                                            Submission Status
                                        </small>

                                        <span class="badge bg-success">
                                            Submitted
                                        </span>

                                    </div>

                                </div>

                                @if($task->employee_comment)

                                    <div class="col-md-12">

                                        <small class="text-muted d-block mb-1">
                                            Employee Comment
                                        </small>

                                        <div class="border rounded p-3">
                                            {!! nl2br(e($task->employee_comment)) !!}
                                        </div>

                                    </div>

                                @endif

                                @if($task->submitted_file)

                                    <div class="col-md-12">

                                        <a href="{{ asset($task->submitted_file) }}"
                                           target="_blank"
                                           class="btn btn-outline-success">

                                            <i class="bx bx-file me-1"></i>
                                            View Submitted File

                                        </a>

                                    </div>

                                @endif

                            </div>

                        @else

                            <div class="text-center border rounded py-5">

                                <i class="bx bx-time-five display-5 text-muted"></i>

                                <h6 class="fw-bold mt-3">
                                    Task Not Submitted Yet
                                </h6>

                                <p class="text-muted mb-0">
                                    The employee has not submitted this task.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

            <div class="col-xl-4">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Assigned Employee
                        </h5>

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="{{ $task->employee?->photo
                                    ? asset('uploads/employees/' . $task->employee->photo)
                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                width="64"
                                height="64"
                                class="rounded-circle object-fit-cover"
                                alt="Employee">

                            <div>

                                <h6 class="fw-bold mb-1">
                                    {{ $task->employee->name ?? 'N/A' }}
                                </h6>

                                <p class="text-muted mb-1">
                                    {{ $task->employee->designation ?? 'Employee' }}
                                </p>

                                <a href="{{ route('manager.tasks.employee.report', $task->employee) }}"
                                   class="btn btn-sm btn-outline-primary mt-1">

                                    View Performance

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Timeline
                        </h5>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Created At
                            </small>

                            <strong>
                                {{ $task->created_at->format('d M Y, h:i A') }}
                            </strong>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Started At
                            </small>

                            <strong>
                                {{ optional($task->started_at)->format('d M Y, h:i A') ?? 'Not Started' }}
                            </strong>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Completed At
                            </small>

                            <strong>
                                {{ optional($task->completed_at)->format('d M Y, h:i A') ?? 'Not Completed' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
