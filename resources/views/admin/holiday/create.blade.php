@extends('admin.master')

@section('content')

<div class="page-content">

<div class="row">

<div class="col-lg-8 mx-auto">

<div class="card radius-10 shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

Add New Holiday

</h4>

</div>

<div class="card-body">

<form action="{{ route('admin.holidays.store') }}"
method="POST">

@csrf

<div class="mb-3">

<label>

Holiday Name

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="row">

<div class="col-md-6">

<label>

Start Date

</label>

<input
type="date"
name="start_date"
id="start_date"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>

End Date

</label>

<input
type="date"
name="end_date"
id="end_date"
class="form-control"
required>

</div>

</div>

<div class="mt-3">

<label>

Total Days

</label>

<input
type="text"
id="total_days"
class="form-control"
readonly>

</div>

<div class="mt-3">

<label>

Description

</label>

<textarea
name="description"
rows="4"
class="form-control"></textarea>

</div>

<div class="mt-4">

<button
class="btn btn-primary">

Save Holiday

</button>

<a href="{{ route('admin.holidays.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection

@push('js')

<script>

let start=document.getElementById('start_date');
let end=document.getElementById('end_date');
let total=document.getElementById('total_days');

function calculateDays(){

if(start.value && end.value){

let s=new Date(start.value);
let e=new Date(end.value);

let diff=e-s;

let days=(diff/(1000*60*60*24))+1;

total.value=days>0?days:0;

}

}

start.addEventListener('change',calculateDays);
end.addEventListener('change',calculateDays);

</script>

@endpush
