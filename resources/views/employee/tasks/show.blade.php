@extends('employee.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">Task Details</h4>
                <p class="text-muted mb-0">
                    Review the task and submit your completed work.
                </p>
            </div>

            <a href="{{ route('employee.tasks.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>
                Back

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

                <div class="card border-0 shadow-sm mb-4">

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

                            <div>

                                <h6 class="fw-bold">Task Attachment</h6>

                                <a href="{{ asset($task->attachment) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary">

                                    <i class="bx bx-download me-1"></i>
                                    Download Attachment

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-transparent border-0 py-3">

                        <h5 class="fw-bold mb-1">
                            Submit Task
                        </h5>

                        <small class="text-muted">
                            Upload your completed work and add a short comment.
                        </small>

                    </div>

                    <div class="card-body pt-0">

                        @if($task->status === 'Completed')

                            <div class="alert alert-success mb-0">

                                <i class="bx bx-check-circle me-1"></i>

                                This task was submitted on

                                <strong>
                                    {{ optional($task->submitted_at)->format('d M Y, h:i A') }}
                                </strong>.

                            </div>

                            @if($task->employee_comment)

                                <div class="mt-3">

                                    <small class="text-muted d-block mb-1">
                                        Your Comment
                                    </small>

                                    <div class="border rounded p-3">
                                        {!! nl2br(e($task->employee_comment)) !!}
                                    </div>

                                </div>

                            @endif

                            @if($task->submitted_file)

                                <a href="{{ asset($task->submitted_file) }}"
                                   target="_blank"
                                   class="btn btn-outline-success mt-3">

                                    <i class="bx bx-file me-1"></i>
                                    View Submitted File

                                </a>

                            @endif

                        @else

                            <form action="{{ route('employee.tasks.submit', $task) }}"
                                  method="POST"
                                  enctype="multipart/form-data">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">
                                        Submission File
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="file"
                                           name="submitted_file"
                                           class="form-control @error('submitted_file') is-invalid @enderror">

                                    <small class="text-muted">
                                        Maximum file size: 10 MB.
                                    </small>

                                    @error('submitted_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Comment
                                    </label>

                                    <textarea name="employee_comment"
                                              rows="4"
                                              class="form-control @error('employee_comment') is-invalid @enderror"
                                              placeholder="Write a short submission note...">{{ old('employee_comment') }}</textarea>

                                    @error('employee_comment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <button type="submit"
                                        class="btn btn-success px-4"
                                        onclick="return confirm('Submit this task as completed?');">

                                    <i class="bx bx-upload me-1"></i>
                                    Submit Task

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

            <div class="col-xl-4">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Assigned By
                        </h5>

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="{{ $task->manager?->photo
                                    ? asset('uploads/managers/' . $task->manager->photo)
                                    : asset('assets/images/avatars/avatar-1.png') }}"
                                width="60"
                                height="60"
                                class="rounded-circle object-fit-cover"
                                alt="Manager">

                            <div>

                                <h6 class="fw-bold mb-1">
                                    {{ $task->manager->name ?? $task->creator->name ?? 'Admin' }}
                                </h6>

                                <p class="text-muted mb-0">
                                    {{ $task->manager?->designation ?? 'Task Assigner' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Task Timeline
                        </h5>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Assigned At
                            </small>

                            <strong>
                                {{ $task->created_at->format('d M Y, h:i A') }}
                            </strong>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Due Date
                            </small>

                            <strong class="{{ $isOverdue ? 'text-danger' : '' }}">
                                {{ optional($task->due_date)->format('d M Y') ?? 'N/A' }}
                            </strong>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Submitted At
                            </small>

                            <strong>
                                {{ optional($task->submitted_at)->format('d M Y, h:i A') ?? 'Not Submitted' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
