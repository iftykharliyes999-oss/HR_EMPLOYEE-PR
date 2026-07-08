@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-body p-4">

                <h5 class="card-title">
                    Add New Manager
                </h5>

                <hr>


                @if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif


                <form action="{{ route('admin.managers.store') }}"
      method="POST"
      enctype="multipart/form-data">
                    @csrf


                    <div class="row">


                        <!-- Left Side -->

                        <div class="col-lg-8">

                            <div class="border border-3 p-4 rounded">


                                <div class="mb-3">
                                    <label class="form-label">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name') }}"
                                        placeholder="Enter manager name">

                                </div>



                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Email
                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="manager@email.com"
                                            value="{{ old('email') }}">

                                    </div>



                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Phone
                                        </label>

                                        <input
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            placeholder="Phone number"
                                            value="{{ old('phone') }}">

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Password
                                        </label>

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control">

                                    </div>



                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">
                                            Gender
                                        </label>

                                        <select name="gender" class="form-select">

                                            <option value="">
                                                Select Gender
                                            </option>

                                            <option value="Male">
                                                Male
                                            </option>

                                            <option value="Female">
                                                Female
                                            </option>

                                        </select>

                                    </div>

                                </div>



                                <div class="mb-3">

                                    <label class="form-label">
                                        Address
                                    </label>

                                    <textarea
                                        name="address"
                                        class="form-control"
                                        rows="3">{{ old('address') }}</textarea>

                                </div>


                            </div>

                        </div>




                        <!-- Right Side -->


                        <div class="col-lg-4">


                            <div class="border border-3 p-4 rounded">


                                <div class="mb-3">

                                    <label class="form-label">
                                        Department
                                    </label>


                                    <select name="department" class="form-select">

                                        <option value="">
                                            Select Department
                                        </option>

                                        <option value="HR" {{ old('department')=='HR'?'selected':'' }}>
                                            Human Resource
                                        </option>

                                        <option value="IT" {{ old('department')=='IT'?'selected':'' }}>
                                            IT
                                        </option>

                                        <option value="Finance" {{ old('department')=='Finance'?'selected':'' }}>
                                            Finance
                                        </option>

                                        <option value="Accounts" {{ old('department')=='Accounts'?'selected':'' }}>
                                            Accounts
                                        </option>

                                    </select>

                                </div>




                                <div class="mb-3">

                                    <label class="form-label">
                                        Designation
                                    </label>


                                    <input
                                        type="text"
                                        name="designation"
                                        class="form-control"
                                        value="Manager">

                                </div>



                                <div class="mb-3">

<label class="form-label">
    Monthly Salary
</label>


<input
type="number"
name="salary"
class="form-control"
placeholder="Enter salary amount"
value="{{ old('salary') }}">

</div>




                                <div class="mb-3">

                                    <label class="form-label">
                                        Joining Date
                                    </label>


                                    <input
                                        type="date"
                                        name="joining_date"
                                        class="form-control">

                                </div>
                                <div class="mb-3">

    <label class="form-label">Profile Photo</label>

    <input type="file"
           name="photo"
           class="form-control">

</div>




                                <div class="d-grid">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="bx bx-user-plus"></i>

                                        Create Manager

                                    </button>

                                </div>


                            </div>


                        </div>


                    </div>


                </form>


            </div>

        </div>

    </div>

</div>


@endsection
