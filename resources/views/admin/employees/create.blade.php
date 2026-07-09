@extends('admin.master')

@section('content')


<div class="page-content">

<div class="container-fluid">


<div class="card radius-10">

<div class="card-body p-4">


<h5>
Add Employee
</h5>

<hr>


<form action="{{route('admin.employees.store')}}"
method="POST"
enctype="multipart/form-data">

@csrf



<div class="row">



<div class="col-md-6 mb-3">

<label class="form-label">
Name
</label>

<input
type="text"
name="name"
class="form-control"
placeholder="Enter employee name">

</div>




<div class="col-md-6 mb-3">

<label class="form-label">
Email
</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter email">

</div>




<div class="col-md-6 mb-3">

<label class="form-label">
Password
</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter password">

</div>





<div class="col-md-6 mb-3">

<label>
Phone
</label>

<input
type="text"
name="phone"
class="form-control"
placeholder="Enter phone number">

</div>





<div class="col-md-6 mb-3">

<label>
Department
</label>


<select name="department"
class="form-select">


<option value="">
Select Department
</option>


<option value="IT">
IT
</option>


<option value="HR">
HR
</option>


<option value="Finance">
Finance
</option>


<option value="Marketing">
Marketing
</option>


</select>

</div>





<div class="col-md-6 mb-3">

<label>
Designation
</label>

<input
type="text"
name="designation"
class="form-control"
placeholder="Employee designation">

</div>





<div class="col-md-6 mb-3">

<label>
Salary
</label>

<input
type="number"
name="salary"
class="form-control"
placeholder="Salary">

</div>





<div class="col-md-6 mb-3">

<label>
Gender
</label>


<select name="gender"
class="form-select">


<option value="">
Select Gender
</option>


<option value="Male">
Male
</option>


<option value="Female">
Female
</option>


</select>


</div>





<div class="col-md-6 mb-3">

<label>
Joining Date
</label>


<input
type="date"
name="joining_date"
class="form-control">


</div>





<div class="col-md-6 mb-3">

<label>
Assign Manager
</label>


<select name="manager_id"
class="form-select">


<option value="">
Select Manager
</option>


@foreach($managers as $manager)


<option value="{{$manager->id}}">

{{$manager->name}}

</option>


@endforeach


</select>


</div>






<div class="col-12 mb-3">


<label>
Address
</label>


<textarea
name="address"
class="form-control"
rows="3"
placeholder="Employee address"></textarea>


</div>







<div class="col-md-6 mb-3">


<label class="form-label">
Employee Photo
</label>


<input
type="file"
name="photo"
class="form-control">


</div>






<div class="col-md-6 mb-3">


<label>
NID Number
</label>


<input
type="text"
name="nid_number"
class="form-control"
placeholder="NID number">


</div>







<div class="col-md-6 mb-3">


<label>
NID Front Image
</label>


<input
type="file"
name="nid_front"
class="form-control">


</div>







<div class="col-md-6 mb-3">


<label>
NID Back Image
</label>


<input
type="file"
name="nid_back"
class="form-control">


</div>








<div class="col-12">


<button class="btn btn-primary">

<i class="bx bx-save"></i>

Save Employee

</button>



<a href="{{route('admin.employees.index')}}"
class="btn btn-secondary">

<i class="bx bx-arrow-back"></i>

Back

</a>



</div>



</div>


</form>


</div>

</div>


</div>

</div>


@endsection