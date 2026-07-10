

@extends('manager.master')


@section('content')


<div class="page-wrapper">

<div class="page-content">



<!-- Welcome -->

<div class="card radius-10">

<div class="card-body">


<div class="d-flex align-items-center">


<div>

<h4>
Welcome Back,
{{ auth()->user()->name }} 👋
</h4>


<p>
Manage your team members and daily activities
</p>


</div>


</div>


</div>

</div>




<!-- Cards -->


<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">



<div class="col">

<div class="card radius-10">

<div class="card-body">


<p>
Total Team Member
</p>


<h3>

{{ $totalEmployee }}

</h3>


<i class="bx bx-group fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<p>
Present Today
</p>


<h3>
0
</h3>


<i class="bx bx-calendar-check fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<p>
Pending Leave
</p>


<h3>
0
</h3>


<i class="bx bx-time fs-2"></i>


</div>

</div>

</div>





<div class="col">

<div class="card radius-10">

<div class="card-body">


<p>
Tasks
</p>


<h3>
0
</h3>


<i class="bx bx-task fs-2"></i>


</div>

</div>

</div>


</div>





<!-- Team Employee -->


<div class="card radius-10">


<div class="card-body">


<h5>
My Team Members
</h5>



<div class="table-responsive">


<table class="table">


<thead>

<tr>

<th>
Employee
</th>

<th>
Designation
</th>


<th>
Department
</th>

</tr>


</thead>



<tbody>



@foreach($employees as $employee)



<tr>


<td>


<div class="d-flex align-items-center">


@if($employee->photo)

<img src="{{asset('uploads/employees/'.$employee->photo)}}"

width="40"
height="40"

class="rounded-circle">


@else


<img src="{{asset('assets/images/avatars/avatar-1.png')}}"

width="40"
height="40"

class="rounded-circle">


@endif



<span class="ms-2">

{{ $employee->name }}

</span>



</div>


</td>



<td>

{{ $employee->designation }}

</td>


<td>

{{ $employee->department }}

</td>



</tr>



@endforeach




</tbody>


</table>


</div>



</div>


</div>






<!-- Recent Employee -->


<div class="row">


<div class="col-xl-6">


<div class="card radius-10">


<div class="card-body">


<h5>
Recent Added Employees
</h5>


<ul class="list-group">


@foreach($recentEmployees as $employee)


<li class="list-group-item bg-transparent">


{{ $employee->name }}


<span class="float-end">

{{ $employee->designation }}

</span>


</li>


@endforeach


</ul>


</div>


</div>


</div>





<!-- Manager Profile -->


<div class="col-xl-6">


<div class="card radius-10">


<div class="card-body text-center">


@if($manager->photo)

<img src="{{asset('uploads/employees/'.$manager->photo)}}"

width="90"
height="90"

class="rounded-circle">


@endif



<h4>

{{ $manager->name }}

</h4>


<p>

Manager

</p>


<p>

{{ $manager->department }}

</p>



</div>


</div>


</div>



</div>




</div>

</div>


@endsection
