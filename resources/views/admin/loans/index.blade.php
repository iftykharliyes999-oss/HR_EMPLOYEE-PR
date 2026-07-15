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
                        Loan Requests
                    </h4>

                    <p class="text-muted mb-0">
                        Review and manage Manager and Employee loan requests.
                    </p>

                </div>

                <span class="badge bg-light-primary text-primary px-3 py-2">
                    {{ $loans->total() }} Requests
                </span>

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

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Loan Table --}}

    <div class="card border-0 shadow-sm radius-10">

        <div class="card-header bg-transparent border-0 py-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                <div>

                    <h5 class="fw-bold mb-1">
                        All Loan Requests
                    </h5>

                    <p class="text-muted mb-0">
                        Pending requests can be approved or rejected.
                    </p>

                </div>

            </div>

        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Applicant</th>

                            <th>Requested Amount</th>

                            <th>Requested Months</th>

                            <th>Reason</th>

                            <th>Status</th>

                            <th>Action / Details</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($loans as $loan)

                            @php
                                $role = $loan->user
                                    ? $loan->user->getRoleNames()->first()
                                    : 'N/A';

                                $imageFolder = $role === 'Manager'
                                    ? 'managers'
                                    : 'employees';
                            @endphp

                            <tr>

                                {{-- Applicant --}}

                                <td style="min-width: 220px;">

                                    <div class="d-flex align-items-center gap-2">

                                        <img
                                            src="{{ $loan->user?->photo
                                                ? asset(
                                                    'uploads/'
                                                    . $imageFolder
                                                    . '/'
                                                    . $loan->user->photo
                                                )
                                                : asset(
                                                    'assets/images/avatars/avatar-1.png'
                                                ) }}"
                                            width="46"
                                            height="46"
                                            class="rounded-circle object-fit-cover"
                                            alt="Applicant">

                                        <div>

                                            <div class="fw-semibold">

                                                {{ $loan->user?->name
                                                    ?? 'Unknown User' }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $role }}

                                                ·

                                                {{ $loan->user?->department
                                                    ?? 'No Department' }}

                                            </small>

                                            <small class="text-muted d-block">

                                                {{ $loan->user?->designation
                                                    ?? 'No Designation' }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Requested Amount --}}

                                <td>

                                    <span class="fw-semibold">

                                        ৳{{ number_format(
                                            $loan->requested_amount,
                                            2
                                        ) }}

                                    </span>

                                </td>


                                {{-- Requested Months --}}

                                <td>

                                    {{ $loan->installment_months }}

                                    <small class="text-muted">
                                        Months
                                    </small>

                                </td>


                                {{-- Reason --}}

                                <td style="min-width: 250px;">

                                    {{ $loan->reason }}

                                    <small class="text-muted d-block mt-1">

                                        Requested:

                                        {{ $loan->created_at
                                            ->timezone('Asia/Dhaka')
                                            ->format('d M Y, h:i A') }}

                                    </small>

                                </td>


                                {{-- Status --}}

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


                                {{-- Action / Details --}}

                                <td style="min-width: 390px;">

                                    @if($loan->status === 'Pending')

                                        {{-- Approve Form --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.loans.approve',
                                                $loan
                                            ) }}"
                                            class="border rounded p-3 mb-3">

                                            @csrf
                                            @method('PATCH')

                                            <h6 class="fw-bold text-success mb-3">

                                                <i class="bx bx-check-circle me-1"></i>

                                                Approve Loan

                                            </h6>

                                            <div class="row g-2">

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Approved Amount
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="approved_amount"
                                                        step="0.01"
                                                        min="1"
                                                        max="{{ $loan->requested_amount }}"
                                                        value="{{ old(
                                                            'approved_amount',
                                                            $loan->requested_amount
                                                        ) }}"
                                                        class="form-control form-control-sm"
                                                        required>

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Installment Months
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="installment_months"
                                                        min="1"
                                                        max="60"
                                                        value="{{ old(
                                                            'installment_months',
                                                            $loan->installment_months
                                                        ) }}"
                                                        class="form-control form-control-sm"
                                                        required>

                                                </div>

                                                <div class="col-12">

                                                    <label class="form-label">
                                                        Deduction Start Month
                                                    </label>

                                                    <input
                                                        type="month"
                                                        class="form-control form-control-sm loan-month-input"
                                                        value="{{ old(
                                                            'deduction_start_month_input',
                                                            now('Asia/Dhaka')
                                                                ->addMonth()
                                                                ->format('Y-m')
                                                        ) }}"
                                                        required>

                                                    <input
                                                        type="hidden"
                                                        name="deduction_start_month"
                                                        class="loan-month-hidden">

                                                    <small class="text-muted">

                                                        Payroll deduction এই মাস থেকে শুরু হবে।

                                                    </small>

                                                </div>

                                                <div class="col-12">

                                                    <label class="form-label">
                                                        Admin Note
                                                    </label>

                                                    <textarea
                                                        name="admin_note"
                                                        rows="2"
                                                        class="form-control form-control-sm"
                                                        placeholder="Optional approval note">{{ old('admin_note') }}</textarea>

                                                </div>

                                                <div class="col-12">

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-success w-100"
                                                        onclick="return confirm(
                                                            'Approve this loan request?'
                                                        )">

                                                        <i class="bx bx-check me-1"></i>

                                                        Approve Loan

                                                    </button>

                                                </div>

                                            </div>

                                        </form>


                                        {{-- Reject Form --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.loans.reject',
                                                $loan
                                            ) }}">

                                            @csrf
                                            @method('PATCH')

                                            <label class="form-label">
                                                Rejection Reason
                                            </label>

                                            <div class="input-group input-group-sm">

                                                <input
                                                    type="text"
                                                    name="admin_note"
                                                    class="form-control"
                                                    placeholder="Write rejection reason"
                                                    required>

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm(
                                                        'Reject this loan request?'
                                                    )">

                                                    <i class="bx bx-x me-1"></i>

                                                    Reject

                                                </button>

                                            </div>

                                        </form>

                                    @else

                                        {{-- Processed Loan Details --}}

                                        <div class="border rounded p-3">

                                            <div class="row g-3">

                                                <div class="col-6">

                                                    <small class="text-muted d-block">
                                                        Approved Amount
                                                    </small>

                                                    <span class="fw-semibold">

                                                        ৳{{ number_format(
                                                            $loan->requested_amount,
                                                            2
                                                        ) }}

                                                    </span>

                                                </div>

                                                <div class="col-6">

                                                    <small class="text-muted d-block">
                                                        Monthly Installment
                                                    </small>

                                                    <span class="fw-semibold text-danger">

                                                        ৳{{ number_format(
                                                            $loan->monthly_installment,
                                                            2
                                                        ) }}

                                                    </span>

                                                </div>

                                                <div class="col-6">

                                                    <small class="text-muted d-block">
                                                        Remaining Balance
                                                    </small>

                                                    <span class="fw-semibold">

                                                        ৳{{ number_format(
                                                            $loan->remaining_balance,
                                                            2
                                                        ) }}

                                                    </span>

                                                </div>

                                                <div class="col-6">

                                                    <small class="text-muted d-block">
                                                        Installment Period
                                                    </small>

                                                    <span class="fw-semibold">

                                                        {{ $loan->installment_months }}
                                                        Months

                                                    </span>

                                                </div>

                                                <div class="col-12">

                                                    <small class="text-muted d-block">
                                                        Deduction Start Month
                                                    </small>

                                                    <span class="fw-semibold">

                                                        {{ optional(
                                                            $loan->deduction_start_month
                                                        )->format('F Y') ?? 'Not Set' }}

                                                    </span>

                                                </div>

                                                <div class="col-12">

                                                    <small class="text-muted d-block">
                                                        Reviewed By
                                                    </small>

                                                    <span class="fw-semibold">

                                                        {{ $loan->reviewer?->name
                                                            ?? 'N/A' }}

                                                    </span>

                                                </div>

                                                <div class="col-12">

                                                    <small class="text-muted d-block">
                                                        Reviewed At
                                                    </small>

                                                    <span class="fw-semibold">

                                                        {{ optional(
                                                            $loan->reviewed_at
                                                        )
                                                            ?->timezone('Asia/Dhaka')
                                                            ->format(
                                                                'd M Y, h:i A'
                                                            )
                                                            ?? 'N/A' }}

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

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5">

                                    <i class="bx bx-credit-card display-5 text-muted"></i>

                                    <h6 class="fw-bold mt-3">
                                        No Loan Requests Found
                                    </h6>

                                    <p class="text-muted mb-0">

                                        Manager বা Employee এখনো কোনো loan request করেনি।

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


<script>
document.addEventListener('DOMContentLoaded', function () {

    document
        .querySelectorAll('form')
        .forEach(function (form) {

            const monthInput = form.querySelector(
                '.loan-month-input'
            );

            const hiddenInput = form.querySelector(
                '.loan-month-hidden'
            );

            if (!monthInput || !hiddenInput) {
                return;
            }

            function syncMonthValue() {

                hiddenInput.value = monthInput.value
                    ? monthInput.value + '-01'
                    : '';

            }

            syncMonthValue();

            monthInput.addEventListener(
                'change',
                syncMonthValue
            );

            form.addEventListener(
                'submit',
                syncMonthValue
            );

        });

});
</script>

@endsection
