@csrf

<div class="row g-3">

    <div class="col-md-12">
        <label class="form-label">
            Task Title <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="title"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title') }}"
            placeholder="Enter task title">

        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">
            Description <span class="text-danger">*</span>
        </label>

        <textarea
            name="description"
            rows="6"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Write task details and instructions...">{{ old('description') }}</textarea>

        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Employee <span class="text-danger">*</span>
        </label>

        <select
            name="employee_id"
            class="form-select @error('employee_id') is-invalid @enderror">

            <option value="">Select Employee</option>

            @forelse($employees as $employee)

                <option
                    value="{{ $employee->id }}"
                    {{ (string) old('employee_id') === (string) $employee->id ? 'selected' : '' }}>

                    {{ $employee->name }}

                    @if($employee->designation)
                        — {{ $employee->designation }}
                    @endif

                </option>

            @empty

                <option value="" disabled>
                    No employees assigned to you
                </option>

            @endforelse

        </select>

        @error('employee_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Priority <span class="text-danger">*</span>
        </label>

        <select
            name="priority"
            class="form-select @error('priority') is-invalid @enderror">

            @foreach(['Low', 'Medium', 'High', 'Urgent'] as $priority)

                <option
                    value="{{ $priority }}"
                    {{ old('priority', 'Medium') === $priority ? 'selected' : '' }}>

                    {{ $priority }}

                </option>

            @endforeach

        </select>

        @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Start Date</label>

        <input
            type="date"
            name="start_date"
            class="form-control @error('start_date') is-invalid @enderror"
            value="{{ old('start_date') }}">

        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Due Date <span class="text-danger">*</span>
        </label>

        <input
            type="date"
            name="due_date"
            class="form-control @error('due_date') is-invalid @enderror"
            value="{{ old('due_date') }}">

        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Attachment</label>

        <input
            type="file"
            name="attachment"
            class="form-control @error('attachment') is-invalid @enderror">

        <small class="text-muted">
            Allowed: PDF, DOC, DOCX, JPG, JPEG, PNG, ZIP. Maximum 10 MB.
        </small>

        @error('attachment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">

    <a
        href="{{ route('manager.tasks.index') }}"
        class="btn btn-light border">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary px-4"
        {{ $employees->isEmpty() ? 'disabled' : '' }}>

        <i class="bx bx-task me-1"></i>
        Assign Task

    </button>

</div>
