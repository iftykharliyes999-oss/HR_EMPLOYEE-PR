@extends('admin.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    {{-- Employee Header --}}

    <div class="card radius-10 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-3">

                    <img
                        src="{{ $employee->photo
                            ? asset('uploads/employees/'.$employee->photo)
                            : asset('assets/images/avatars/avatar-1.png') }}"
                        width="80"
                        height="80"
                        class="rounded-circle object-fit-cover">

                    <div>

                        <h4 class="mb-1">

                            {{ $employee->name }}

                        </h4>

                        <p class="mb-1 text-muted">

                            {{ $employee->designation }}

                        </p>

                        <small>

                            Department :
                            {{ $employee->department }}

                        </small>

                        <br>

                        <small>

                            Manager :
                            {{ $employee->manager?->name ?? 'Not Assigned' }}

                        </small>

                    </div>

                </div>

                <form method="GET">

                    <input
                        type="month"
                        class="form-control"
                        name="month"
                        value="{{ $month }}"
                        onchange="this.form.submit()">

                </form>

            </div>

        </div>

    </div>


    {{-- Summary --}}

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

        <div class="col">

            <div class="card radius-10 border-start border-success border-4">

                <div class="card-body">

                    <h3>

                        {{ $summary['present'] }}

                    </h3>

                    <p class="mb-0">

                        Present

                    </p>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card radius-10 border-start border-warning border-4">

                <div class="card-body">

                    <h3>

                        {{ $summary['late'] }}

                    </h3>

                    <p class="mb-0">

                        Late

                    </p>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card radius-10 border-start border-danger border-4">

                <div class="card-body">

                    <h3>

                        {{ $summary['absent'] }}

                    </h3>

                    <p class="mb-0">

                        Absent

                    </p>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card radius-10 border-start border-info border-4">

                <div class="card-body">

                    <h3>

                        {{ $summary['leave'] }}

                    </h3>

                    <p class="mb-0">

                        Leave

                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- Attendance History --}}

    <div class="card radius-10 mt-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Attendance History

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Date</th>

                            <th>Clock In</th>

                            <th>Clock Out</th>

                            <th>Working Hours</th>

                            <th>Late Minutes</th>

                            <th>Status</th>

                            <th>Clock In Approval</th>

                            <th>Clock Out Approval</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>

                                {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}

                            </td>

                            <td>

                                {{ $attendance->clock_in
                                    ? \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A')
                                    : '-' }}

                            </td>

                            <td>

                                {{ $attendance->clock_out
                                    ? \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A')
                                    : '-' }}

                            </td>

                            <td>

                                {{ $attendance->working_hours ?? '-' }}

                            </td>

                            <td>

                                {{ $attendance->late_minutes }}

                            </td>

                            <td>

                                @if($attendance->status=='Present')

                                    <span class="badge bg-success">

                                        Present

                                    </span>

                                @elseif($attendance->status=='Late')

                                    <span class="badge bg-warning text-dark">

                                        Late

                                    </span>

                                @elseif($attendance->status=='Leave')

                                    <span class="badge bg-info">

                                        Leave

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Absent

                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($attendance->clock_in_approval_status=='Approved')

                                    <span class="badge bg-success">

                                        Approved

                                    </span>

                                @elseif($attendance->clock_in_approval_status=='Rejected')

                                    <span class="badge bg-danger">

                                        Rejected

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($attendance->clock_out_approval_status=='Approved')

                                    <span class="badge bg-success">

                                        Approved

                                    </span>

                                @elseif($attendance->clock_out_approval_status=='Rejected')

                                    <span class="badge bg-danger">

                                        Rejected

                                    </span>

                                @elseif($attendance->clock_out_approval_status=='Pending')

                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Not Submitted

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                No Attendance Found

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
