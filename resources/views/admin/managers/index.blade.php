@extends('admin.master')

@section('content')

    <div class="page-content">

        <div class="container-fluid">


            <!-- Header Card -->

            <div class="card radius-10 bg-primary bg-gradient">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <h4 class="text-white mb-1">
                                Manager Management
                            </h4>

                            <p class="text-white mb-0 opacity-75">
                                Manage all company managers from here
                            </p>

                        </div>


                        <div>

                            <a href="{{ route('admin.managers.create') }}" class="btn btn-light">

                                <i class="bx bx-user-plus"></i>
                                Add New Manager

                            </a>

                        </div>


                    </div>

                </div>

            </div>





            <!-- Table Card -->


            <div class="card radius-10">


                <div class="card-body">


                    @if(session('success'))

                        <div class="alert alert-success border-0 bg-success text-white">
                            {{ session('success') }}
                        </div>

                    @endif




                    <div class="table-responsive">


                        <table class="table align-middle mb-0">


                            <thead class="table-light">


                                <tr>

                                    <th>#</th>

                                    <th>Manager</th>

                                    <th>Contact</th>

                                    <th>Department</th>

                                    <th>Salary</th>

                                    <th>Joining Date</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>


                            </thead>



                            <tbody>


                                @forelse($managers as $key => $manager)


                                    <tr>


                                        <td>
                                            {{ $key + 1 }}
                                        </td>



                                        <!-- Manager -->

                                        <td>

                                            <div class="d-flex align-items-center">


                                                @if($manager->photo)

<img src="{{ asset('uploads/managers/'.$manager->photo) }}"
width="45"
height="45"
class="rounded-circle me-3"
style="object-fit:cover;">

@else

<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
style="width:45px;height:45px;font-size:20px;">

{{ strtoupper(substr($manager->name,0,1)) }}

</div>

@endif


                                                <div>

                                                    <h6 class="mb-0">

                                                        {{ $manager->name }}

                                                    </h6>


                                                    <small class="text-muted">

                                                        {{ $manager->designation }}

                                                    </small>


                                                </div>


                                            </div>


                                        </td>




                                        <!-- Contact -->

                                        <td>

                                            <div>

                                                <i class="bx bx-envelope"></i>

                                                {{ $manager->email }}

                                            </div>


                                            <small class="text-muted">

                                                <i class="bx bx-phone"></i>

                                                {{ $manager->phone ?? 'No Phone' }}

                                            </small>


                                        </td>





                                        <!-- Department -->

                                        <td>

                                            <span class="badge bg-info text-dark">

                                                {{ $manager->department ?? 'N/A' }}

                                            </span>


                                        </td>





                                        <!-- Salary -->

                                        <td>


                                            <span class="badge bg-success">

                                                ৳ {{ number_format($manager->salary ?? 0) }}

                                            </span>


                                        </td>




                                        <!-- Date -->


                                        <td>

                                            @if($manager->joining_date)

                                                {{ $manager->joining_date->format('d M Y') }}

                                            @else

                                                N/A

                                            @endif


                                        </td>




                                        <!-- Status -->

                                        <td>

                                            <span class="badge bg-success">

                                                Active

                                            </span>


                                        </td>




                                        <!-- Action -->


                                        <td>


                                            <div class="d-flex gap-2">


                                                <a href="{{route('admin.managers.show', $manager->id)}}"
                                                    class="btn btn-sm btn-outline-info">

                                                    <i class="bx bx-show"></i>

                                                </a>




                                                <a href="{{route('admin.managers.edit', $manager->id)}}"
                                                    class="btn btn-sm btn-outline-warning">

                                                    <i class="bx bx-edit"></i>

                                                </a>





                                                <form action="{{route('admin.managers.destroy', $manager->id)}}" method="POST">

                                                    @csrf

                                                    @method('DELETE')


                                                    <button onclick="return confirm('Delete this manager?')"
                                                        class="btn btn-sm btn-outline-danger">

                                                        <i class="bx bx-trash"></i>

                                                    </button>


                                                </form>


                                            </div>


                                        </td>


                                    </tr>



                                @empty


                                    <tr>

                                        <td colspan="8" class="text-center py-5">


                                            <h5 class="text-muted">
                                                No Managers Found
                                            </h5>


                                            <a href="{{route('admin.managers.create')}}" class="btn btn-primary mt-2">

                                                Create First Manager

                                            </a>


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


@endsection
