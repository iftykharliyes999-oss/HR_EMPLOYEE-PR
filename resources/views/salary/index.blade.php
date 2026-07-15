@extends($layout)

@section('content')

<div class="page-wrapper">
<div class="page-content">

    {{-- Page Header --}}

    <div class="card border-0 shadow-sm radius-10 mb-4">

        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>

                    <h4 class="fw-bold mb-1">
                        My Salary
                    </h4>

                    <p class="text-muted mb-0">
                        View salary, deductions, payment and receipt status.
                    </p>

                </div>

                <form
                    method="GET"
                    action="{{ route($salaryRouteName) }}"
                    class="d-flex flex-wrap gap-2 align-items-end">

                    <div>

                        <label class="form-label">
                            Month
                        </label>

                        <select
                            name="month"
                            class="form-select">

                            @foreach(range(1, 12) as $monthNumber)

                                <option
                                    value="{{ $monthNumber }}"
                                    @selected($monthNumber === $month)>

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
                            class="form-select">

                            @foreach(
                                range(
                                    now('Asia/Dhaka')->year - 3,
                                    now('Asia/Dhaka')->year + 1
                                )
                                as $yearOption
                            )

                                <option
                                    value="{{ $yearOption }}"
                                    @selected($yearOption === $year)>

                                    {{ $yearOption }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <button class="btn btn-primary">

                        <i class="bx bx-filter-alt me-1"></i>
                        View Salary

                    </button>

                </form>

            </div>

        </div>

    </div>


    {{-- Messages --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif




        <div class="row g-4 mb-4">
            @if($payroll)

            {{-- Salary Calculation --}}

            <div class="col-xl-7">

                <div class="card border-0 shadow-sm radius-10 h-100">

                    <div class="card-header bg-transparent border-0 py-3">

                        <h5 class="fw-bold mb-1">
                            Salary Breakdown
                        </h5>

                        <p class="text-muted mb-0">

                            {{ \Carbon\Carbon::create()
                                ->month($payroll->salary_month)
                                ->format('F') }}

                            {{ $payroll->salary_year }}

                        </p>

                    </div>

                    <div class="card-body pt-0">

                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <tbody>

                                    <tr>

                                        <td>
                                            Base Salary
                                        </td>

                                        <td class="text-end fw-semibold">

                                            ৳{{ number_format(
                                                $payroll->base_salary,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Festival Bonus
                                        </td>

                                        <td class="text-end text-success">

                                            +৳{{ number_format(
                                                $payroll->festival_bonus,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Other Bonus
                                        </td>

                                        <td class="text-end text-success">

                                            +৳{{ number_format(
                                                $payroll->other_bonus,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Overtime Amount
                                        </td>

                                        <td class="text-end text-success">

                                            +৳{{ number_format(
                                                $payroll->overtime_amount,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr class="table-light">

                                        <td class="fw-bold">
                                            Gross Salary
                                        </td>

                                        <td class="text-end fw-bold">

                                            ৳{{ number_format(
                                                $payroll->gross_salary,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>
                                            Absence Deduction
                                        </td>

                                        <td class="text-end text-danger">

                                            -৳{{ number_format(
                                                $payroll->absence_deduction,
                                                2
                                            ) }}

                                        </td>

                                    </tr>
                                    <tr>

    <td>
        Loan Installment
    </td>

    <td class="text-end">

        @if((float) $payroll->loan_deduction > 0)

            <span class="text-danger">

                -৳{{ number_format(
                    $payroll->loan_deduction,
                    2
                ) }}

            </span>

        @else

            <span class="text-muted">
                ৳0.00
            </span>

        @endif

    </td>

</tr>

                                    <tr>

                                        <td>
                                            Other Deduction
                                        </td>

                                        <td class="text-end text-danger">

                                            -৳{{ number_format(
                                                $payroll->other_deduction,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                    <tr class="table-light">

                                        <td class="fw-bold">
                                            Net Salary
                                        </td>

                                        <td class="text-end fw-bold text-primary">

                                            ৳{{ number_format(
                                                $payroll->net_salary,
                                                2
                                            ) }}

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Deduction Reason --}}

            <div class="col-xl-5">

                <div class="card border-0 shadow-sm radius-10 h-100">

                    <div class="card-header bg-transparent border-0 py-3">

                        <h5 class="fw-bold mb-1">
                            Deduction Reason
                        </h5>

                        <p class="text-muted mb-0">
                            Why salary was deducted.
                        </p>

                    </div>

                    <div class="card-body pt-0">

                        <div class="row g-3">

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Actual Absent
                                    </small>

                                    <h4 class="fw-bold text-danger mb-0">
                                        {{ $payroll->actual_absent_days }}
                                    </h4>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Late Count
                                    </small>

                                    <h4 class="fw-bold text-warning mb-0">
                                        {{ $payroll->late_count }}
                                    </h4>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Late Penalty Days
                                    </small>

                                    <h4 class="fw-bold text-danger mb-0">
                                        {{ $payroll->late_penalty_days }}
                                    </h4>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="border rounded p-3">

                                    <small class="text-muted d-block">
                                        Deductible Days
                                    </small>

                                    <h4 class="fw-bold text-danger mb-0">
                                        {{ $payroll->total_deductible_days }}
                                    </h4>

                                </div>

                            </div>
                            <div class="col-6">

    <div class="col-6">

    <div class="border rounded p-3 h-100">

        <small class="text-muted d-block">
            Loan Installment
        </small>

        @if((float) $payroll->loan_deduction > 0)

            <h4 class="fw-bold text-danger mb-0">

                -৳{{ number_format(
                    $payroll->loan_deduction,
                    2
                ) }}

            </h4>

        @else

            <h6 class="fw-bold text-success mb-0">
                No Loan
            </h6>

        @endif

    </div>

</div>

</div>

                        </div>

                        <div class="alert alert-light border mt-3 mb-0">

    <strong>Salary Rules:</strong>

    <ul class="mb-0 mt-2">

        <li>
            প্রতি Absent Day-এ Base Salary-এর ৩% কাটা হবে।
        </li>

        <li>
            প্রতি ৩টি Late = ১টি Absent Penalty।
        </li>

        <li>
            Approved Loan থাকলে Monthly Installment Salary থেকে কাটা হবে।
        </li>

    </ul>

</div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Payment Status --}}

        <div class="card border-0 shadow-sm radius-10 mb-4">

            <div class="card-header bg-transparent border-0 py-3">

                <h5 class="fw-bold mb-0">
                    Payment Status
                </h5>

            </div>

            <div class="card-body pt-0">

                <div class="row g-3 align-items-center">

                    <div class="col-md-3">

                        <small class="text-muted d-block">
                            Payment Status
                        </small>

                        @if($payroll->status === 'Paid')

                            <span class="badge bg-success px-3 py-2">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-warning text-dark px-3 py-2">
                                Draft
                            </span>

                        @endif

                    </div>

                    <div class="col-md-3">

                        <small class="text-muted d-block">
                            Payment Date
                        </small>

                        <span class="fw-semibold">

                            {{ optional(
                                $payroll->payment_date
                            )->format('d M Y') ?? 'Not Paid Yet' }}

                        </span>

                    </div>

                    <div class="col-md-3">

                        <small class="text-muted d-block">
                            Payment Method
                        </small>

                        <span class="fw-semibold">
                            {{ $payroll->payment_method ?? 'N/A' }}
                        </span>

                    </div>

                    <div class="col-md-3">

                        <small class="text-muted d-block">
                            Receipt Status
                        </small>

                        @if($payroll->recipient_status === 'Received')

                            <span class="badge bg-success px-3 py-2">
                                Received
                            </span>

                        @else

                            <span class="badge bg-warning text-dark px-3 py-2">
                                Pending
                            </span>

                        @endif

                    </div>

                </div>

                @if(
                    $payroll->status === 'Paid'
                    && $payroll->recipient_status !== 'Received'
                )

                    <form
                        method="POST"
                        action="{{ route(
                            $receiveRouteName,
                            $payroll
                        ) }}"
                        class="mt-4">

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-success"
                            onclick="return confirm(
                                'Confirm that you have received this salary?'
                            )">

                            <i class="bx bx-check-double me-1"></i>
                            Salary Received

                        </button>

                    </form>

                @elseif($payroll->recipient_status === 'Received')

                    <div class="alert alert-success mt-4 mb-0">

                        Salary received confirmed on

                        <strong>

                            {{ optional(
                                $payroll->received_at
                            )
                                ?->timezone('Asia/Dhaka')
                                ->format('d M Y, h:i A') }}

                        </strong>

                    </div>

                @endif

            </div>

        </div>

    @else

        <div class="card border-0 shadow-sm radius-10 mb-4">

            <div class="card-body text-center py-5">

                <i class="bx bx-wallet display-4 text-muted"></i>

                <h5 class="fw-bold mt-3">
                    No Payroll Found
                </h5>

                <p class="text-muted mb-0">
                    Admin has not generated payroll for the selected month.
                </p>

            </div>

        </div>

    @endif


    {{-- Salary History --}}

    <div class="card border-0 shadow-sm radius-10">

        <div class="card-header bg-transparent border-0 py-3">

            <h5 class="fw-bold mb-1">
                Salary History
            </h5>

            <p class="text-muted mb-0">
                Previous payroll and payment records.
            </p>

        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>Salary Month</th>
                            <th>Base Salary</th>
                            <th>Deduction</th>
                            <th>Net Salary</th>
                            <th>Payment</th>
                            <th>Receipt</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($salaryHistory as $history)

                            <tr>

                                <td>

                                    {{ \Carbon\Carbon::create()
                                        ->month($history->salary_month)
                                        ->format('F') }}

                                    {{ $history->salary_year }}

                                </td>

                                <td>

                                    ৳{{ number_format(
                                        $history->base_salary,
                                        2
                                    ) }}

                                </td>

                                <td class="text-danger">

                                    -৳{{ number_format(
                                        $history->total_deduction,
                                        2
                                    ) }}

                                </td>

                                <td class="fw-semibold text-primary">

                                    ৳{{ number_format(
                                        $history->net_salary,
                                        2
                                    ) }}

                                </td>

                                <td>

                                    @if($history->status === 'Paid')

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

                                    @if(
                                        $history->recipient_status
                                        === 'Received'
                                    )

                                        <span class="badge bg-success">
                                            Received
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Pending
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-4">

                                    No salary history found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $salaryHistory->links() }}
            </div>

        </div>

    </div>

</div>
</div>

@endsection
