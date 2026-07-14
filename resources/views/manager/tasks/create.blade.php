@extends('manager.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">Assign Task</h4>

                <p class="text-muted mb-0">
                    Create a task for an employee under your supervision.
                </p>
            </div>

            <a
                href="{{ route('manager.tasks.index') }}"
                class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>
                Back

            </a>

        </div>

        @if($employees->isEmpty())

            <div class="alert alert-warning shadow-sm">

                <i class="bx bx-error-circle me-1"></i>

                You currently have no employees assigned to you.
                Assign employees before creating a task.

            </div>

        @endif

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-transparent border-0 py-3">

                <h5 class="fw-bold mb-1">
                    Task Information
                </h5>

                <small class="text-muted">
                    Fill in the task details carefully.
                </small>

            </div>

            <div class="card-body pt-0">

                <form
                    action="{{ route('manager.tasks.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @include('manager.tasks.partials._form')

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
