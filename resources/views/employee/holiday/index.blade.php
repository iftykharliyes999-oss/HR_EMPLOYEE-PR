@extends('employee.master')

@section('content')

<div class="page-content">

    <!-- Header Card -->

    <div class="card radius-10 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="mb-1">
                        Upcoming Holidays
                    </h4>

                    <p class="text-muted mb-0">
                        Company announced holidays
                    </p>

                </div>

                <i class="bx bx-calendar-event fs-1 text-primary"></i>

            </div>

        </div>

    </div>



    <!-- Holiday Cards -->

    <div class="row">

        @forelse($holidays as $holiday)

        <div class="col-md-6 col-lg-4">

            <div class="card radius-10 border-start border-primary border-4 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <h5 class="fw-bold text-primary">

                            {{ $holiday->title }}

                        </h5>

                        <span class="badge bg-success">

                            {{ $holiday->status }}

                        </span>

                    </div>

                    <hr>

                    <p>

                        <strong>
                            Start:
                        </strong>

                        {{ date('d M Y', strtotime($holiday->start_date)) }}

                    </p>

                    <p>

                        <strong>
                            End:
                        </strong>

                        {{ date('d M Y', strtotime($holiday->end_date)) }}

                    </p>

                    <p>

                        <strong>
                            Total Days:
                        </strong>

                        {{ $holiday->total_days }}

                        Day(s)

                    </p>

                    @if($holiday->description)

                    <p class="text-muted">

                        {{ $holiday->description }}

                    </p>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-warning text-center">

                No Holiday Found

            </div>

        </div>

        @endforelse

    </div>



    <!-- Table View -->

    <div class="card radius-10 mt-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Holiday Schedule

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Holiday</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Total Days</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($holidays as $key => $holiday)

                        <tr>

                            <td>
                                {{ $key + 1 }}
                            </td>

                            <td>

                                <strong>

                                    {{ $holiday->title }}

                                </strong>

                            </td>

                            <td>

                                {{ date('d M Y', strtotime($holiday->start_date)) }}

                            </td>

                            <td>

                                {{ date('d M Y', strtotime($holiday->end_date)) }}

                            </td>

                            <td>

                                {{ $holiday->total_days }}

                            </td>

                            <td>

                                @if($holiday->status == 'Active')

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

                        @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                No Holiday Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
