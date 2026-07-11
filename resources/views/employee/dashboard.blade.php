@extends('employee.master')


@section('content')


<div class="page-wrapper">

<div class="page-content">



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

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">



<div class="col">

<div class="card radius-10">

<div class="card-body">


<h6>
Present Days
</h6>


<h2>
{{$present}}
</h2>


<i class="bx bx-check-circle fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<h6>
Late Days
</h6>


<h2>
{{$late}}
</h2>


<i class="bx bx-time fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<h6>
Absent Days
</h6>


<h2>
{{$absent}}
</h2>


<i class="bx bx-x-circle fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<h6>
Working Hours
</h6>


<h2>
{{$workingHours}}
</h2>


<i class="bx bx-hourglass fs-2"></i>


</div>

</div>

</div>


</div>







<div class="row">



<!-- Attendance -->

<div class="card radius-10">

<div class="card-body">


<h5>
Today's Attendance
</h5>


<hr>


@if(!$todayAttendance)


<form method="POST" action="{{route('attendance.clockin')}}">

@csrf

<button class="btn btn-success">
<i class="bx bx-log-in"></i>
Clock In
</button>


</form>



@elseif(!$todayAttendance->clock_out)



<p>
Clock In :
{{$todayAttendance->clock_in}}
</p>



<form method="POST" action="{{route('attendance.clockout')}}">

@csrf


<button class="btn btn-danger">

<i class="bx bx-log-out"></i>

Clock Out

</button>


</form>



@else


<p>
Clock In :
{{$todayAttendance->clock_in}}
</p>


<p>
Clock Out :
{{$todayAttendance->clock_out}}
</p>



<p>

Working Hours :

{{$todayAttendance->working_hours}}

Hours

</p>


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


<div class="card radius-10">


<div class="card-body">


<div class="d-flex">

<h5>
Today's Tasks
</h5>


<button class="btn btn-light btn-sm ms-auto">
View All
</button>


</div>



<hr>



<div class="row">



<div class="col-md-4">


<div class="alert alert-warning">

<i class="bx bx-task"></i>

<br>

Pending Task

<h3>
5
</h3>

</div>


</div>




<div class="col-md-4">


<div class="alert alert-success">

<i class="bx bx-check"></i>

<br>

Completed

<h3>
12
</h3>


</div>


</div>





<div class="col-md-4">


<div class="alert alert-danger">

<i class="bx bx-error"></i>

<br>

Overdue

<h3>
2
</h3>


</div>


</div>




</div>


</div>

</div>









<!-- Quick Action -->


<div class="card radius-10 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bx bx-bolt-circle text-primary"></i>
            Quick Actions
        </h5>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2">

            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                <i class="bx bx-user"></i>
                Edit Profile
            </a>

            <a href="{{ route('employee.leaves.create') }}" class="btn btn-success">
                <i class="bx bx-calendar-plus"></i>
                Apply Leave
            </a>

            <a href="{{ route('employee.leaves.index') }}" class="btn btn-outline-warning">
                <i class="bx bx-history"></i>
                Leave History
            </a>

        </div>

    </div>

</div>





</div>

</div>


@endsection
