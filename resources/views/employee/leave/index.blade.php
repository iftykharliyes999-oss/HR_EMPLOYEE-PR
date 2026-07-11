@extends('employee.master')

@section('content')

    <div class="page-content">

        <div class="card radius-10">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    <i class="bx bx-calendar"></i>
                    My Leave Applications
                </h4>

                <a href="{{ route('employee.leaves.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i>
                    Apply Leave
                </a>

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

                                <th>Leave Type</th>

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Total Days</th>

                                <th>Manager</th>

                                <th>Admin</th>

                                <th>Applied</th>

                                <th width="180">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($leaves as $key => $leave)

                                <tr>

                                    <td>{{ $leaves->firstItem() + $key }}</td>

                                    <td>{{ $leave->leave_type }}</td>

                                    <td>{{ date('d M Y', strtotime($leave->start_date)) }}</td>

                                    <td>{{ date('d M Y', strtotime($leave->end_date)) }}</td>

                                    <td>{{ $leave->total_days }}</td>

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

                                        {{ $leave->created_at->format('d M Y') }}

                                    </td>

                                    <td>

                                        <a href="{{ route('employee.leaves.show', $leave->id) }}"
   class="btn btn-info btn-sm">
    <i class="bx bx-show"></i>
</a>

                                       @if($leave->manager_status == 'Pending' && $leave->admin_status == 'Pending')

    <a href="{{ route('employee.leaves.edit', $leave->id) }}"
       class="btn btn-warning btn-sm">

        <i class="bx bx-edit"></i>

    </a>

    <form action="{{ route('employee.leaves.destroy', $leave->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this leave application?')">

            <i class="bx bx-trash"></i>

        </button>

    </form>

@endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center">

                                        No Leave Application Found.

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
