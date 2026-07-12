@extends('employee.master')

@section('content')

<div class="page-content">

    <div class="card radius-10">

        <div class="card-body text-center">

            @if($employee->photo)

                <img
                    src="{{ asset('uploads/employees/'.$employee->photo) }}"
                    width="120"
                    height="120"
                    class="rounded-circle mb-3">

            @else

                <img
                    src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                    width="120"
                    height="120"
                    class="rounded-circle mb-3">

            @endif

            <h3>{{ $employee->name }}</h3>

            <p class="text-muted">
                {{ $employee->email }}
            </p>

        </div>

    </div>


    <div class="card radius-10 mt-4">

        <div class="card-header">

            <h5>
                Employee Information
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Name</th>
                    <td>{{ $employee->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $employee->phone ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $employee->department ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Designation</th>
                    <td>{{ $employee->designation ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Joining Date</th>
                    <td>{{ $employee->joining_date ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Salary</th>
                    <td>{{ $employee->salary ?? 'N/A' }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection
