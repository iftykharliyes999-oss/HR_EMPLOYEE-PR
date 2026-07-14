@php
    $layout = match (true) {
        auth()->user()->hasRole('Admin') => 'admin.master',
        auth()->user()->hasRole('Manager') => 'manager.master',
        auth()->user()->hasRole('Employee') => 'employee.master',
        default => 'admin.master',
    };
@endphp

@extends($layout)

@section('content')

<div class="page-content">

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="mb-1 fw-bold">
                    Notice Details
                </h4>

                <p class="text-muted mb-0">
                    View complete noti informceation.
                </p>

            </div>

            <div>



                <a href="
@if(auth()->user()->hasRole('Admin'))
    {{ route('admin.notifications.index') }}
@elseif(auth()->user()->hasRole('Manager'))
    {{ route('manager.dashboard') }}
@else
    {{ route('employee.dashboard') }}
@endif
" class="btn btn-secondary">

    <i class="bx bx-arrow-back"></i>

    Back

</a>

            </div>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-8">

                        <h3 class="fw-bold">

                            {{ $notification->title }}

                        </h3>

                    </div>

                    <div class="col-md-4 text-end">

                        {{-- Priority Badge --}}
                        @switch($notification->priority)

                            @case('Urgent')
                                <span class="badge bg-danger fs-6">
                                    Urgent
                                </span>
                                @break

                            @case('Important')
                                <span class="badge bg-warning text-dark fs-6">
                                    Important
                                </span>
                                @break

                            @default
                                <span class="badge bg-success fs-6">
                                    Normal
                                </span>

                        @endswitch

                    </div>

                </div>

                <hr>

                <div class="row mb-3">



                    @if(auth()->user()->hasRole('Admin'))

<div class="col-md-6">

    <strong>Audience</strong>

    <br>

    <span class="badge bg-info">
        {{ $notification->audience }}
    </span>

</div>

@endif


                    <div class="col-md-6">

                        <strong>Status</strong>

                        <br>

                        @if($notification->status == 'Published')

                            <span class="badge bg-success">

                                Published

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                        @endif

                    </div>

                </div>

                <div class="mb-4">

                    <label class="fw-bold">

                        Notification Message

                    </label>

                    <div class="border rounded p-3 mt-2 bg-light">

                        {!! nl2br(e($notification->message)) !!}

                    </div>

                </div>

                @if($notification->attachment)

                <div class="mb-4">

                    <label class="fw-bold">

                        Attachment

                    </label>

                    <br>

                    <a href="{{ asset('storage/'.$notification->attachment) }}"
                       target="_blank"
                       class="btn btn-outline-primary mt-2">

                        <i class="bx bx-download"></i>

                        Download Attachment

                    </a>

                </div>

                @endif

                <hr>

                <div class="row">

                    <div class="col-md-3">

                        <strong>Publish Date</strong>

                        <p>

                            {{ optional($notification->publish_at)->format('d M Y h:i A') ?? '-' }}

                        </p>

                    </div>

                    <div class="col-md-3">

                        <strong>Expire Date</strong>

                        <p>

                            {{ optional($notification->expire_at)->format('d M Y h:i A') ?? '-' }}

                        </p>

                    </div>

                    <div class="col-md-3">

                        <strong>Created By</strong>

                        <p>

                            {{ $notification->creator->name ?? '-' }}

                        </p>

                    </div>

                    <div class="col-md-3">

                        <strong>Created At</strong>

                        <p>

                            {{ $notification->created_at->format('d M Y h:i A') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
