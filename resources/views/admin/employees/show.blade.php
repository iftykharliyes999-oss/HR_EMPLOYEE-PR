@extends('admin.master')

@section('content')


<div class="page-content">

<div class="container-fluid">


<div class="card radius-10">


<div class="card-body p-4">



<div class="d-flex justify-content-between align-items-center">


<h5>
Employee Profile
</h5>


<a href="{{route('admin.employees.index')}}"
class="btn btn-secondary">


<i class="bx bx-arrow-back"></i>

Back

</a>


</div>


<hr>





<div class="row">





{{-- Profile Image --}}

<div class="col-md-4 text-center">


@if($employee->photo)


<img src="{{asset('uploads/employees/'.$employee->photo)}}"
class="rounded-circle mb-3"
width="150"
height="150"
style="object-fit:cover;">



@else


<img src="{{asset('assets/images/no-image.png')}}"
class="rounded-circle mb-3"
width="150"
height="150">



@endif




<h5>

{{$employee->name}}

</h5>



<p class="text-muted">

{{$employee->designation}}

</p>




@if($employee->verification_status=="verified")


<span class="badge bg-success">

Verified

</span>


@elseif($employee->verification_status=="rejected")


<span class="badge bg-danger">

Rejected

</span>


@else


<span class="badge bg-warning text-dark">

Pending Verification

</span>


@endif



</div>








{{-- Employee Information --}}


<div class="col-md-8">


<div class="row">



<div class="col-md-6 mb-3">


<label class="text-muted">
Email
</label>


<h6>
{{$employee->email}}
</h6>


</div>





<div class="col-md-6 mb-3">


<label class="text-muted">
Phone
</label>


<h6>
{{$employee->phone}}
</h6>


</div>






<div class="col-md-6 mb-3">


<label class="text-muted">
Department
</label>


<h6>
{{$employee->department}}
</h6>


</div>






<div class="col-md-6 mb-3">


<label class="text-muted">
Designation
</label>


<h6>
{{$employee->designation}}
</h6>


</div>







<div class="col-md-6 mb-3">


<label class="text-muted">
Salary
</label>


<h6>

{{number_format($employee->salary)}}

</h6>


</div>







<div class="col-md-6 mb-3">


<label class="text-muted">
Joining Date
</label>


<h6>

@if($employee->joining_date)

{{ $employee->joining_date->format('d M Y') }}

@endif

</h6>


</div>






<div class="col-md-6 mb-3">


<label class="text-muted">
Manager
</label>


<h6>


@if($employee->manager)

{{$employee->manager->name}}

@else

Not Assigned

@endif


</h6>


</div>






<div class="col-md-6 mb-3">


<label class="text-muted">
Gender
</label>


<h6>

{{$employee->gender}}

</h6>


</div>






<div class="col-12 mb-3">


<label class="text-muted">
Address
</label>


<h6>

{{$employee->address}}

</h6>


</div>




</div>


</div>




</div>





<hr>


<h5 class="mb-3">

NID Information

</h5>




<div class="row">



<div class="col-md-4 mb-3">


<label class="text-muted">
NID Number
</label>


<h6>

{{$employee->nid_number}}

</h6>


</div>





<div class="col-md-4 mb-3">


<label>
NID Front
</label>


@if($employee->nid_front)


<br>


<img src="{{asset('uploads/employees/nid/'.$employee->nid_front)}}"
width="180"
class="rounded">


@endif


</div>






<div class="col-md-4 mb-3">


<label>
NID Back
</label>


@if($employee->nid_back)


<br>


<img src="{{asset('uploads/employees/nid/'.$employee->nid_back)}}"
width="180"
class="rounded">


@endif


</div>



</div>




</div>


</div>


</div>


</div>


@endsection