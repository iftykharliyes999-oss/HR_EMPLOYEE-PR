@extends('manager.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    <!-- Welcome Card -->

    <div class="card radius-10 bg-primary text-white">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">
                        Welcome Back, {{ $manager->name }} 👋
                    </h3>

                    <p class="mb-0">
                        Manage your team members, leave requests and daily activities.
                    </p>

                </div>

                <div>

                    @if($manager->photo)
    <img src="{{ asset('uploads/managers/'.$manager->photo) }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@else
    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@endif

                </div>

            </div>

        </div>
    </div>



    <!-- Statistics -->

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

        <div class="col">
            <div class="card radius-10 bg-primary text-white">
                <div class="card-body">

                    <h3>{{ $totalEmployee }}</h3>

                    <p class="mb-0">
                        Team Members
                    </p>

                    <i class="bx bx-group fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-warning">
                <div class="card-body">

                    <h3>{{ $pendingLeave }}</h3>

                    <p class="mb-0">
                        Pending Leaves
                    </p>

                    <i class="bx bx-time fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-success text-white">
                <div class="card-body">

                    <h3>{{ $approvedLeave }}</h3>

                    <p class="mb-0">
                        Approved Leaves
                    </p>

                    <i class="bx bx-check-circle fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-danger text-white">
                <div class="card-body">

                    <h3>{{ $rejectedLeave }}</h3>

                    <p class="mb-0">
                        Rejected Leaves
                    </p>

                    <i class="bx bx-x-circle fs-1"></i>

                </div>
            </div>
        </div>

    </div>



    <!-- Quick Actions -->

    <div class="card radius-10">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bx bx-bolt-circle text-primary"></i>

                Quick Actions

            </h5>

        </div>

        <div class="card-body">

            <a href="{{ route('manager.leaves.index') }}"
               class="btn btn-primary me-2">

                <i class="bx bx-calendar"></i>

                Leave Requests

            </a>

        </div>

    </div>



    <div class="row">

        <!-- Team Members -->

        <div class="col-xl-8">

            <div class="card radius-10">

                <div class="card-body">

                    <h5>
                        My Team Members
                    </h5>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>Employee</th>

                                    <th>Designation</th>

                                    <th>Department</th>

                                    <th>Email</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($employees as $employee)

                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center">

                                                @if($employee->photo)

                                                    <img src="{{ asset('uploads/employees/'.$employee->photo) }}"
                                                         width="45"
                                                         height="45"
                                                         class="rounded-circle">

                                                @else

                                                    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                         width="45"
                                                         height="45"
                                                         class="rounded-circle">

                                                @endif

                                                <span class="ms-2">

                                                    {{ $employee->name }}

                                                </span>

                                            </div>

                                        </td>

                                        <td>
                                            {{ $employee->designation }}
                                        </td>

                                        <td>
                                            {{ $employee->department }}
                                        </td>

                                        <td>
                                            {{ $employee->email }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center">

                                            No Team Member Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



        <!-- Manager Profile -->

        <div class="col-xl-4">

            <div class="card radius-10">

                <div class="card-body text-center">

                    @if($manager->photo)
    <img src="{{ asset('uploads/managers/'.$manager->photo) }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@else
    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@endif

                    <h4 class="mt-3">

                        {{ $manager->name }}

                    </h4>

                    <span class="badge bg-primary">

                        Manager

                    </span>

                    <hr>

                    <p>
                        <strong>Email:</strong>
                        {{ $manager->email }}
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        {{ $manager->phone ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Department:</strong>
                        {{ $manager->department }}
                    </p>

                    <p>
                        <strong>Designation:</strong>
                        {{ $manager->designation }}
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- Recent Leave Requests -->

    <div class="card radius-10">

        <div class="card-body">

            <h5>
                Recent Leave Requests
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Employee</th>

                            <th>Leave Type</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentLeaves as $leave)

                            <tr>

                                <td>
                                    {{ $leave->employee->name }}
                                </td>

                                <td>
                                    {{ $leave->leave_type }}
                                </td>

                                <td>

                                    @if($leave->manager_status == 'Pending')

                                        <span class="badge bg-warning">

                                            Pending

                                        </span>

                                    @elseif($leave->manager_status == 'Approved')

                                        <span class="badge bg-success">

                                            Approved

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Rejected

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3" class="text-center">

                                    No Leave Request Found

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
