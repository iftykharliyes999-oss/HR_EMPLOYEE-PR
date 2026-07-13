{{-- Notification Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="mb-1 fw-bold">
            Notice Management
        </h4>

        <p class="text-muted mb-0">
            Manage all company notice.
        </p>
    </div>

    <a href="{{ route('admin.notifications.create') }}"
       class="btn btn-primary">

        <i class="bx bx-plus"></i>

        Create Notice

    </a>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif
