@extends('manager.master')

@section('content')

<div class="page-content">

    <div class="card radius-10 shadow-sm">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-3 text-center">

                    @if($manager->photo)

                        <img
                            src="{{ asset('uploads/managers/'.$manager->photo) }}"
                            class="rounded-circle shadow"
                            width="150"
                            height="150">

                    @else

                        <img
                            src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                            class="rounded-circle shadow"
                            width="150">

                    @endif

                </div>

                <div class="col-md-9">

                    <h2 class="mb-1">
                        {{ $manager->name }}
                    </h2>

                    <h6 class="text-muted">
                        Manager
                    </h6>

                    <span class="badge bg-success">
                        Active
                    </span>

                </div>

            </div>

        </div>

    </div>



    <div class="card radius-10 mt-4">

        <div class="card-header bg-white">

            <h4 class="mb-0">
                Manager Information
            </h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Full Name</th>
                    <td>{{ $manager->name }}</td>
                </tr>

                <tr>
                    <th>Email Address</th>
                    <td>{{ $manager->email }}</td>
                </tr>

                <tr>
                    <th>Phone Number</th>
                    <td>{{ $manager->phone ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td>{{ $manager->department ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Designation</th>
                    <td>{{ $manager->designation ?? 'Manager' }}</td>
                </tr>

                <tr>
                    <th>Joining Date</th>
                    <td>{{ $manager->joining_date ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Salary</th>
                    <td>{{ $manager->salary ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-primary">
                            Manager
                        </span>
                    </td>
                </tr>

            </table>

        </div>

    </div>



    <div class="row mt-4">

        <div class="col-md-4">

            <div class="card radius-10 bg-primary text-white">

                <div class="card-body text-center">

                    <i class="bx bx-calendar-check fs-1"></i>

                    <h3>
                        {{ \App\Models\Leave::where('manager_id',$manager->id)->count() }}
                    </h3>

                    <p class="mb-0">
                        Total Requests
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card radius-10 bg-success text-white">

                <div class="card-body text-center">

                    <i class="bx bx-check-circle fs-1"></i>

                    <h3>
                        {{ \App\Models\Leave::where('manager_id',$manager->id)->where('manager_status','Approved')->count() }}
                    </h3>

                    <p class="mb-0">
                        Approved
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card radius-10 bg-danger text-white">

                <div class="card-body text-center">

                    <i class="bx bx-x-circle fs-1"></i>

                    <h3>
                        {{ \App\Models\Leave::where('manager_id',$manager->id)->where('manager_status','Rejected')->count() }}
                    </h3>

                    <p class="mb-0">
                        Rejected
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
