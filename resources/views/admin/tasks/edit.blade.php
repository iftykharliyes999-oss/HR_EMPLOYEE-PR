@extends('admin.master')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Edit Task</h4>
                <p class="text-muted mb-0">
                    Update task information.
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

                <form action="{{ route('admin.tasks.update', $task) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @method('PUT')

                    @include('admin.tasks.partials._form')

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
