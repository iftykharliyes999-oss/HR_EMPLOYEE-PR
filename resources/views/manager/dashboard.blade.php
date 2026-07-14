@extends('manager.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    <!-- Welcome Card -->

    <div class="card radius-10 bg-primary text-white">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">
                        Welcome Back, {{ $manager->name }} 👋
                    </h3>

                    <p class="mb-0">
                        Manage your team members, leave requests and daily activities.
                    </p>

                </div>

                <div>

                    @if($manager->photo)
    <img src="{{ asset('uploads/managers/'.$manager->photo) }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@else
    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@endif

                </div>

            </div>

        </div>
    </div>



    <!-- Statistics -->

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

        <div class="col">
            <div class="card radius-10 bg-primary text-white">
                <div class="card-body">

                    <h3>{{ $totalEmployee }}</h3>

                    <p class="mb-0">
                        Team Members
                    </p>

                    <i class="bx bx-group fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-warning">
                <div class="card-body">

                    <h3>{{ $pendingLeave }}</h3>

                    <p class="mb-0">
                        Pending Leaves
                    </p>

                    <i class="bx bx-time fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-success text-white">
                <div class="card-body">

                    <h3>{{ $approvedLeave }}</h3>

                    <p class="mb-0">
                        Approved Leaves
                    </p>

                    <i class="bx bx-check-circle fs-1"></i>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-danger text-white">
                <div class="card-body">

                    <h3>{{ $rejectedLeave }}</h3>

                    <p class="mb-0">
                        Rejected Leaves
                    </p>

                    <i class="bx bx-x-circle fs-1"></i>

                </div>
            </div>
        </div>

    </div>



    <!-- Quick Actions -->

    <div class="card radius-10">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bx bx-bolt-circle text-primary"></i>

                Quick Actions

            </h5>

        </div>

        <div class="card-body">

            <a href="{{ route('manager.leaves.index') }}"
               class="btn btn-primary me-2">

                <i class="bx bx-calendar"></i>

                Leave Requests

            </a>

        </div>

    </div>



    <div class="row">

        <!-- Team Members -->

        <div class="col-xl-8">

            <div class="card radius-10">

                <div class="card-body">

                    <h5>
                        My Team Members
                    </h5>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>Employee</th>

                                    <th>Designation</th>

                                    <th>Department</th>

                                    <th>Email</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($employees as $employee)

                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center">

                                                @if($employee->photo)

                                                    <img src="{{ asset('uploads/employees/'.$employee->photo) }}"
                                                         width="45"
                                                         height="45"
                                                         class="rounded-circle">

                                                @else

                                                    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                         width="45"
                                                         height="45"
                                                         class="rounded-circle">

                                                @endif

                                                <span class="ms-2">

                                                    {{ $employee->name }}

                                                </span>

                                            </div>

                                        </td>

                                        <td>
                                            {{ $employee->designation }}
                                        </td>

                                        <td>
                                            {{ $employee->department }}
                                        </td>

                                        <td>
                                            {{ $employee->email }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center">

                                            No Team Member Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



        <!-- Manager Profile -->

        <div class="col-xl-4">

            <div class="card radius-10">

                <div class="card-body text-center">

                    @if($manager->photo)
    <img src="{{ asset('uploads/managers/'.$manager->photo) }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@else
    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
         width="90"
         height="90"
         class="rounded-circle border border-3 border-white">
@endif

                    <h4 class="mt-3">

                        {{ $manager->name }}

                    </h4>

                    <span class="badge bg-primary">

                        Manager

                    </span>

                    <hr>

                    <p>
                        <strong>Email:</strong>
                        {{ $manager->email }}
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        {{ $manager->phone ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Department:</strong>
                        {{ $manager->department }}
                    </p>

                    <p>
                        <strong>Designation:</strong>
                        {{ $manager->designation }}
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- Recent Leave Requests -->

    <div class="card radius-10">

        <div class="card-body">

            <h5>
                Recent Leave Requests
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Employee</th>

                            <th>Leave Type</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentLeaves as $leave)

                            <tr>

                                <td>
                                    {{ $leave->employee->name }}
                                </td>

                                <td>
                                    {{ $leave->leave_type }}
                                </td>

                                <td>

                                    @if($leave->manager_status == 'Pending')

                                        <span class="badge bg-warning">

                                            Pending

                                        </span>

                                    @elseif($leave->manager_status == 'Approved')

                                        <span class="badge bg-success">

                                            Approved

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Rejected

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3" class="text-center">

                                    No Leave Request Found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="row g-4 mb-4">

    <div class="col-xl-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="fw-bold mb-1">Top Performer</h5>
                        <p class="text-muted mb-0">Best employee by completed tasks</p>
                    </div>

                    <div class="rounded-circle bg-light-warning text-warning p-3">
                        <i class="bx bx-trophy fs-3"></i>
                    </div>

                </div>

                @if($topPerformer && $topPerformer->employee)

                    @php
                        $topCompletionRate = $topPerformer->total > 0
                            ? round(($topPerformer->completed / $topPerformer->total) * 100, 1)
                            : 0;
                    @endphp

                    <div class="text-center py-3">

                        <img
                            src="{{ $topPerformer->employee->photo
                                ? asset('uploads/employees/' . $topPerformer->employee->photo)
                                : asset('assets/images/avatars/avatar-1.png') }}"
                            width="88"
                            height="88"
                            class="rounded-circle object-fit-cover border border-3 border-white shadow-sm"
                            alt="Top Performer">

                        <h5 class="fw-bold mt-3 mb-1">
                            {{ $topPerformer->employee->name }}
                        </h5>

                        <p class="text-muted mb-3">
                            {{ $topPerformer->employee->designation ?? 'Employee' }}
                        </p>

                        <div class="row g-2">

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Completed
                                    </small>

                                    <h4 class="fw-bold text-success mb-0">
                                        {{ $topPerformer->completed }}
                                    </h4>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Completion Rate
                                    </small>

                                    <h4 class="fw-bold text-primary mb-0">
                                        {{ $topCompletionRate }}%
                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="text-center py-5">

                        <i class="bx bx-user-x display-5 text-muted"></i>

                        <p class="text-muted mt-3 mb-0">
                            No employee task data available.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

        <div class="col-xl-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="fw-bold mb-1">Team Task Overview</h5>
                        <p class="text-muted mb-0">
                            Current task distribution across your team
                        </p>
                    </div>

                    <div class="rounded-circle bg-light-primary text-primary p-3">
                        <i class="bx bx-pie-chart-alt-2 fs-3"></i>
                    </div>

                </div>

                <div id="managerTaskChart"></div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-transparent border-0 py-3">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-1">Employee Performance Ranking</h5>
                <p class="text-muted mb-0">
                    Ranked by completed task count
                </p>
            </div>

            <i class="bx bx-bar-chart-alt-2 fs-3 text-primary"></i>

        </div>

    </div>

    <div class="card-body pt-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>Rank</th>
                        <th>Employee</th>
                        <th>Total Tasks</th>
                        <th>Completed</th>
                        <th>Pending</th>
                        <th>Completion Rate</th>
                        <th>Performance</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($employeeRanking as $ranking)

                        @php
                            $rankingRate = $ranking->total > 0
                                ? round(($ranking->completed / $ranking->total) * 100, 1)
                                : 0;

                            $rankingPending = $ranking->total - $ranking->completed;
                        @endphp

                        <tr>

                            <td>

                                @if($loop->iteration === 1)

                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        <i class="bx bx-trophy me-1"></i>
                                        #1
                                    </span>

                                @elseif($loop->iteration === 2)

                                    <span class="badge bg-secondary px-3 py-2">
                                        #2
                                    </span>

                                @elseif($loop->iteration === 3)

                                    <span class="badge bg-dark px-3 py-2">
                                        #3
                                    </span>

                                @else

                                    <span class="fw-semibold">
                                        #{{ $loop->iteration }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <img
                                        src="{{ $ranking->employee?->photo
                                            ? asset('uploads/employees/' . $ranking->employee->photo)
                                            : asset('assets/images/avatars/avatar-1.png') }}"
                                        width="42"
                                        height="42"
                                        class="rounded-circle object-fit-cover"
                                        alt="Employee">

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $ranking->employee->name ?? 'N/A' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $ranking->employee->designation ?? 'Employee' }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>
                                {{ $ranking->total }}
                            </td>

                            <td>
                                <span class="text-success fw-semibold">
                                    {{ $ranking->completed }}
                                </span>
                            </td>

                            <td>
                                <span class="text-warning fw-semibold">
                                    {{ $rankingPending }}
                                </span>
                            </td>

                            <td>
                                {{ $rankingRate }}%
                            </td>

                            <td style="min-width: 180px;">

                                <div class="progress"
                                     style="height: 9px;">

                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ $rankingRate }}%;"
                                        aria-valuenow="{{ $rankingRate }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bx bx-bar-chart-square display-5 text-muted"></i>

                                <p class="text-muted mt-3 mb-0">
                                    No employee performance data available.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.querySelector('#managerTaskChart');

    if (!chartElement) {
        return;
    }

    const chartData = [
        {{ $taskChart['completed'] }},
        {{ $taskChart['pending'] }},
        {{ $taskChart['progress'] }},
        {{ $taskChart['overdue'] }}
    ];

    const totalTasks = chartData.reduce(function (total, value) {
        return total + value;
    }, 0);

    const options = {
        series: chartData,

        chart: {
            type: 'donut',
            height: 350
        },

        labels: [
            'Completed',
            'Pending',
            'In Progress',
            'Overdue'
        ],

        legend: {
            position: 'bottom',
            fontSize: '14px'
        },

        dataLabels: {
            enabled: true
        },

        stroke: {
            width: 3
        },

        plotOptions: {
            pie: {
                donut: {
                    size: '66%',

                    labels: {
                        show: true,

                        total: {
                            show: true,
                            label: 'Total Tasks',
                            formatter: function () {
                                return totalTasks;
                            }
                        }
                    }
                }
            }
        },

        noData: {
            text: 'No task data available'
        },

        responsive: [
            {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 300
                    },

                    legend: {
                        position: 'bottom'
                    }
                }
            }
        ]
    };

    const chart = new ApexCharts(chartElement, options);

    chart.render();
});
</script>

@endsection
