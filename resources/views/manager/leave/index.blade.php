@extends('manager.master')

@section('content')

<div class="page-content">

    <div class="card radius-10">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="bx bx-calendar"></i>
                Leave Requests
            </h4>

            <span class="badge bg-primary">
                Total : {{ $leaves->total() }}
            </span>

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

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Employee</th>

                            <th>Leave Type</th>

                            <th>Date Range</th>

                            <th>Total Days</th>

                            <th>Manager Status</th>

                            <th>Admin Status</th>

                            <th width="120">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($leaves as $key => $leave)

                            <tr>

                                <td>
                                    {{ $leaves->firstItem() + $key }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        @if($leave->employee->photo)

                                            <img
                                                src="{{ asset('uploads/employees/'.$leave->employee->photo) }}"
                                                width="40"
                                                height="40"
                                                class="rounded-circle">

                                        @else

                                            <img
                                                src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                width="40"
                                                height="40"
                                                class="rounded-circle">

                                        @endif

                                        <div class="ms-2">

                                            <strong>
                                                {{ $leave->employee->name }}
                                            </strong>

                                            <br>

                                            <small class="text-muted">
                                                {{ $leave->employee->designation }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <span class="badge bg-info">

                                        {{ $leave->leave_type }}

                                    </span>

                                </td>

                                <td>

                                    {{ date('d M Y', strtotime($leave->start_date)) }}

                                    <br>

                                    <small class="text-muted">
                                        to
                                    </small>

                                    <br>

                                    {{ date('d M Y', strtotime($leave->end_date)) }}

                                </td>

                                <td>

                                    {{ $leave->total_days }} Day(s)

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

                                <td>

                                    @if($leave->admin_status == 'Pending')

                                        <span class="badge bg-warning">
                                            Pending
                                        </span>

                                    @elseif($leave->admin_status == 'Approved')

                                        <span class="badge bg-success">
                                            Approved
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('manager.leaves.show', $leave->id) }}"
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

</div>

@endsection
