@extends('admin.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">


            <!-- Welcome Section -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div>
                            <h4 class="mb-1">Welcome Back, Adrian 👋</h4>
                            <p class="mb-0">
                                You have <b>21</b> Pending Approvals &
                                <b>14</b> Leave Requests
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
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div>
                                    <p class="mb-1">Attendance Overview</p>
                                    <h4 class="mb-0">120/154</h4>
                                </div>

                                <div class="ms-auto fs-2">
                                    <i class="bx bx-calendar-check"></i>
                                </div>

                            </div>

                            <hr>

                            <a href="#" class="text-white">
                                View Details
                            </a>

                        </div>
                    </div>
                </div>



                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div>
                                    <p class="mb-1">Total No of Projects</p>
                                    <h4 class="mb-0">90/125</h4>
                                </div>

                                <div class="ms-auto fs-2">
                                    <i class="bx bx-briefcase"></i>
                                </div>

                            </div>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>




                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div>
                                    <p class="mb-1">Total No of Clients</p>
                                    <h4 class="mb-0">69/86</h4>
                                </div>

                                <div class="ms-auto fs-2">
                                    <i class="bx bx-group"></i>
                                </div>

                            </div>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>





                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div>
                                    <p class="mb-1">Total No of Tasks</p>
                                    <h4 class="mb-0">96/100</h4>
                                </div>

                                <div class="ms-auto fs-2">
                                    <i class="bx bx-task"></i>
                                </div>

                            </div>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>



            </div>
            <!-- End Row -->




            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <p class="mb-1">
                                Earnings
                            </p>

                            <h4>
                                $21,445
                            </h4>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>



                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <p class="mb-1">
                                Profit This Week
                            </p>

                            <h4>
                                $5,544
                            </h4>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>




                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <p class="mb-1">
                                Job Applicants
                            </p>

                            <h4>
                                98
                            </h4>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>




                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">

                            <p class="mb-1">
                                New Hire
                            </p>

                            <h4>
                                45/48
                            </h4>

                            <hr>

                            <a href="#" class="text-white">
                                View All
                            </a>

                        </div>
                    </div>
                </div>


            </div>






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

                                    <small>
                                        No of Employees increased by +20% from last Week
                                    </small>

                                </div>

                            </div>



                            <div class="progress-wrapper mb-4">

                                <p>
                                    Development
                                    <span class="float-end">
                                        50
                                    </span>
                                </p>

                                <div class="progress">
                                    <div class="progress-bar bg-white" style="width:70%">
                                    </div>
                                </div>

                            </div>




                            <div class="progress-wrapper mb-4">

                                <p>
                                    Marketing
                                    <span class="float-end">
                                        35
                                    </span>
                                </p>

                                <div class="progress">
                                    <div class="progress-bar bg-white" style="width:50%">
                                    </div>
                                </div>

                            </div>





                            <div class="progress-wrapper mb-4">

                                <p>
                                    Finance
                                    <span class="float-end">
                                        25
                                    </span>
                                </p>

                                <div class="progress">
                                    <div class="progress-bar bg-white" style="width:35%">
                                    </div>
                                </div>

                            </div>



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


                                <div class="col-6">

                                    <h3>
                                        154
                                    </h3>

                                    <p>
                                        Total Employee
                                    </p>

                                </div>



                                <div class="col-6">

                                    <h3>
                                        112
                                    </h3>

                                    <p>
                                        Fulltime (48%)
                                    </p>

                                </div>




                                <div class="col-6">

                                    <h3>
                                        112
                                    </h3>

                                    <p>
                                        Contract (20%)
                                    </p>

                                </div>



                                <div class="col-6">

                                    <h3>
                                        12
                                    </h3>

                                    <p>
                                        Probation (22%)
                                    </p>

                                </div>



                                <div class="col-6">

                                    <h3>
                                        04
                                    </h3>

                                    <p>
                                        WFH (20%)
                                    </p>

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

<div class="row">


<div class="col-xl-6">

<div class="card radius-10">

<div class="card-body">

<div class="d-flex align-items-center mb-3">
<h5 class="mb-0">
Clock-In / Out
</h5>
</div>


<ul class="list-group list-group-flush">


<li class="list-group-item bg-transparent">
<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-2.png"
class="rounded-circle"
width="45"
height="45">


<div class="ms-3">

<h6 class="mb-0">
Daniel Esbella
</h6>

<small>
UI/UX Designer
</small>

</div>


<div class="ms-auto">
09:15
</div>


</div>
</li>



<li class="list-group-item bg-transparent">

<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-3.png"
class="rounded-circle"
width="45"
height="45">


<div class="ms-3">

<h6 class="mb-0">
Doglas Martini
</h6>

<small>
Project Manager
</small>

</div>


<div class="ms-auto">
09:36
</div>


</div>

</li>




<li class="list-group-item bg-transparent">

<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-4.png"
class="rounded-circle"
width="45"
height="45">


<div class="ms-3">

<h6 class="mb-0">
Brian Villalobos
</h6>

<small>
PHP Developer
</small>

</div>


<div class="ms-auto">
09:15
</div>


</div>

</li>


</ul>



<hr>


<div class="row text-center">

<div class="col">

<h5>
10:30 AM
</h5>

<p>
Clock In
</p>

</div>


<div class="col">

<h5>
09:45 AM
</h5>

<p>
Clock Out
</p>

</div>


<div class="col">

<h5>
09.21 Hrs
</h5>

<p>
Production
</p>

</div>


</div>


</div>

</div>

</div>






<!-- Job Applicants -->


<div class="col-xl-6">


<div class="card radius-10">

<div class="card-body">


<div class="d-flex align-items-center">

<h5 class="mb-0">
Jobs Applicants
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


<img src="{{asset('')}}assets/images/avatars/avatar-5.png"
class="rounded-circle"
width="45">


<div class="ms-3">

<h6 class="mb-0">
Brian Villalobos
</h6>

<small>
Exp : 5+ Years | USA
</small>

<p class="mb-0">
UI/UX Designer
</p>

</div>


</div>

</li>




<li class="list-group-item bg-transparent">

<div class="d-flex align-items-center">


<img src="{{asset('')}}assets/images/avatars/avatar-6.png"
class="rounded-circle"
width="45">


<div class="ms-3">

<h6 class="mb-0">
Anthony Lewis
</h6>

<small>
Exp : 4+ Years | USA
</small>

<p class="mb-0">
Python Developer
</p>

</div>


</div>

</li>





<li class="list-group-item bg-transparent">

<div class="d-flex align-items-center">


<img src="{{asset('')}}assets/images/avatars/avatar-7.png"
class="rounded-circle"
width="45">


<div class="ms-3">

<h6 class="mb-0">
Stephan Peralt
</h6>

<small>
Exp : 6+ Years | USA
</small>

<p class="mb-0">
Android Developer
</p>

</div>


</div>

</li>





<li class="list-group-item bg-transparent">

<div class="d-flex align-items-center">


<img src="{{asset('')}}assets/images/avatars/avatar-8.png"
class="rounded-circle"
width="45">


<div class="ms-3">

<h6 class="mb-0">
Doglas Martini
</h6>

<small>
Exp : 2+ Years | USA
</small>

<p class="mb-0">
React Developer
</p>

</div>


</div>

</li>


</ul>


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


<tr>

<td>

<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-2.png"
width="40"
class="rounded-circle">


<span class="ms-2">
Anthony Lewis
</span>

</div>

</td>


<td>
Finance
</td>


<td>
Finance
</td>


</tr>




<tr>

<td>

<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-3.png"
width="40"
class="rounded-circle">


<span class="ms-2">
Brian Villalobos
</span>

</div>

</td>


<td>
PHP Developer
</td>


<td>
Development
</td>


</tr>




<tr>

<td>

<div class="d-flex align-items-center">

<img src="{{asset('')}}assets/images/avatars/avatar-4.png"
width="40"
class="rounded-circle">


<span class="ms-2">
Stephan Peralt
</span>

</div>

</td>


<td>
Executive
</td>


<td>
Marketing
</td>


</tr>



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

if(ctx){

new Chart(ctx, {

type:'bar',

data:{

labels:[
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

datasets:[{

label:'Income',

data:[
40,30,45,80,85,90,80,82,80,85,20,80
],

backgroundColor:'#ff7f45'

}]


},

options:{

responsive:true,

plugins:{

legend:{
display:true
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


<img src="{{asset('')}}assets/images/avatars/avatar-1.png"
width="45"
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


<img src="{{asset('')}}assets/images/avatars/avatar-2.png"
width="45"
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


<img src="{{asset('')}}assets/images/avatars/avatar-3.png"
width="45"
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


<img src="{{asset('')}}assets/images/avatars/avatar-4.png"
width="45"
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

<div class="progress-bar bg-success"
style="width:40%">
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

<img src="{{asset('')}}assets/images/avatars/avatar-5.png"
width="50"
class="rounded-circle">


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

<img src="{{asset('')}}assets/images/avatars/avatar-6.png"
width="50"
class="rounded-circle">


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

<img src="{{asset('')}}assets/images/avatars/avatar-7.png"
width="50"
class="rounded-circle">


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
