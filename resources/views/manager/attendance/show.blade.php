@extends('manager.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    <div class="card radius-10 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-3">

                    <img
                        src="{{ $employee->photo
                            ? asset('uploads/employees/' . $employee->photo)
                            : asset('assets/images/avatars/avatar-1.png') }}"
                        width="75"
                        height="75"
                        class="rounded-circle object-fit-cover">

                    <div>

                        <h4 class="mb-1">
                            {{ $employee->name }}
                        </h4>

                        <p class="text-muted mb-0">
                            {{ $employee->designation ?? 'Employee' }}
                            ·
                            {{ $employee->department ?? 'No Department' }}
                        </p>

                    </div>

                </div>

                <form method="GET">

                    <input
                        type="month"
                        name="month"
                        value="{{ $month }}"
                        class="form-control"
                        onchange="this.form.submit()">

                </form>

            </div>

        </div>

    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <h3>{{ $summary['present'] }}</h3>
                    <p class="mb-0">Present</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <h3>{{ $summary['late'] }}</h3>
                    <p class="mb-0">Late</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <h3>{{ $summary['absent'] }}</h3>
                    <p class="mb-0">Absent</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <h3>{{ $summary['leave'] }}</h3>
                    <p class="mb-0">Leave</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <h3>{{ $summary['total_working_hours'] }}</h3>
                    <p class="mb-0">Working Hours</p>
                </div>
            </div>
        </div>

    </div>

    <div class="card radius-10">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Attendance History
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>Date</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Working Hours</th>
                            <th>Late Minutes</th>
                            <th>Status</th>
                            <th>Clock-in Approval</th>
                            <th>Clock-out Approval</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($attendances as $attendance)

                            <tr>

                                <td>
                                    {{ \Carbon\Carbon::parse(
                                        $attendance->date
                                    )->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $attendance->clock_in
                                        ? \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $attendance->clock_out
                                        ? \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $attendance->working_hours ?? '—' }}
                                </td>

                                <td>
                                    {{ (int) $attendance->late_minutes }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $attendance->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $attendance->clock_in_approval_status }}
                                </td>

                                <td>
                                    {{ $attendance->clock_out_approval_status }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="text-center py-4">

                                    No attendance history found.

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
