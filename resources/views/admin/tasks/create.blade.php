@extends('admin.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Create Task</h4>
                <p class="text-muted mb-0">
                    Assign a new task to an employee.
                </p>
            </div>

            <a href="{{ route('admin.tasks.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>
                Back

            </a>

        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.tasks.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @include('admin.tasks.partials._form')

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
