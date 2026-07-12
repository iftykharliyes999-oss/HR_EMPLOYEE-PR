@extends('employee.master')


@section('content')


<div >

<div>



<!-- Profile Card -->

<div class="card radius-10">

<div class="card-body">


<div class="d-flex align-items-center">


@if($employee->photo)

<img src="{{asset('uploads/employees/'.$employee->photo)}}"
width="100"
height="100"
class="rounded-circle">


@else

<img src="{{asset('assets/images/avatars/avatar-1.png')}}"
width="100"
class="rounded-circle">

@endif



<div class="ms-4">

<h3>
{{$employee->name}}
</h3>


<p class="mb-1">
{{$employee->designation}}
</p>


<p>
{{$employee->department}}
</p>


</div>



</div>


</div>

</div>






<!-- Statistics -->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">

    <div class="col">
        <div class="card border-start border-success border-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Present Days</h6>
                <h3>{{ $present }}</h3>
                <i class="bx bx-check-circle fs-1 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border-start border-warning border-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Late Days</h6>
                <h3>{{ $late }}</h3>
                <i class="bx bx-time-five fs-1 text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border-start border-danger border-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Absent Days</h6>
                <h3>{{ $absent }}</h3>
                <i class="bx bx-x-circle fs-1 text-danger"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border-start border-info border-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Working Time</h6>
                <h3>{{ $totalWorkingTime }}</h3>
                <i class="bx bx-timer fs-1 text-info"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card border-start border-primary border-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">This Month</h6>
                <h3>{{ $monthlyAttendance }}</h3>
                <i class="bx bx-calendar-check fs-1 text-primary"></i>
            </div>
        </div>
    </div>

</div>






<div class="row">



<!-- Attendance -->

<div class="card radius-10 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            <i class="bx bx-fingerprint text-success"></i>
            Today's Attendance
        </h5>

    </div>

    <div class="card-body">

        @if(!$todayAttendance)

            <div class="text-center">

                <h4 class="mb-3">
                    Not Clocked In Yet
                </h4>

                <form method="POST"
                      action="{{ route('attendance.clockin') }}">

                    @csrf

                    <button class="btn btn-success btn-lg">

                        <i class="bx bx-log-in-circle"></i>

                        Clock In

                    </button>

                </form>

            </div>

        @elseif(!$todayAttendance->clock_out)

            <div class="alert alert-success">

                Clock In:
                {{ $todayAttendance->clock_in }}

            </div>

            <form method="POST"
                  action="{{ route('attendance.clockout') }}">

                @csrf

                <button class="btn btn-danger">

                    <i class="bx bx-log-out-circle"></i>

                    Clock Out

                </button>

            </form>

        @else

            <table class="table">

                <tr>
                    <th>Clock In</th>
                    <td>{{ $todayAttendance->clock_in }}</td>
                </tr>

                <tr>
                    <th>Clock Out</th>
                    <td>{{ $todayAttendance->clock_out }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-success">
                            {{ $todayAttendance->status }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Working Hours</th>
                    <td>{{ $todayAttendance->working_hours }}</td>
                </tr>

            </table>

        @endif

    </div>

</div>





<!-- Profile Details -->

<div class="col-xl-6">


<div class="card radius-10">


<div class="card-body">


<h5>
My Information
</h5>


<hr>



<table class="table">


<tr>

<th>Email</th>

<td>
{{$employee->email}}
</td>

</tr>



<tr>

<th>Phone</th>

<td>
{{$employee->phone ?? 'N/A'}}
</td>

</tr>



<tr>

<th>Joining Date</th>

<td>
{{$employee->joining_date}}
</td>

</tr>




<tr>

<th>Salary</th>

<td>
{{$employee->salary}}
</td>

</tr>



</table>



</div>

</div>


</div>




</div>








<!-- Task Section -->


<div class="card radius-10 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bx bx-calendar-event text-danger"></i>

            Upcoming Holidays

        </h5>

    </div>

    <div class="card-body">

        <a href="{{ route('employee.holidays.index') }}"
           class="btn btn-outline-primary">

            View Holidays

        </a>

    </div>

</div>









<!-- Quick Action -->

<div class="card radius-10 shadow-sm">

    <div class="card-header bg-white">

        <h5>

            <i class="bx bx-bolt-circle text-primary"></i>

            Quick Actions

        </h5>

    </div>

    <div class="card-body">

        <div class="row g-3">

            <div class="col-md-4">

                <a href="{{ route('employee.profile') }}"
                   class="btn btn-outline-primary w-100">

                    <i class="bx bx-user"></i>

                    My Profile

                </a>

            </div>

            <div class="col-md-4">

                <a href="{{ route('employee.leaves.create') }}"
                   class="btn btn-success w-100">

                    <i class="bx bx-calendar-plus"></i>

                    Apply Leave

                </a>

            </div>

            <div class="col-md-4">

                <a href="{{ route('employee.leaves.index') }}"
                   class="btn btn-warning w-100">

                    <i class="bx bx-history"></i>

                    Leave History

                </a>

            </div>

        </div>

    </div>

</div>




</div>

</div>


@endsection
