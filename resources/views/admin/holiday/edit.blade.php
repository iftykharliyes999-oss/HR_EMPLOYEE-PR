@extends('admin.master')

@section('content')

<div class="page-content">

<div class="card radius-10 shadow">

<div class="card-header bg-warning">

<h4>

Edit Holiday

</h4>

</div>

<div class="card-body">

<form
action="{{ route('admin.holidays.update',$holiday->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>

Holiday Name

</label>

<input
type="text"
name="title"
value="{{ $holiday->title }}"
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
value="{{ $holiday->start_date }}"
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
value="{{ $holiday->end_date }}"
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
value="{{ $holiday->total_days }}"
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
class="form-control">{{ $holiday->description }}</textarea>

</div>

<div class="mt-4">

<button
class="btn btn-primary">

Update Holiday

</button>

<a href="{{ route('admin.holidays.index') }}"
class="btn btn-secondary">

Cancel

</a>

</div>

</form>

</div>

</div>

</div>

@endsection
