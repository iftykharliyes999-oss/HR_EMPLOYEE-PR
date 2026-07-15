@extends('admin.master')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    {{-- Header --}}

    <div class="card border-0 shadow-sm radius-10 mb-4">

        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>

                    <h4 class="fw-bold mb-1">
                        Payroll Management
                    </h4>

                    <p class="text-muted mb-0">
                        Generate, review and manage monthly salary payments.
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('admin.payroll.generate') }}"
                    class="d-flex flex-wrap gap-2 align-items-end">

                    @csrf

                    <div>

                        <label class="form-label">
                            Month
                        </label>

                        <select
                            name="month"
                            class="form-select"
                            required>

                            @foreach(range(1, 12) as $monthNumber)

                                <option
                                    value="{{ $monthNumber }}"
                                    @selected($monthNumber == $month)>

                                    {{ \Carbon\Carbon::create()
                                        ->month($monthNumber)
                                        ->format('F') }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="form-label">
                            Year
                        </label>

                        <select
                            name="year"
                            class="form-select"
                            required>

                            @foreach(range(now()->year - 2, now()->year + 1) as $yearOption)

                                <option
                                    value="{{ $yearOption }}"
                                    @selected($yearOption == $year)>

                                    {{ $yearOption }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bx bx-calculator me-1"></i>

                        Generate Payroll

                    </button>

                </form>

            </div>

        </div>

    </div>

    {{-- Success / Error Message --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Payroll Overview --}}

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 g-3 mb-4">

        <div class="col">

            <div class="card border-0 shadow-sm radius-10 h-100">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Payroll
                    </p>

                    <h4 class="fw-bold mb-0">

                        ৳{{ number_format(
                            $totalPayrollAmount,
                            2
                        ) }}

                    </h4>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card border-0 shadow-sm radius-10 h-100">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Paid Amount
                    </p>

                    <h4 class="fw-bold text-success mb-0">

                        ৳{{ number_format(
                            $paidAmount,
                            2
                        ) }}

                    </h4>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card border-0 shadow-sm radius-10 h-100">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Draft Amount
                    </p>

                    <h4 class="fw-bold text-warning mb-0">

                        ৳{{ number_format(
                            $draftAmount,
                            2
                        ) }}

                    </h4>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card border-0 shadow-sm radius-10 h-100">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Paid Records
                    </p>

                    <h4 class="fw-bold text-success mb-0">
                        {{ $paidCount }}
                    </h4>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card border-0 shadow-sm radius-10 h-100">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Draft Records
                    </p>

                    <h4 class="fw-bold text-warning mb-0">
                        {{ $draftCount }}
                    </h4>

                </div>

            </div>

        </div>

    </div>


    {{-- Month Filter --}}

    <div class="card border-0 shadow-sm radius-10 mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.payroll.index') }}"
                class="d-flex flex-wrap gap-2 align-items-end">

                <div>

                    <label class="form-label">
                        View Month
                    </label>

                    <select
                        name="month"
                        class="form-select">

                        @foreach(range(1, 12) as $monthNumber)

                            <option
                                value="{{ $monthNumber }}"
                                @selected($monthNumber == $month)>

                                {{ \Carbon\Carbon::create()
                                    ->month($monthNumber)
                                    ->format('F') }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="form-label">
                        View Year
                    </label>

                    <select
                        name="year"
                        class="form-select">

                        @foreach(range(now()->year - 2, now()->year + 1) as $yearOption)

                            <option
                                value="{{ $yearOption }}"
                                @selected($yearOption == $year)>

                                {{ $yearOption }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button class="btn btn-outline-primary">

                    <i class="bx bx-filter-alt me-1"></i>

                    Filter

                </button>

            </form>

        </div>

    </div>


    {{-- Payroll Records --}}

    <div class="card border-0 shadow-sm radius-10">

        <div class="card-header bg-transparent border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Payroll Records
                    </h5>

                    <p class="text-muted mb-0">

                        {{ \Carbon\Carbon::create()
                            ->month($month)
                            ->format('F') }}

                        {{ $year }}

                    </p>

                </div>

                <span class="badge bg-light-primary text-primary px-3 py-2">

                    {{ $payrolls->total() }} Records

                </span>

            </div>

        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Person</th>

                            <th>Role</th>

                            <th>Base Salary</th>

                            <th>Absent</th>

                            <th>Late</th>

                            <th>Deduction</th>

                            <th>Net Salary</th>

                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($payrolls as $payroll)

                            <tr>

                                <td>

                                    <div class="fw-semibold">

                                        {{ $payroll->user?->name
                                            ?? 'Unknown User' }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $payroll->user?->email }}

                                    </small>

                                </td>

                                <td>

                                    {{ $payroll->user
                                        ? $payroll->user
                                            ->getRoleNames()
                                            ->first()
                                        : 'N/A' }}

                                </td>

                                <td>

                                    ৳{{ number_format(
                                        $payroll->base_salary,
                                        2
                                    ) }}

                                </td>

                                <td>

                                    {{ $payroll->actual_absent_days }}

                                </td>

                                <td>

                                    {{ $payroll->late_count }}

                                    @if($payroll->late_penalty_days > 0)

                                        <small class="d-block text-danger">

                                            {{ $payroll->late_penalty_days }}
                                            penalty day

                                        </small>

                                    @endif

                                </td>

                                <td>

                                    <span class="text-danger">

                                        -৳{{ number_format(
                                            $payroll->total_deduction,
                                            2
                                        ) }}

                                    </span>

                                </td>

                                <td>

                                    <span class="fw-bold text-primary">

                                        ৳{{ number_format(
                                            $payroll->net_salary,
                                            2
                                        ) }}

                                    </span>

                                </td>

                                <td>

                                    @if($payroll->status === 'Paid')

                                        <span class="badge bg-success">
                                            Paid
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Draft
                                        </span>

                                    @endif

                                </td>

                                <td>
    <div class="d-flex flex-wrap gap-2">

        <a href="{{ route('admin.payroll.show', $payroll) }}"
           class="btn btn-sm btn-outline-primary">

            <i class="bx bx-show me-1"></i>
            View

        </a>

        @if($payroll->status === 'Draft')

            <a href="{{ route('admin.payroll.show', $payroll) }}#payment-section"
               class="btn btn-sm btn-success">

                <i class="bx bx-money me-1"></i>
                Pay

            </a>

        @else

            <span class="badge bg-success align-self-center">
                Paid
            </span>

        @endif

    </div>
</td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5">

                                    <i class="bx bx-wallet display-5 text-muted"></i>

                                    <p class="text-muted mt-3 mb-0">

                                        No payroll records found for this month.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $payrolls->links() }}

            </div>

        </div>

    </div>

</div>
</div>

@endsection
