@extends('employee.master')

@section('content')

    <div class="page-content">

        <div class="row">

            <div class="col-lg-8 mx-auto">

                <div class="card radius-10">

                    <div class="card-header d-flex justify-content-between">

                        <h4>

                            <i class="bx bx-detail"></i>

                            Leave Details

                        </h4>

                        <a href="{{ route('employee.leaves.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>

                                <th width="30%">
                                    Leave Type
                                </th>

                                <td>

                                    {{ $leave->leave_type }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Start Date

                                </th>

                                <td>

                                    {{ date('d M Y', strtotime($leave->start_date)) }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    End Date

                                </th>

                                <td>

                                    {{ date('d M Y', strtotime($leave->end_date)) }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Total Days

                                </th>

                                <td>

                                    {{ $leave->total_days }}

                                    Days

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Reason

                                </th>

                                <td>

                                    {{ $leave->reason }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Attachment

                                </th>

                                <td>

                                    @if($leave->attachment)

                                        <a href="{{ asset('uploads/leaves/' . $leave->attachment) }}" target="_blank"
                                            class="btn btn-sm btn-primary">

                                            View Attachment

                                        </a>

                                    @else

                                        <span class="text-muted">

                                            No Attachment

                                        </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Manager Status

                                </th>

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

                            <tr>

                                <th>

                                    Admin Status

                                </th>

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

                            </tr>

                            <tr>

                                <th>

                                    Applied On

                                </th>

                                <td>

                                    {{ $leave->created_at->format('d M Y h:i A') }}

                                </td>

                            </tr>


                            <tr>
    <th>Manager Status</th>
    <td>{{ $leave->manager_status }}</td>
</tr>

@if($leave->manager_comment)

<tr>
    <th>Manager Comment</th>
    <td>{{ $leave->manager_comment }}</td>
</tr>

@endif

<tr>
    <th>Admin Status</th>
    <td>{{ $leave->admin_status }}</td>
</tr>

@if($leave->admin_comment)

<tr>
    <th>Admin Comment</th>
    <td>{{ $leave->admin_comment }}</td>
</tr>

@endif

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
