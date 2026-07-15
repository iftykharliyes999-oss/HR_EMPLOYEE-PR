@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="row mb-4">

        <div class="col-md-8">

            <h3 class="fw-bold">

                Payroll Details

            </h3>

            <p class="text-muted">

                {{ $payroll->user->name }}
                -
                {{ \Carbon\Carbon::create()
                    ->month($payroll->salary_month)
                    ->format('F') }}
                {{ $payroll->salary_year }}

            </p>

        </div>

        <div class="col-md-4 text-end">

            <a
                href="{{ route('admin.payroll.index') }}"
                class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="row">

        {{-- Employee Info --}}

        <div class="col-lg-4">

            <div class="card">

                <div class="card-header">

                    Employee Information

                </div>

                <div class="card-body">

                    <p>

                        <strong>Name :</strong>

                        {{ $payroll->user->name }}

                    </p>

                    <p>

                        <strong>Email :</strong>

                        {{ $payroll->user->email }}

                    </p>

                    <p>

                        <strong>Role :</strong>

                        {{ $payroll->user->roles->first()->name }}

                    </p>

                    <p>

                        <strong>Department :</strong>

                        {{ $payroll->user->department }}

                    </p>

                    <p>

                        <strong>Designation :</strong>

                        {{ $payroll->user->designation }}

                    </p>

                </div>

            </div>

        </div>



        @if($payroll->status === 'Draft')

    <div class="card border-0 shadow-sm radius-10 mb-4">

        <div class="card-header bg-transparent border-0 py-3">

            <h5 class="fw-bold mb-1">
                Salary Components
            </h5>

            <p class="text-muted mb-0">
                Add allowances, bonuses, overtime and deductions before payment.
            </p>

        </div>

        <div class="card-body pt-0">

            <form
                method="POST"
                action="{{ route(
                    'admin.payroll.components.update',
                    $payroll
                ) }}">

                @csrf
                @method('PATCH')

                <h6 class="fw-bold mb-3">
                    Allowances
                </h6>

                <div class="row g-3">

                    <div class="col-md-3">

                        <label class="form-label">
                            House Allowance
                        </label>

                        <input
                            type="number"
                            name="house_allowance"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'house_allowance',
                                $payroll->house_allowance
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Medical Allowance
                        </label>

                        <input
                            type="number"
                            name="medical_allowance"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'medical_allowance',
                                $payroll->medical_allowance
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Transport Allowance
                        </label>

                        <input
                            type="number"
                            name="transport_allowance"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'transport_allowance',
                                $payroll->transport_allowance
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Food Allowance
                        </label>

                        <input
                            type="number"
                            name="food_allowance"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'food_allowance',
                                $payroll->food_allowance
                            ) }}"
                            class="form-control">

                    </div>

                </div>

                <hr>

                <h6 class="fw-bold mb-3">
                    Bonus and Earnings
                </h6>

                <div class="row g-3">

                    <div class="col-md-3">

                        <label class="form-label">
                            Festival Bonus
                        </label>

                        <input
                            type="number"
                            name="festival_bonus"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'festival_bonus',
                                $payroll->festival_bonus
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Performance Bonus
                        </label>

                        <input
                            type="number"
                            name="performance_bonus"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'performance_bonus',
                                $payroll->performance_bonus
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Other Bonus
                        </label>

                        <input
                            type="number"
                            name="other_bonus"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'other_bonus',
                                $payroll->other_bonus
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Overtime Amount
                        </label>

                        <input
                            type="number"
                            name="overtime_amount"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'overtime_amount',
                                $payroll->overtime_amount
                            ) }}"
                            class="form-control">

                    </div>

                </div>

                <hr>

                <h6 class="fw-bold mb-3">
                    Additional Deductions
                </h6>

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Tax Deduction
                        </label>

                        <input
                            type="number"
                            name="tax_deduction"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'tax_deduction',
                                $payroll->tax_deduction
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Advance Deduction
                        </label>

                        <input
                            type="number"
                            name="advance_deduction"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'advance_deduction',
                                $payroll->advance_deduction
                            ) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Other Deduction
                        </label>

                        <input
                            type="number"
                            name="other_deduction"
                            step="0.01"
                            min="0"
                            value="{{ old(
                                'other_deduction',
                                $payroll->other_deduction
                            ) }}"
                            class="form-control">

                    </div>

                </div>

                <div class="alert alert-light border mt-4">

                    Loan installment এখানে manually edit হবে না।

                    Approved loan থাকলে system automatic
                    `loan_deduction` calculate করবে।

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bx bx-calculator me-1"></i>
                    Update Salary Calculation

                </button>

            </form>

        </div>

    </div>

@endif


        {{-- Salary Breakdown --}}

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    Salary Breakdown

                </div>

                <div class="card-body">

    <table class="table">

        <tr>

            <th>Base Salary</th>

            <td>

                ৳{{ number_format(
                    $payroll->base_salary,
                    2
                ) }}

            </td>

        </tr>


        {{-- Allowances --}}

        <tr>

            <th>House Allowance</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->house_allowance ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Medical Allowance</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->medical_allowance ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Transport Allowance</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->transport_allowance ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Food Allowance</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->food_allowance ?? 0,
                    2
                ) }}

            </td>

        </tr>


        {{-- Bonuses and Earnings --}}

        <tr>

            <th>Festival Bonus</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->festival_bonus ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Performance Bonus</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->performance_bonus ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Other Bonus</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->other_bonus ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Overtime Amount</th>

            <td class="text-success">

                +৳{{ number_format(
                    $payroll->overtime_amount ?? 0,
                    2
                ) }}

            </td>

        </tr>


        {{-- Gross Salary --}}

        <tr class="table-light">

            <th>Gross Salary</th>

            <td>

                <strong>

                    ৳{{ number_format(
                        $payroll->gross_salary,
                        2
                    ) }}

                </strong>

            </td>

        </tr>


        {{-- Attendance Details --}}

        <tr>

            <th>Absent Days</th>

            <td>

                {{ $payroll->actual_absent_days }}

            </td>

        </tr>

        <tr>

            <th>Late Count</th>

            <td>

                {{ $payroll->late_count }}

            </td>

        </tr>

        <tr>

            <th>Late Penalty Days</th>

            <td>

                {{ $payroll->late_penalty_days }}

            </td>

        </tr>

        <tr>

            <th>Total Deductible Days</th>

            <td>

                {{ $payroll->total_deductible_days }}

            </td>

        </tr>


        {{-- Deductions --}}

        <tr>

            <th>Absence Deduction</th>

            <td class="text-danger">

                -৳{{ number_format(
                    $payroll->absence_deduction ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Tax Deduction</th>

            <td class="text-danger">

                -৳{{ number_format(
                    $payroll->tax_deduction ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Loan Installment Deduction</th>

            <td class="text-danger">

                -৳{{ number_format(
                    $payroll->loan_deduction ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Advance Deduction</th>

            <td class="text-danger">

                -৳{{ number_format(
                    $payroll->advance_deduction ?? 0,
                    2
                ) }}

            </td>

        </tr>

        <tr>

            <th>Other Deduction</th>

            <td class="text-danger">

                -৳{{ number_format(
                    $payroll->other_deduction ?? 0,
                    2
                ) }}

            </td>

        </tr>


        {{-- Total Deduction --}}

        <tr class="table-light">

            <th>Total Deduction</th>

            <td class="text-danger">

                <strong>

                    -৳{{ number_format(
                        $payroll->total_deduction,
                        2
                    ) }}

                </strong>

            </td>

        </tr>


        {{-- Net Salary --}}

        <tr class="table-success">

            <th>Net Salary</th>

            <td class="text-success">

                <strong>

                    ৳{{ number_format(
                        $payroll->net_salary,
                        2
                    ) }}

                </strong>

            </td>

        </tr>

    </table>

</div>

            </div>

        </div>

    </div>


    {{-- Payment Section --}}

    <div
        id="payment-section"
        class="card mt-4">

        <div class="card-header">

            Salary Payment

        </div>

        <div class="card-body">

            @if($payroll->status=='Draft')

                <form
                    method="POST"
                    action="{{ route('admin.payroll.pay',$payroll) }}">

                    @csrf

                    @method('PATCH')

                    <div class="row">

                        <div class="col-md-4">

                            <label>

                                Payment Date

                            </label>

                            <input
                                type="date"
                                name="payment_date"
                                class="form-control"
                                value="{{ now()->toDateString() }}"
                                required>

                        </div>

                        <div class="col-md-4">

                            <label>

                                Payment Method

                            </label>

                            <select
                                name="payment_method"
                                class="form-control"
                                required>

                                <option value="Cash">

                                    Cash

                                </option>

                                <option value="Bank Transfer">

                                    Bank Transfer

                                </option>

                                <option value="Mobile Banking">

                                    Mobile Banking

                                </option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label>

                                Transaction ID

                            </label>

                            <input
                                type="text"
                                name="transaction_reference"
                                class="form-control">

                        </div>

                    </div>

                    <div class="mt-3">

                        <label>

                            Note

                        </label>

                        <textarea
                            name="note"
                            rows="3"
                            class="form-control"></textarea>

                    </div>

                    <button
                        class="btn btn-success mt-3">

                        Pay Salary

                    </button>

                </form>

            @else

                <div class="alert alert-success">

                    <h5>

                        Salary Already Paid

                    </h5>

                    <hr>

                    <p>

                        <strong>Payment Date :</strong>

                        {{ optional($payroll->payment_date)->format('d M Y') }}

                    </p>

                    <p>

                        <strong>Payment Method :</strong>

                        {{ $payroll->payment_method }}

                    </p>

                    <p>

                        <strong>Transaction :</strong>

                        {{ $payroll->transaction_reference }}

                    </p>

                    <p>

                        <strong>Recipient :</strong>

                        {{ $payroll->recipient_status }}

                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
