@extends('employee.master')

@section('content')

<div class="page-content">

    <div class="row">

        <div class="col-lg-8 mx-auto">

            <div class="card radius-10">

                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="bx bx-calendar-plus"></i>
                        Apply Leave
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('employee.leaves.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            {{-- Leave Type --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Leave Type
                                </label>

                                <select
                                    name="leave_type"
                                    class="form-select @error('leave_type') is-invalid @enderror">

                                    <option value="">
                                        Select Leave Type
                                    </option>

                                    <option value="Casual">Casual Leave</option>

                                    <option value="Sick">Sick Leave</option>

                                    <option value="Annual">Annual Leave</option>

                                    <option value="Emergency">Emergency Leave</option>

                                    <option value="Unpaid">Unpaid Leave</option>

                                </select>

                                @error('leave_type')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            {{-- Total Days --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Total Days
                                </label>

                                <input
                                    type="text"
                                    id="total_days"
                                    class="form-control"
                                    readonly>

                            </div>

                            {{-- Start Date --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Start Date
                                </label>

                                <input
                                    type="date"
                                    id="start_date"
                                    name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror">

                                @error('start_date')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            {{-- End Date --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    End Date
                                </label>

                                <input
                                    type="date"
                                    id="end_date"
                                    name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror">

                                @error('end_date')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            {{-- Reason --}}
                            <div class="col-12 mb-3">

                                <label class="form-label">
                                    Reason
                                </label>

                                <textarea
                                    name="reason"
                                    rows="5"
                                    class="form-control @error('reason') is-invalid @enderror"
                                    placeholder="Write your leave reason..."></textarea>

                                @error('reason')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            {{-- Attachment --}}
                            <div class="col-12 mb-4">

                                <label class="form-label">
                                    Attachment
                                    <small class="text-muted">
                                        (Optional)
                                    </small>
                                </label>

                                <input
                                    type="file"
                                    name="attachment"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="text-end">

                            <a href="{{ route('employee.leaves.index') }}"
                               class="btn btn-secondary">

                                Cancel

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bx bx-send"></i>

                                Submit Application

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('js')

<script>

let start=document.getElementById('start_date');

let end=document.getElementById('end_date');

let total=document.getElementById('total_days');

function calculateDays(){

    if(start.value && end.value){

        let s=new Date(start.value);

        let e=new Date(end.value);

        let diff=e-s;

        let days=(diff/(1000*60*60*24))+1;

        total.value=days>0?days:0;

    }

}

start.addEventListener('change',calculateDays);

end.addEventListener('change',calculateDays);

</script>

@endpush
