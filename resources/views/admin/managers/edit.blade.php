@extends('admin.master')

@section('content')


<div class="page-content">

<div class="container-fluid">


<div class="card radius-10">

<div class="card-body p-4">


<h5>
Edit Manager
</h5>

<hr>


<form action="{{route('admin.managers.update',$manager->id)}}"
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
value="{{$manager->name}}">

</div>



<div class="col-md-6 mb-3">

<label class="form-label">
Email
</label>

<input
type="email"
name="email"
class="form-control"
value="{{$manager->email}}">

</div>



<div class="col-md-6 mb-3">

<label>
Phone
</label>

<input
type="text"
name="phone"
class="form-control"
value="{{$manager->phone}}">

</div>




<div class="col-md-6 mb-3">

<label>
Salary
</label>

<input
type="number"
name="salary"
class="form-control"
value="{{$manager->salary}}">

</div>




<div class="col-md-6 mb-3">

<label>
Department
</label>

<select name="department"
class="form-select">


<option value="IT"
@if($manager->department=="IT") selected @endif>
IT
</option>


<option value="Finance"
@if($manager->department=="Finance") selected @endif>
Finance
</option>


<option value="HR"
@if($manager->department=="HR") selected @endif>
HR
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
value="{{$manager->designation}}">

</div>




<div class="col-md-6 mb-3">

<label>
Joining Date
</label>

<input
type="date"
name="joining_date"
class="form-control"
value="{{$manager->joining_date}}">

</div>




<div class="col-12 mb-3">

<label>
Address
</label>

<textarea
name="address"
class="form-control"
rows="3">{{$manager->address}}</textarea>

</div>
<div class="col-md-6 mb-3">

<label class="form-label">
Current Photo
</label>


@if($manager->photo)

<div class="mb-2">

<img src="{{ asset('uploads/managers/'.$manager->photo) }}"
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


<label class="form-label">
Change Photo
</label>


<input
type="file"
name="photo"
class="form-control">

</div>




<div class="col-12">

<button class="btn btn-primary">

<i class="bx bx-save"></i>

Update Manager

</button>


<a href="{{route('admin.managers.index')}}"
class="btn btn-secondary">

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
