@extends('admin.master')

@section('content')

<div class="page-content">

```
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card radius-10 border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-muted">Total Requests</h6>
                <h3>{{ $totalLeaves }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card radius-10 border-start border-warning border-4">
            <div class="card-body">
                <h6 class="text-muted">Pending</h6>
                <h3>{{ $pendingLeaves }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card radius-10 border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-muted">Approved</h6>
                <h3>{{ $approvedLeaves }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card radius-10 border-start border-danger border-4">
            <div class="card-body">
                <h6 class="text-muted">Rejected</h6>
                <h3>{{ $rejectedLeaves }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="card radius-10">

    <div class="card-header bg-white">

        <h4 class="mb-0">
            <i class="bx bx-calendar"></i>
            Leave Management
        </h4>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>
                        <th>Employee</th>
                        <th>Manager</th>
                        <th>Leave Type</th>
                        <th>Total Days</th>
                        <th>Manager Status</th>
                        <th>Admin Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($leaves as $key => $leave)

                    <tr>

                        <td>
                            {{ $leaves->firstItem() + $key }}
                        </td>

                        <td>
                            {{ $leave->employee->name }}
                        </td>

                        <td>
                            {{ $leave->manager->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $leave->leave_type }}
                        </td>

                        <td>
                            {{ $leave->total_days }}
                        </td>

                        <td>

                            @if($leave->manager_status == 'Pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($leave->manager_status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif

                        </td>

                        <td>

                            @if($leave->admin_status == 'Pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($leave->admin_status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.leaves.show',$leave->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="bx bx-show"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No Leave Request Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $leaves->links() }}

        </div>

    </div>

</div>
```

</div>

@endsection
