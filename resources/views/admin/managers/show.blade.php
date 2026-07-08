@extends('admin.master')

@section('content')

    <div class="page-content">

        <div class="container-fluid">

            <div class="card radius-10 shadow">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bx bx-user-circle"></i> Manager Profile
                    </h4>

                    <a href="{{ route('admin.managers.index') }}" class="btn btn-light btn-sm">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </div>

                <div class="card-body">

                    <div class="row">

                        <!-- Left Side -->
                        <div class="col-lg-4 text-center border-end">

                            @if($manager->photo)

                                <img src="{{ asset('uploads/managers/' . $manager->photo) }}" width="180" height="180"
                                    class="rounded-circle shadow mb-3" style="object-fit:cover;">

                            @else

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($manager->name) }}&background=0D6EFD&color=fff&size=180"
                                    class="rounded-circle shadow mb-3">

                            @endif
                            <h4>{{ $manager->name }}</h4>

                            <span class="badge bg-success fs-6">
                                {{ $manager->designation }}
                            </span>

                            <hr>

                            <h3 class="text-success">
                                ৳ {{ number_format($manager->salary ?? 0) }}
                            </h3>

                            <small class="text-muted">
                                Monthly Salary
                            </small>

                        </div>

                        <!-- Right Side -->

                        <div class="col-lg-8">

                            <table class="table table-striped">

                                <tr>
                                    <th width="30%">Full Name</th>
                                    <td>{{ $manager->name }}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $manager->email }}</td>
                                </tr>

                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $manager->phone }}</td>
                                </tr>

                                <tr>
                                    <th>Department</th>
                                    <td>{{ $manager->department }}</td>
                                </tr>

                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $manager->designation }}</td>
                                </tr>

                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $manager->gender }}</td>
                                </tr>

                                <tr>
                                    <th>Joining Date</th>
                                    <td>
                                        {{ $manager->joining_date
        ? \Carbon\Carbon::parse($manager->joining_date)->format('d M Y')
        : 'N/A' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{ $manager->address }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    </td>
                                </tr>

                            </table>

                            <div class="mt-4">

                                <a href="{{ route('admin.managers.edit', $manager->id) }}" class="btn btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.managers.destroy', $manager->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" onclick="return confirm('Delete this manager?')">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
