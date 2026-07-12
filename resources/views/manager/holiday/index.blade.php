@extends('manager.master')

@section('content')

<div class="page-content">

    <div class="card radius-10">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0">
                    <i class="bx bx-calendar-event text-primary"></i>
                    Company Holidays
                </h4>

                <small class="text-muted">
                    Official holiday schedule
                </small>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Holiday Name</th>

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
                                {{ $holidays->firstItem() + $key }}
                            </td>

                            <td>

                                <strong>
                                    {{ $holiday->title }}
                                </strong>

                                @if($holiday->description)

                                <br>

                                <small class="text-muted">
                                    {{ Str::limit($holiday->description,50) }}
                                </small>

                                @endif

                            </td>

                            <td>

                                {{ date('d M Y', strtotime($holiday->start_date)) }}

                            </td>

                            <td>

                                {{ date('d M Y', strtotime($holiday->end_date)) }}

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $holiday->total_days }}

                                    Day(s)

                                </span>

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

                                <div class="py-4">

                                    <i class="bx bx-calendar-x fs-1 text-muted"></i>

                                    <p class="mt-2 mb-0">

                                        No Holiday Found

                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $holidays->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
