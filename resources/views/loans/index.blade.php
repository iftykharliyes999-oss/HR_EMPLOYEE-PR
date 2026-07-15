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
                        My Loan Requests
                    </h4>

                    <p class="text-muted mb-0">
                        Apply for a loan and track approval and repayment details.
                    </p>

                </div>

                <span class="badge bg-light-primary text-primary px-3 py-2">
                    {{ $loans->total() }} Requests
                </span>

            </div>

        </div>

    </div>


    {{-- Flash Messages --}}

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

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row g-4">

        {{-- Loan Request Form --}}

        <div class="col-xl-5">

            <div class="card border-0 shadow-sm radius-10">

                <div class="card-header bg-transparent border-0 py-3">

                    <h5 class="fw-bold mb-1">
                        Request a Loan
                    </h5>

                    <p class="text-muted mb-0">
                        Submit a new request for Admin approval.
                    </p>

                </div>

                <div class="card-body pt-0">

                    <form
                        method="POST"
                        action="{{ route($storeRoute) }}">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Requested Amount
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ৳
                                </span>

                                <input
                                    type="number"
                                    name="requested_amount"
                                    step="0.01"
                                    min="1"
                                    value="{{ old('requested_amount') }}"
                                    class="form-control"
                                    placeholder="Enter loan amount"
                                    required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Installment Months
                            </label>

                            <input
                                type="number"
                                name="installment_months"
                                min="1"
                                max="60"
                                value="{{ old('installment_months') }}"
                                class="form-control"
                                placeholder="Example: 6 or 12"
                                required>

                            <small class="text-muted">
                                Maximum 60 months.
                            </small>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Reason for Loan
                            </label>

                            <textarea
                                name="reason"
                                rows="6"
                                class="form-control"
                                placeholder="Explain why you need the loan"
                                required>{{ old('reason') }}</textarea>

                        </div>

                        <div class="alert alert-light border">

                            <i class="bx bx-info-circle me-1"></i>

                            Admin approval-এর পরে monthly installment এবং
                            deduction start month final হবে।

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="bx bx-send me-1"></i>
                            Submit Loan Request

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- Loan History --}}

        <div class="col-xl-7">

            <div class="card border-0 shadow-sm radius-10">

                <div class="card-header bg-transparent border-0 py-3">

                    <h5 class="fw-bold mb-1">
                        Loan History
                    </h5>

                    <p class="text-muted mb-0">
                        View request, approval and repayment information.
                    </p>

                </div>

                <div class="card-body pt-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>
                                    <th>Amount</th>
                                    <th>Months</th>
                                    <th>Installment</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($loans as $loan)

                                    <tr>

                                        <td>

                                            <span class="fw-semibold">

                                                ৳{{ number_format(
                                                    $loan->requested_amount,
                                                    2
                                                ) }}

                                            </span>

                                        </td>

                                        <td>

                                            {{ $loan->installment_months }}

                                            <small class="text-muted">
                                                Months
                                            </small>

                                        </td>

                                        <td>

                                            @if(
                                                (float) $loan->monthly_installment > 0
                                            )

                                                <span class="text-danger fw-semibold">

                                                    ৳{{ number_format(
                                                        $loan->monthly_installment,
                                                        2
                                                    ) }}

                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    Not Set
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            @if(
                                                in_array(
                                                    $loan->status,
                                                    [
                                                        'Approved',
                                                        'Completed',
                                                    ]
                                                )
                                            )

                                                <span class="fw-semibold">

                                                    ৳{{ number_format(
                                                        $loan->remaining_balance,
                                                        2
                                                    ) }}

                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            @if($loan->status === 'Approved')

                                                <span class="badge bg-success">
                                                    Approved
                                                </span>

                                            @elseif($loan->status === 'Rejected')

                                                <span class="badge bg-danger">
                                                    Rejected
                                                </span>

                                            @elseif($loan->status === 'Completed')

                                                <span class="badge bg-primary">
                                                    Completed
                                                </span>

                                            @else

                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            {{ $loan->created_at
                                                ->timezone('Asia/Dhaka')
                                                ->format('d M Y') }}

                                        </td>

                                    </tr>


                                    {{-- Loan Detail Row --}}

                                    <tr>

                                        <td colspan="6">

                                            <div class="border rounded p-3">

                                                <div class="row g-3">

                                                    <div class="col-md-6">

                                                        <small class="text-muted d-block">
                                                            Reason
                                                        </small>

                                                        <span>
                                                            {{ $loan->reason }}
                                                        </span>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <small class="text-muted d-block">
                                                            Deduction Starts
                                                        </small>

                                                        <span class="fw-semibold">

                                                            {{ optional(
                                                                $loan->deduction_start_month
                                                            )->format('F Y')
                                                                ?? 'Not Set' }}

                                                        </span>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <small class="text-muted d-block">
                                                            Reviewed At
                                                        </small>

                                                        <span class="fw-semibold">

                                                            {{ $loan->reviewed_at
    ? $loan->reviewed_at
        ->timezone('Asia/Dhaka')
        ->format('d M Y')
    : 'Not Reviewed' }}

                                                        </span>

                                                    </div>

                                                    @if($loan->admin_note)

                                                        <div class="col-12">

                                                            <small class="text-muted d-block">
                                                                Admin Note
                                                            </small>

                                                            <span>
                                                                {{ $loan->admin_note }}
                                                            </span>

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="text-center py-5">

                                            <i class="bx bx-credit-card display-5 text-muted"></i>

                                            <h6 class="fw-bold mt-3">
                                                No Loan Request Found
                                            </h6>

                                            <p class="text-muted mb-0">
                                                Use the form to submit your first loan request.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">

                        {{ $loans->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
</div>

@endsection
