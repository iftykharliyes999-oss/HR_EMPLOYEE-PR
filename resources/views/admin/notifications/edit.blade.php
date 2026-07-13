@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="mb-1 fw-bold">
                    Edit Notice
                </h4>

                <p class="text-muted mb-0">
                    Update company notice
                </p>

            </div>

            <a href="{{ route('admin.notifications.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back"></i>

                Back

            </a>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('admin.notifications.update', $notification) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    @include('admin.notifications.partials._form')

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
