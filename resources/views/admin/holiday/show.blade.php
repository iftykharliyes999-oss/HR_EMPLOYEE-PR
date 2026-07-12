@extends('admin.master')

@section('content')

<div class="page-content">

<div class="card radius-10 shadow">

<div class="card-header bg-info text-white">

<h4>

Holiday Details

</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="250">

Holiday Name

</th>

<td>

{{ $holiday->title }}

</td>

</tr>

<tr>

<th>

Start Date

</th>

<td>

{{ date('d M Y',strtotime($holiday->start_date)) }}

</td>

</tr>

<tr>

<th>

End Date

</th>

<td>

{{ date('d M Y',strtotime($holiday->end_date)) }}

</td>

</tr>

<tr>

<th>

Total Days

</th>

<td>

{{ $holiday->total_days }} Days

</td>

</tr>

<tr>

<th>

Description

</th>

<td>

{{ $holiday->description ?? 'N/A' }}

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

@if($holiday->status=='Active')

<span class="badge bg-success">

Active

</span>

@else

<span class="badge bg-danger">

Inactive

</span>

@endif

</td>

</tr>

</table>

<a href="{{ route('admin.holidays.edit',$holiday->id) }}"
class="btn btn-warning">

Edit

</a>

<a href="{{ route('admin.holidays.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

@endsection
