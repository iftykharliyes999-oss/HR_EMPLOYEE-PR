@extends('admin.master')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card border-0 shadow-sm radius-10">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-1">
                            Employee Attendance
                        </h5>

                        <p class="text-muted mb-0">
                            View daily employee attendance details.
                        </p>
                    </div>

                    <form
                        method="GET"
                        action="{{ route('admin.attendance.index') }}"
                        class="d-flex gap-2">

                        <input
                            type="date"
                            name="date"
                            value="{{ $selectedDate }}"
                            class="form-control">

                        <button
                            type="submit"
                            class="btn btn-primary">

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
                                <th>Manager</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Working Hours</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($attendanceRows as $row)

                                @php
                                    $employee = $row['employee'];
                                    $attendance = $row['attendance'];
                                    $status = $row['status'];
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
                                                class="rounded-circle object-fit-cover"
                                                alt="Employee">

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
                                        {{ $employee->manager?->name ?? 'Not Assigned' }}
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

                                        <a
                                            href="{{ route(
                                                'admin.attendance.show',
                                                $employee->id
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary">

                                            View Details

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="text-center py-5">

                                        No employee attendance found.

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
