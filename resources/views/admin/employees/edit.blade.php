@extends('admin.master')

@section('content')


<div class="page-content">

<div class="container-fluid">


<div class="card radius-10">

<div class="card-body p-4">


<h5>
Edit Employee
</h5>

<hr>



<form action="{{route('admin.employees.update',$employee->id)}}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')



<div class="row">



<div class="col-md-6 mb-3">


<label class="form-label">
Name
</label>


<input
type="text"
name="name"
class="form-control"
value="{{$employee->name}}">


</div>





<div class="col-md-6 mb-3">


<label class="form-label">
Email
</label>


<input
type="email"
name="email"
class="form-control"
value="{{$employee->email}}">


</div>





<div class="col-md-6 mb-3">


<label>
Phone
</label>


<input
type="text"
name="phone"
class="form-control"
value="{{$employee->phone}}">


</div>





<div class="col-md-6 mb-3">


<label>
Salary
</label>


<input
type="number"
name="salary"
class="form-control"
value="{{$employee->salary}}">


</div>







<div class="col-md-6 mb-3">


<label>
Department
</label>



<select name="department"
class="form-select">


<option value="IT"
@if($employee->department=="IT") selected @endif>
IT
</option>


<option value="HR"
@if($employee->department=="HR") selected @endif>
HR
</option>


<option value="Finance"
@if($employee->department=="Finance") selected @endif>
Finance
</option>


<option value="Marketing"
@if($employee->department=="Marketing") selected @endif>
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
value="{{$employee->designation}}">


</div>







<div class="col-md-6 mb-3">


<label>
Joining Date
</label>


<input
type="date"
name="joining_date"
class="form-control"
value="{{$employee->joining_date?->format('Y-m-d')}}">


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


<option value="{{$manager->id}}"

@if($employee->manager_id==$manager->id)
selected
@endif

>

{{$manager->name}}

</option>



@endforeach


</select>


</div>







<div class="col-md-6 mb-3">


<label>
Gender
</label>


<select name="gender"
class="form-select">


<option value="Male"
@if($employee->gender=="Male") selected @endif>
Male
</option>


<option value="Female"
@if($employee->gender=="Female") selected @endif>
Female
</option>


</select>


</div>








<div class="col-12 mb-3">


<label>
Address
</label>


<textarea
name="address"
class="form-control"
rows="3">{{$employee->address}}</textarea>


</div>








{{-- Current Photo --}}


<div class="col-md-6 mb-3">


<label class="form-label">
Current Photo
</label>



@if($employee->photo)


<div class="mb-2">


<img src="{{asset('uploads/employees/'.$employee->photo)}}"
width="100"
height="100"
class="rounded"
style="object-fit:cover;">


</div>



@else


<p class="text-muted">
No photo uploaded
</p>


@endif





<label>
Change Photo
</label>


<input
type="file"
name="photo"
class="form-control">


</div>







{{-- NID --}}


<div class="col-md-6 mb-3">


<label>
NID Number
</label>


<input
type="text"
name="nid_number"
class="form-control"
value="{{$employee->nid_number}}">


</div>







<div class="col-md-6 mb-3">


<label>
Change NID Front
</label>


<input
type="file"
name="nid_front"
class="form-control">


@if($employee->nid_front)


<small class="text-muted">

Current: {{$employee->nid_front}}

</small>


@endif


</div>







<div class="col-md-6 mb-3">


<label>
Change NID Back
</label>


<input
type="file"
name="nid_back"
class="form-control">


@if($employee->nid_back)


<small class="text-muted">

Current: {{$employee->nid_back}}

</small>


@endif


</div>







<div class="col-12">


<button class="btn btn-primary">


<i class="bx bx-save"></i>


Update Employee


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