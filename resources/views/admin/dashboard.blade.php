@extends('admin.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">


            <!-- Welcome Section -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div>
                            <h4 class="mb-1">
                                Welcome Back, {{ auth()->user()->name }} 👋
                            </h4>

                            <p class="mb-0">
                                Today is {{ now()->format('l, d F Y') }}
                            </p>
                        </div>

                        <div class="ms-auto">
                            <button class="btn btn-light">
                                View Details
                            </button>
                        </div>

                    </div>
                </div>
            </div>



            <!-- Top Overview Cards -->
            <!-- ================= Dashboard Statistics ================= -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">

                <!-- Total Employees -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Total Employees</p>
                                    <h3 class="mb-0 fw-bold">{{ $totalEmployee }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Managers -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Total Managers</p>
                                    <h3 class="mb-0 fw-bold">{{ $totalManager }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Admin -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-dark text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Total Admins</p>
                                    <h3 class="mb-0 fw-bold">{{ $totalAdmin }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-shield-quarter"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verified -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Verified Employees</p>
                                    <h3 class="mb-0 fw-bold">{{ $verifiedEmployee }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-badge-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-warning text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Pending Employees</p>
                                    <h3 class="mb-0 fw-bold">{{ $pendingEmployee }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-time-five"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Present -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Present Today</p>
                                    <h3 class="mb-0 fw-bold">{{ $presentToday }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Late -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Late Today</p>
                                    <h3 class="mb-0 fw-bold">{{ $lateToday }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-alarm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Absent -->
                <div class="col">
                    <div class="card border-0 shadow-sm radius-10 bg-secondary text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-1">Absent Today</p>
                                    <h3 class="mb-0 fw-bold">{{ $absentToday }}</h3>
                                </div>
                                <div class="ms-auto display-5">
                                    <i class="bx bx-user-x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ================= End Dashboard Statistics ================= -->






            <!-- Employee Department + Status -->

            <div class="row">


                <div class="col-xl-7 col-lg-12">

                    <div class="card radius-10">

                        <div class="card-body">


                            <div class="d-flex align-items-center mb-3">

                                <div>
                                    <h5 class="mb-0">
                                        Employees By Department
                                    </h5>

                                    <small class="text-muted">
                                        Department wise employee distribution
                                    </small>

                                </div>

                            </div>



                            @php
                                $maxDepartment = $departments->max('total');
                            @endphp

                            @foreach($departments as $department)

                                <p class="mb-2">
                                    {{ $department->department }}
                                    <span class="float-end">
                                        {{ $department->total }}
                                    </span>
                                </p>

                                <div class="progress mb-4" style="height:8px;">
                                    <div class="progress-bar bg-primary"
                                        style="width: {{ $maxDepartment > 0 ? ($department->total / $maxDepartment) * 100 : 0 }}%">
                                    </div>
                                </div>

                            @endforeach



                        </div>

                    </div>

                </div>






                <div class="col-xl-5 col-lg-12">


                    <div class="card radius-10">

                        <div class="card-body">


                            <h5 class="mb-3">
                                Employee Status
                            </h5>


                            <div class="row text-center">

                                <div class="col-6 mb-4">
                                    <h3>{{ $totalEmployee }}</h3>
                                    <p>Total Employees</p>
                                </div>

                                <div class="col-6 mb-4">
                                    <h3>{{ $verifiedEmployee }}</h3>
                                    <p>Verified</p>
                                </div>

                                <div class="col-6 mb-4">
                                    <h3>{{ $pendingEmployee }}</h3>
                                    <p>Pending</p>
                                </div>

                                <div class="col-6 mb-4">
                                    <h3>{{ $maleEmployee }}</h3>
                                    <p>Male</p>
                                </div>

                                <div class="col-6">
                                    <h3>{{ $femaleEmployee }}</h3>
                                    <p>Female</p>
                                </div>

                                <div class="col-6">
                                    <h3>{{ $newEmployeesThisMonth }}</h3>
                                    <p>New This Month</p>
                                </div>

                            </div>



                        </div>

                    </div>



                </div>


            </div>






            <!-- Top Performer -->

            <div class="row">


                <div class="col-xl-4">

                    <div class="card radius-10">

                        <div class="card-body text-center">


                            <img src="{{ asset('') }}assets/images/avatars/avatar-1.png" class="rounded-circle mb-3"
                                width="90" height="90">


                            <h5>
                                Daniel Esbella
                            </h5>


                            <p>
                                IOS Developer
                            </p>


                            <h3>
                                99%
                            </h3>

                            <p>
                                Performance
                            </p>


                        </div>

                    </div>


                </div>






                <div class="col-xl-8">

                    <div class="card radius-10">

                        <div class="card-body">


                            <h5>
                                Attendance Overview
                            </h5>


                            <div class="row text-center mt-4">


                                <div class="col">
                                    <h3>
                                        120
                                    </h3>
                                    <p>Total Attendance</p>
                                </div>


                                <div class="col">
                                    <h3>
                                        59%
                                    </h3>
                                    <p>Present</p>
                                </div>


                                <div class="col">
                                    <h3>
                                        21%
                                    </h3>
                                    <p>Late</p>
                                </div>


                                <div class="col">
                                    <h3>
                                        15%
                                    </h3>
                                    <p>Absent</p>
                                </div>



                            </div>



                        </div>

                    </div>


                </div>


            </div>





        </div>
    </div>

    <!-- Clock In / Out -->

    <!-- Clock In / Out -->

    <div class="row">


        <div class="col-xl-6">


            <div class="card radius-10">


                <div class="card-body">


                    <h5 class="mb-3">
                        Clock-In / Out
                    </h5>



                    <ul class="list-group list-group-flush">



                        @foreach($todayAttendance as $attendance)


                            <li class="list-group-item bg-transparent">


                                <div class="d-flex align-items-center">



                                    @if($attendance->user->photo)

                                        <img src="{{asset('uploads/employees/' . $attendance->user->photo)}}" width="45" height="45"
                                            class="rounded-circle">


                                    @else

                                        <img src="{{asset('assets/images/avatars/avatar-1.png')}}" width="45" height="45"
                                            class="rounded-circle">

                                    @endif





                                    <div class="ms-3">


                                        <h6 class="mb-0">

                                            {{ $attendance->user->name }}

                                        </h6>



                                        <small>

                                            {{ $attendance->user->designation ?? 'Employee' }}

                                        </small>


                                    </div>




                                    <div class="ms-auto">


                                        {{ $attendance->clock_in }}

                                    </div>



                                </div>


                            </li>



                        @endforeach



                    </ul>





                    <hr>



                    <div class="row text-center">


                        <div class="col">


                            <h5>
                                {{ $presentToday }}
                            </h5>

                            <p>
                                Present Today
                            </p>

                        </div>




                        <div class="col">


                            <h5>
                                {{ $lateToday }}
                            </h5>

                            <p>
                                Late Today
                            </p>


                        </div>




                        <div class="col">


                            <h5>
                                {{ $workingHours }} Hrs
                            </h5>

                            <p>
                                Total Working Hours
                            </p>


                        </div>




                    </div>



                </div>


            </div>


        </div>







        <!-- Employees -->


        <div class="row">


            <div class="col-xl-8">


                <div class="card radius-10">

                    <div class="card-body">


                        <h5 class="mb-3">
                            Employees
                        </h5>



                        <div class="table-responsive">


                            <table class="table align-middle">


                                <thead>
                                    <tr>

                                        <th>
                                            Employee
                                        </th>

                                        <th>
                                            Designation
                                        </th>

                                        <th>
                                            Department
                                        </th>

                                    </tr>
                                </thead>



                                <tbody>

                                    @foreach($employees as $employee)

                                        <tr>

                                            <td>

                                                <div class="d-flex align-items-center">
                                                    @if($employee->photo)

                                                        <img src="{{ asset('uploads/employees/' . $employee->photo) }}" width="40"
                                                            height="40" class="rounded-circle">

                                                    @else

                                                        <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" width="40"
                                                            height="40" class="rounded-circle">

                                                    @endif


                                                    <span class="ms-2">
                                                        {{ $employee->name }}
                                                    </span>


                                                </div>

                                            </td>


                                            <td>

                                                {{ $employee->designation ?? 'Not Assigned' }}

                                            </td>


                                            <td>

                                                {{ $employee->department ?? 'Not Assigned' }}

                                            </td>


                                        </tr>


                                    @endforeach


                                </tbody>


                            </table>


                        </div>



                    </div>

                </div>


            </div>








            <!-- Todo -->

            <div class="col-xl-4">


                <div class="card radius-10">


                    <div class="card-body">


                        <h5>
                            Todo
                        </h5>


                        <hr>


                        <ul class="list-group">


                            <li class="list-group-item bg-transparent">
                                Add Holidays
                            </li>


                            <li class="list-group-item bg-transparent">
                                Add Meeting to Client
                            </li>


                            <li class="list-group-item bg-transparent">
                                Chat with Adrian
                            </li>


                            <li class="list-group-item bg-transparent">
                                Management Call
                            </li>


                            <li class="list-group-item bg-transparent">
                                Add Payroll
                            </li>


                            <li class="list-group-item bg-transparent">
                                Add Policy for Increment
                            </li>


                        </ul>


                    </div>


                </div>


            </div>


        </div>




        <div class="row">

            <div class="col-xl-6">

                <div class="card radius-10">

                    <div class="card-body">


                        <h5 class="mb-3">
                            Recent Managers
                        </h5>


                        <div class="table-responsive">


                            <table class="table">


                                <thead>

                                    <tr>

                                        <th>Name</th>

                                        <th>Email</th>

                                    </tr>

                                </thead>


                                <tbody>


                                    @foreach($managers as $manager)

                                        <tr>

                                            <td>
                                                {{ $manager->name }}
                                            </td>


                                            <td>
                                                {{ $manager->email }}
                                            </td>


                                        </tr>


                                    @endforeach


                                </tbody>


                            </table>


                        </div>


                    </div>

                </div>

            </div>

        </div>







        <!-- Sales Overview -->

        <div class="card radius-10">


            <div class="card-body">


                <div class="d-flex align-items-center">

                    <h5 class="mb-0">
                        Sales Overview
                    </h5>


                    <div class="ms-auto">

                        <span>
                            Income
                        </span>

                        &nbsp;&nbsp;

                        <span>
                            Expenses
                        </span>


                    </div>


                </div>


                <hr>



                <div class="chart-container-1">

                    <canvas id="salesChart"></canvas>

                </div>



            </div>


        </div>





        <script>

            var ctx = document.getElementById('salesChart');

            if (ctx) {

                new Chart(ctx, {

                    type: 'bar',

                    data: {

                        labels: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec'
                        ],

                        datasets: [{

                            label: 'Income',

                            data: [
                                40, 30, 45, 80, 85, 90, 80, 82, 80, 85, 20, 80
                            ],

                            backgroundColor: '#ff7f45'

                        }]


                    },

                    options: {

                        responsive: true,

                        plugins: {

                            legend: {
                                display: true
                            }

                        }

                    }

                });

            }

        </script>

        <!-- Invoice Section -->

        <div class="row">


            <div class="col-xl-5">


                <div class="card radius-10">


                    <div class="card-body">


                        <div class="d-flex align-items-center">

                            <h5 class="mb-0">
                                Invoices
                            </h5>


                            <div class="ms-auto">
                                <button class="btn btn-light btn-sm">
                                    View All
                                </button>
                            </div>

                        </div>


                        <hr>



                        <ul class="list-group list-group-flush">


                            <li class="list-group-item bg-transparent">


                                <div class="d-flex align-items-center">


                                    <img src="{{asset('')}}assets/images/avatars/avatar-1.png" width="45"
                                        class="rounded-circle">


                                    <div class="ms-3">

                                        <h6 class="mb-0">
                                            Redesign Website
                                        </h6>

                                        <small>
                                            #INVOO2 | Logistics
                                        </small>


                                    </div>


                                    <div class="ms-auto text-end">

                                        <p class="mb-0">
                                            Payment
                                        </p>

                                        <b>
                                            $3560
                                        </b>

                                        <br>

                                        <span class="badge bg-danger">
                                            Unpaid
                                        </span>


                                    </div>


                                </div>


                            </li>





                            <li class="list-group-item bg-transparent">


                                <div class="d-flex align-items-center">


                                    <img src="{{asset('')}}assets/images/avatars/avatar-2.png" width="45"
                                        class="rounded-circle">


                                    <div class="ms-3">

                                        <h6 class="mb-0">
                                            Module Completion
                                        </h6>

                                        <small>
                                            #INVOO5 | Yip Corp
                                        </small>


                                    </div>


                                    <div class="ms-auto text-end">

                                        <p>
                                            Payment
                                        </p>

                                        <b>
                                            $4175
                                        </b>

                                        <br>

                                        <span class="badge bg-danger">
                                            Unpaid
                                        </span>


                                    </div>


                                </div>


                            </li>






                            <li class="list-group-item bg-transparent">


                                <div class="d-flex align-items-center">


                                    <img src="{{asset('')}}assets/images/avatars/avatar-3.png" width="45"
                                        class="rounded-circle">


                                    <div class="ms-3">

                                        <h6>
                                            Change on Emp Module
                                        </h6>

                                        <small>
                                            #INVOO3 | Ignis LLP
                                        </small>


                                    </div>


                                    <div class="ms-auto text-end">

                                        <p>
                                            Payment
                                        </p>

                                        <b>
                                            $6985
                                        </b>

                                        <br>

                                        <span class="badge bg-danger">
                                            Unpaid
                                        </span>


                                    </div>


                                </div>


                            </li>





                            <li class="list-group-item bg-transparent">


                                <div class="d-flex align-items-center">


                                    <img src="{{asset('')}}assets/images/avatars/avatar-4.png" width="45"
                                        class="rounded-circle">


                                    <div class="ms-3">

                                        <h6>
                                            Hospital Management
                                        </h6>

                                        <small>
                                            #INVOO6 | HCL Corp
                                        </small>


                                    </div>


                                    <div class="ms-auto text-end">

                                        <p>
                                            Payment
                                        </p>

                                        <b>
                                            $6458
                                        </b>

                                        <br>

                                        <span class="badge bg-success">
                                            Paid
                                        </span>


                                    </div>


                                </div>


                            </li>


                        </ul>



                    </div>


                </div>


            </div>







            <!-- Projects -->


            <div class="col-xl-7">


                <div class="card radius-10">


                    <div class="card-body">


                        <div class="d-flex align-items-center">

                            <h5>
                                Projects
                            </h5>


                            <button class="btn btn-light btn-sm ms-auto">
                                September
                            </button>


                        </div>


                        <hr>



                        <div class="table-responsive">


                            <table class="table align-middle">


                                <thead>

                                    <tr>

                                        <th>
                                            ID
                                        </th>

                                        <th>
                                            Name
                                        </th>

                                        <th>
                                            Team
                                        </th>

                                        <th>
                                            Hours
                                        </th>

                                        <th>
                                            Priority
                                        </th>


                                    </tr>

                                </thead>



                                <tbody>


                                    <tr>

                                        <td>
                                            PRO-001
                                        </td>

                                        <td>
                                            Office Management App
                                        </td>

                                        <td>
                                            <i class="bx bx-user"></i>
                                            <i class="bx bx-user"></i>
                                        </td>

                                        <td>
                                            15/255 Hrs
                                        </td>

                                        <td>
                                            <span class="badge bg-danger">
                                                High
                                            </span>
                                        </td>

                                    </tr>




                                    <tr>

                                        <td>
                                            PRO-002
                                        </td>

                                        <td>
                                            Clinic Management
                                        </td>

                                        <td>
                                            <i class="bx bx-user"></i>
                                        </td>

                                        <td>
                                            15/255 Hrs
                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                Low
                                            </span>
                                        </td>

                                    </tr>





                                    <tr>

                                        <td>
                                            PRO-003
                                        </td>

                                        <td>
                                            Educational Platform
                                        </td>

                                        <td>
                                            <i class="bx bx-user"></i>
                                        </td>

                                        <td>
                                            40/255 Hrs
                                        </td>

                                        <td>

                                            <span class="badge bg-warning">
                                                Medium
                                            </span>

                                        </td>


                                    </tr>





                                    <tr>

                                        <td>
                                            PRO-004
                                        </td>

                                        <td>
                                            Chat & Call Mobile App
                                        </td>

                                        <td>
                                            <i class="bx bx-user"></i>
                                        </td>

                                        <td>
                                            35/155 Hrs
                                        </td>

                                        <td>
                                            <span class="badge bg-danger">
                                                High
                                            </span>
                                        </td>

                                    </tr>



                                </tbody>


                            </table>


                        </div>



                    </div>

                </div>


            </div>


        </div>








        <!-- Task Statistics -->


        <div class="row">


            <div class="col-xl-4">


                <div class="card radius-10">


                    <div class="card-body">


                        <h5>
                            Tasks Statistics
                        </h5>


                        <hr>


                        <h2>
                            124/165
                        </h2>

                        <p>
                            Total Tasks
                        </p>



                        <div class="progress mb-3">

                            <div class="progress-bar bg-success" style="width:40%">
                            </div>

                        </div>


                        <div class="row text-center">


                            <div class="col">

                                <h5>
                                    24%
                                </h5>

                                <small>
                                    Ongoing
                                </small>


                            </div>



                            <div class="col">

                                <h5>
                                    10%
                                </h5>

                                <small>
                                    On Hold
                                </small>


                            </div>



                            <div class="col">

                                <h5>
                                    16%
                                </h5>

                                <small>
                                    Overdue
                                </small>


                            </div>


                        </div>


                        <hr>


                        <h5>
                            389/689 hrs
                        </h5>

                        <p>
                            Spent on Overall Tasks This Week
                        </p>



                    </div>

                </div>


            </div>






            <!-- Schedule -->


            <div class="col-xl-4">


                <div class="card radius-10">


                    <div class="card-body">


                        <h5>
                            Schedules
                        </h5>


                        <hr>


                        <div class="border-bottom pb-3 mb-3">


                            <h6>
                                UI/UX Designer
                            </h6>


                            <p class="mb-0">
                                Interview Candidates - UI/UX Designer
                            </p>


                            <small>
                                Thu, 15 Feb 2025
                                <br>
                                01:00 PM - 02:20 PM
                            </small>


                        </div>



                        <div>


                            <h6>
                                IOS Developer
                            </h6>


                            <p>
                                Interview Candidates - IOS Developer
                            </p>


                            <small>
                                Thu, 15 Feb 2025
                                <br>
                                02:00 PM - 04:20 PM
                            </small>


                        </div>



                    </div>


                </div>


            </div>







            <!-- Recent Activity -->


            <div class="col-xl-4">


                <div class="card radius-10">


                    <div class="card-body">


                        <h5>
                            Recent Activities
                        </h5>


                        <hr>



                        <ul class="list-group">


                            <li class="list-group-item bg-transparent">

                                Matt Morgan
                                <br>

                                <small>
                                    Added New Project HRMS Dashboard
                                </small>

                                <span class="float-end">
                                    05:30 PM
                                </span>

                            </li>




                            <li class="list-group-item bg-transparent">

                                Jay Ze

                                <br>

                                <small>
                                    Commented on Uploaded Document
                                </small>


                                <span class="float-end">
                                    05:00 PM
                                </span>


                            </li>





                            <li class="list-group-item bg-transparent">

                                Mary Donald

                                <br>

                                <small>
                                    Approved Task Projects
                                </small>


                                <span class="float-end">
                                    05:30 PM
                                </span>


                            </li>




                            <li class="list-group-item bg-transparent">

                                George David

                                <br>

                                <small>
                                    Requesting Access to Module Tickets
                                </small>


                                <span class="float-end">
                                    06:00 PM
                                </span>


                            </li>



                        </ul>



                    </div>

                </div>


            </div>


        </div>







        <!-- Birthdays -->


        <div class="card radius-10">


            <div class="card-body">


                <div class="d-flex align-items-center">

                    <h5>
                        Birthdays
                    </h5>


                    <button class="btn btn-light btn-sm ms-auto">
                        View All
                    </button>


                </div>


                <hr>



                <div class="row">


                    <div class="col-md-4">

                        <div class="d-flex align-items-center">

                            <img src="{{asset('')}}assets/images/avatars/avatar-5.png" width="50" class="rounded-circle">


                            <div class="ms-3">

                                <h6>
                                    Andrew Jermia
                                </h6>

                                <small>
                                    IOS Developer
                                </small>

                            </div>


                        </div>

                    </div>




                    <div class="col-md-4">


                        <div class="d-flex align-items-center">

                            <img src="{{asset('')}}assets/images/avatars/avatar-6.png" width="50" class="rounded-circle">


                            <div class="ms-3">

                                <h6>
                                    Mary Zeen
                                </h6>

                                <small>
                                    UI/UX Designer
                                </small>

                            </div>


                        </div>


                    </div>





                    <div class="col-md-4">


                        <div class="d-flex align-items-center">

                            <img src="{{asset('')}}assets/images/avatars/avatar-7.png" width="50" class="rounded-circle">


                            <div class="ms-3">

                                <h6>
                                    Antony Lewis
                                </h6>

                                <small>
                                    Android Developer
                                </small>

                            </div>


                        </div>


                    </div>



                </div>


            </div>


        </div>
@endsection
