@extends('manager.master')

@section('content')

<div class="page-content">

    <div class="card radius-10">

        <div class="card-header">
            <h4>Leave Details</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>Employee</th>
                    <td>{{ $leave->employee->name }}</td>
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
                    <th>Reason</th>
                    <td>{{ $leave->reason }}</td>
                </tr>

                @if($leave->manager_comment)

<tr>
    <th>Manager Comment</th>
    <td>{{ $leave->manager_comment }}</td>
</tr>

@endif

                <tr>
                    <th>Manager Status</th>
                    <td>{{ $leave->manager_status }}</td>
                </tr>

                <tr>
                    <th>Admin Status</th>
                    <td>{{ $leave->admin_status }}</td>
                </tr>

            </table>

            @if($leave->manager_status == 'Pending')

<div class="row mt-4">

    <div class="col-md-6">

        <form action="{{ route('manager.leaves.approve', $leave->id) }}"
              method="POST">

            @csrf
            @method('PATCH')

            <label class="form-label">
                Manager Comment (Optional)
            </label>

            <textarea
                name="manager_comment"
                class="form-control mb-3"
                rows="3"
                placeholder="Write approval note..."></textarea>

            <button type="submit"
                    class="btn btn-success">

                <i class="bx bx-check"></i>
                Approve Leave

            </button>

        </form>

    </div>



    <div class="col-md-6">

        <form action="{{ route('manager.leaves.reject', $leave->id) }}"
              method="POST">

            @csrf
            @method('PATCH')

            <label class="form-label">
                Rejection Reason
            </label>

            <textarea
                name="manager_comment"
                class="form-control mb-3"
                rows="3"
                required
                placeholder="Why are you rejecting this leave?"></textarea>

            <button type="submit"
                    class="btn btn-danger">

                <i class="bx bx-x"></i>
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
