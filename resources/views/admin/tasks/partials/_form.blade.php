@csrf

<div class="row g-3">

    <div class="col-md-12">
        <label class="form-label">
            Task Title <span class="text-danger">*</span>
        </label>

        <input type="text"
               name="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $task->title ?? '') }}"
               placeholder="Enter task title">

        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">
            Description <span class="text-danger">*</span>
        </label>

        <textarea name="description"
                  rows="6"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Write task details...">{{ old('description', $task->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Employee <span class="text-danger">*</span>
        </label>

        <select name="employee_id"
                class="form-select @error('employee_id') is-invalid @enderror">

            <option value="">Select Employee</option>

            @foreach($employees as $employee)
                <option value="{{ $employee->id }}"
                    {{ (string) old('employee_id', $task->employee_id ?? '') === (string) $employee->id ? 'selected' : '' }}>

                    {{ $employee->name }}
                    @if($employee->designation)
                        — {{ $employee->designation }}
                    @endif

                </option>
            @endforeach

        </select>

        @error('employee_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Manager</label>

        <select name="manager_id"
                class="form-select @error('manager_id') is-invalid @enderror">

            <option value="">Select Manager</option>

            @foreach($managers as $manager)
                <option value="{{ $manager->id }}"
                    {{ (string) old('manager_id', $task->manager_id ?? '') === (string) $manager->id ? 'selected' : '' }}>

                    {{ $manager->name }}

                </option>
            @endforeach

        </select>

        @error('manager_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Priority</label>

        <select name="priority"
                class="form-select @error('priority') is-invalid @enderror">

            @foreach(['Low', 'Medium', 'High', 'Urgent'] as $priority)
                <option value="{{ $priority }}"
                    {{ old('priority', $task->priority ?? 'Medium') === $priority ? 'selected' : '' }}>

                    {{ $priority }}

                </option>
            @endforeach

        </select>

        @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status</label>

        <select name="status"
                class="form-select @error('status') is-invalid @enderror">

            @foreach(['Pending', 'In Progress', 'Completed', 'Rejected', 'Overdue'] as $status)
                <option value="{{ $status }}"
                    {{ old('status', $task->status ?? 'Pending') === $status ? 'selected' : '' }}>

                    {{ $status }}

                </option>
            @endforeach

        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Attachment</label>

        <input type="file"
               name="attachment"
               class="form-control @error('attachment') is-invalid @enderror">

        @error('attachment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @isset($task)
            @if($task->attachment)
                <small class="text-success d-block mt-2">
                    Current: {{ basename($task->attachment) }}
                </small>
            @endif
        @endisset
    </div>

    <div class="col-md-6">
        <label class="form-label">Start Date</label>

        <input type="date"
               name="start_date"
               class="form-control @error('start_date') is-invalid @enderror"
               value="{{ old('start_date', isset($task) && $task->start_date ? $task->start_date->format('Y-m-d') : '') }}">

        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Due Date <span class="text-danger">*</span>
        </label>

        <input type="date"
               name="due_date"
               class="form-control @error('due_date') is-invalid @enderror"
               value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">

        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">

    <a href="{{ route('admin.tasks.index') }}"
       class="btn btn-light border">

        Cancel

    </a>

    <button type="submit"
            class="btn btn-primary px-4">

        <i class="bx bx-save me-1"></i>

        {{ isset($task) ? 'Update Task' : 'Assign Task' }}

    </button>

</div>
