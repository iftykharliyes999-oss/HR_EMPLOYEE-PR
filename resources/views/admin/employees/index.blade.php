@extends('admin.master')

@section('content')
    <div class="page-content">

        <div class="container-fluid">



            <div class="card radius-10">


                <div class="card-body p-4">



                    <div class="d-flex justify-content-between align-items-center mb-3">


                        <h5 class="mb-0">
                            Employee List
                        </h5>



                        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">

                            <i class="bx bx-plus"></i>

                            Add Employee

                        </a>


                    </div>



                    <hr>




                    @if (session('success'))
                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>
                    @endif






                    <div class="table-responsive">


                        <table class="table align-middle">


                            <thead class="table-light">


                                <tr>


                                    <th>
                                        Photo
                                    </th>


                                    <th>
                                        Name
                                    </th>


                                    <th>
                                        Email
                                    </th>


                                    <th>
                                        Department
                                    </th>


                                    <th>
                                        Designation
                                    </th>


                                    <th>
                                        Manager
                                    </th>


                                    <th>
                                        Verification
                                    </th>


                                    <th>
                                        Action
                                    </th>



                                </tr>


                            </thead>





                            <tbody>



                                @forelse($employees as $employee)
                                    <tr>



                                        <td>


                                            @if ($employee->photo)
                                                <img src="{{ asset('uploads/employees/' . $employee->photo) }}"
                                                    width="50" height="50" class="rounded-circle"
                                                    style="object-fit:cover;">
                                            @else
                                                <img src="{{ asset('assets/images/no-image.png') }}" width="50"
                                                    height="50" class="rounded-circle">
                                            @endif



                                        </td>






                                        <td>


                                            <h6 class="mb-0">

                                                {{ $employee->name }}

                                            </h6>


                                            <small class="text-muted">

                                                {{ $employee->phone }}

                                            </small>


                                        </td>







                                        <td>

                                            {{ $employee->email }}

                                        </td>







                                        <td>

                                            {{ $employee->department }}

                                        </td>







                                        <td>

                                            {{ $employee->designation }}

                                        </td>







                                        <td>


                                            @if ($employee->manager)
                                                <span>
                                                    {{ $employee->manager->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    Not Assigned
                                                </span>
                                            @endif



                                        </td>







                                        <td>

                                            @if ($employee->verification_status == 'verified')
                                                <span class="badge bg-success">
                                                    Approved
                                                </span>
                                            @elseif($employee->verification_status == 'rejected')
                                                <span class="badge bg-danger">
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>
                                            @endif

                                        </td>








                                        <td>


                                            {{-- Verification Buttons --}}

                                            <div class="mb-2">


                                                <a href="{{ route('admin.employees.status', [$employee->id, 'verified']) }}"
                                                    class="btn btn-success btn-sm">

                                                    <i class="bx bx-check"></i>
                                                    Approve

                                                </a>



                                                <a href="{{ route('admin.employees.status', [$employee->id, 'rejected']) }}"
                                                    class="btn btn-danger btn-sm">

                                                    <i class="bx bx-x"></i>
                                                    Reject

                                                </a>



                                                <a href="{{ route('admin.employees.status', [$employee->id, 'pending']) }}"
                                                    class="btn btn-warning btn-sm">

                                                    <i class="bx bx-time"></i>
                                                    Pending

                                                </a>


                                            </div>



                                            {{-- Other Actions --}}

                                            <a href="{{ route('admin.employees.show', $employee->id) }}"
                                                class="btn btn-info btn-sm">

                                                <i class="bx bx-show"></i>

                                            </a>



                                            <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                                class="btn btn-primary btn-sm">

                                                <i class="bx bx-edit"></i>

                                            </a>




                                            <form action="{{ route('admin.employees.destroy', $employee->id) }}"
                                                method="POST" class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">

                                                    <i class="bx bx-trash"></i>

                                                </button>

                                            </form>


                                        </td>



                                    </tr>




                                @empty



                                    <tr>

                                        <td colspan="8" class="text-center">


                                            No Employee Found


                                        </td>


                                    </tr>
                                @endforelse




                            </tbody>


                        </table>


                    </div>




                    {{ $employees->links() }}



                </div>


            </div>


        </div>


    </div>
@endsection
