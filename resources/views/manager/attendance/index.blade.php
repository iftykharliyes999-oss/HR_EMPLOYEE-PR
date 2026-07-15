@extends('manager.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    <div class="card radius-10">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-1">
                        Team Attendance
                    </h5>

                    <p class="text-muted mb-0">
                        Daily attendance overview of your team
                    </p>
                </div>

                <form method="GET"
                      action="{{ route('manager.attendance.index') }}"
                      class="d-flex gap-2">

                    <input
                        type="date"
                        name="date"
                        value="{{ $selectedDate }}"
                        class="form-control">

                    <button class="btn btn-primary">
                        Filter
                    </button>

                </form>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>Employee</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Working Hours</th>
                            <th>Status</th>
                            <th>Approval</th>
                            <th>Details</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($attendanceRows as $row)

                            @php
                                $employee = $row['employee'];
                                $attendance = $row['attendance'];
                                $status = $row['final_status'];
                            @endphp

                            <tr>

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <img
                                            src="{{ $employee->photo
                                                ? asset('uploads/employees/' . $employee->photo)
                                                : asset('assets/images/avatars/avatar-1.png') }}"
                                            width="42"
                                            height="42"
                                            class="rounded-circle object-fit-cover">

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $employee->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $employee->designation ?? 'Employee' }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    {{ $attendance?->clock_in
                                        ? \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $attendance?->clock_out
                                        ? \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A')
                                        : '—' }}
                                </td>

                                <td>
                                    {{ $attendance?->working_hours ?? '—' }}
                                </td>

                                <td>

                                    @if($status === 'Present')
                                        <span class="badge bg-success">
                                            Present
                                        </span>

                                    @elseif($status === 'Late')
                                        <span class="badge bg-warning text-dark">
                                            Late
                                        </span>

                                    @elseif($status === 'Leave')
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

                                    @if(!$attendance)
                                        <span class="text-muted">
                                            No attendance
                                        </span>
                                    @else
                                        <small class="d-block">
                                            In:
                                            {{ $attendance->clock_in_approval_status }}
                                        </small>

                                        <small class="d-block">
                                            Out:
                                            {{ $attendance->clock_out_approval_status }}
                                        </small>
                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route(
                                            'manager.attendance.show',
                                            $employee->id
                                        ) }}"
                                        class="btn btn-sm btn-primary">

                                        View Details

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center py-4">
                                    No team employee found.
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
