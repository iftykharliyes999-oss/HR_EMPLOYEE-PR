@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        {{-- Header --}}
        @include('admin.notifications.partials._header')

        {{-- Statistics Cards --}}
        @include('admin.notifications.partials._cards')

        {{-- Search & Filters --}}
        @include('admin.notifications.partials._filters')

        {{-- Notification Table --}}
        @include('admin.notifications.partials._table')

    </div>

</div>

@endsection
