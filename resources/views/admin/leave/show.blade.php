@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="card radius-10">

        <div class="card-header bg-white">

            <h4>
                Leave Details
            </h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Employee Name</th>
                    <td>{{ $leave->employee->name }}</td>
                </tr>

                <tr>
                    <th>Employee Email</th>
                    <td>{{ $leave->employee->email }}</td>
                </tr>

                <tr>
                    <th>Manager</th>
                    <td>{{ $leave->manager->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Leave Type</th>
                    <td>{{ $leave->leave_type }}</td>
                </tr>

                <tr>
                    <th>Start Date</th>
                    <td>{{ date('d M Y', strtotime($leave->start_date)) }}</td>
                </tr>

                <tr>
                    <th>End Date</th>
                    <td>{{ date('d M Y', strtotime($leave->end_date)) }}</td>
                </tr>

                <tr>
                    <th>Total Days</th>
                    <td>{{ $leave->total_days }}</td>
                </tr>

                <tr>
                    <th>Reason</th>
                    <td>{{ $leave->reason }}</td>
                </tr>

                @if($leave->attachment)

                <tr>

                    <th>Attachment</th>

                    <td>

                        <a href="{{ asset('uploads/leaves/'.$leave->attachment) }}"
                           target="_blank"
                           class="btn btn-primary btn-sm">

                            View Attachment

                        </a>

                    </td>

                </tr>

                @endif

                <tr>

                    <th>Manager Status</th>

                    <td>

                        @if($leave->manager_status == 'Pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($leave->manager_status == 'Approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif

                    </td>

                </tr>

                @if($leave->manager_comment)

                <tr>

                    <th>Manager Comment</th>

                    <td>

                        {{ $leave->manager_comment }}

                    </td>

                </tr>

                @endif

                <tr>

                    <th>Admin Status</th>

                    <td>

                        @if($leave->admin_status == 'Pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($leave->admin_status == 'Approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif

                    </td>

                </tr>

                @if($leave->admin_comment)

                <tr>

                    <th>Admin Comment</th>

                    <td>

                        {{ $leave->admin_comment }}

                    </td>

                </tr>

                @endif

            </table>




            @if(
                $leave->manager_status == 'Approved'
                &&
                $leave->admin_status == 'Pending'
            )

            <div class="row mt-4">

                <div class="col-md-6">

                    <form
                        action="{{ route('admin.leaves.approve',$leave->id) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <label>
                            Admin Comment (Optional)
                        </label>

                        <textarea
                            name="admin_comment"
                            class="form-control mb-3"
                            rows="3"></textarea>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Approve Leave

                        </button>

                    </form>

                </div>

                <div class="col-md-6">

                    <form
                        action="{{ route('admin.leaves.reject',$leave->id) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <label>
                            Rejection Reason
                        </label>

                        <textarea
                            name="admin_comment"
                            class="form-control mb-3"
                            rows="3"
                            required></textarea>

                        <button
                            type="submit"
                            class="btn btn-danger">

                            Reject Leave

                        </button>

                    </form>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection
