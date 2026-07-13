@csrf

<div class="row">

    {{-- Title --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Notice Title
            <span class="text-danger">*</span>
        </label>

        <input type="text"
               name="title"
               class="form-control @error('title') is-invalid @enderror"
               placeholder="Enter notification title"
               value="{{ old('title', $notification->title ?? '') }}">

        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Message --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Notice Message
            <span class="text-danger">*</span>
        </label>

        <textarea
            name="message"
            rows="6"
            class="form-control @error('message') is-invalid @enderror"
            placeholder="Write notification message...">{{ old('message', $notification->message ?? '') }}</textarea>

        @error('message')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Priority --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Priority
        </label>

        <select name="priority"
                class="form-select @error('priority') is-invalid @enderror">

            <option value="Normal"
                {{ old('priority', $notification->priority ?? '') == 'Normal' ? 'selected' : '' }}>
                Normal
            </option>

            <option value="Important"
                {{ old('priority', $notification->priority ?? '') == 'Important' ? 'selected' : '' }}>
                Important
            </option>

            <option value="Urgent"
                {{ old('priority', $notification->priority ?? '') == 'Urgent' ? 'selected' : '' }}>
                Urgent
            </option>

        </select>

        @error('priority')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Audience --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Audience
        </label>

        <select name="audience"
                class="form-select @error('audience') is-invalid @enderror">

            <option value="All"
                {{ old('audience', $notification->audience ?? '') == 'All' ? 'selected' : '' }}>
                All
            </option>

            <option value="Managers"
                {{ old('audience', $notification->audience ?? '') == 'Managers' ? 'selected' : '' }}>
                Managers
            </option>

            <option value="Employees"
                {{ old('audience', $notification->audience ?? '') == 'Employees' ? 'selected' : '' }}>
                Employees
            </option>

        </select>

        @error('audience')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Attachment --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Attachment
        </label>

        <input type="file"
               name="attachment"
               class="form-control @error('attachment') is-invalid @enderror">

        @error('attachment')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @isset($notification)
            @if($notification->attachment)
                <small class="text-success d-block mt-2">
                    Current File:
                    {{ basename($notification->attachment) }}
                </small>
            @endif
        @endisset

    </div>

    {{-- Publish Date --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Publish Date
        </label>

        <input type="datetime-local"
               name="publish_at"
               class="form-control"
               value="{{ old('publish_at', isset($notification->publish_at) ? $notification->publish_at->format('Y-m-d\TH:i') : '') }}">

    </div>

    {{-- Expire Date --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Expire Date
        </label>

        <input type="datetime-local"
               name="expire_at"
               class="form-control"
               value="{{ old('expire_at', isset($notification->expire_at) ? $notification->expire_at->format('Y-m-d\TH:i') : '') }}">

    </div>

    {{-- Status --}}
    <div class="col-md-12 mb-4">

        <label class="form-label">
            Status
        </label>

        <select name="status"
                class="form-select @error('status') is-invalid @enderror">

            <option value="Draft"
                {{ old('status', $notification->status ?? '') == 'Draft' ? 'selected' : '' }}>
                Draft
            </option>

            <option value="Published"
                {{ old('status', $notification->status ?? '') == 'Published' ? 'selected' : '' }}>
                Published
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

<div class="d-flex justify-content-end">

    <a href="{{ route('admin.notifications.index') }}"
       class="btn btn-secondary me-2">

        Cancel

    </a>

    <button type="submit"
            class="btn btn-primary">

        <i class="bx bx-save"></i>

        {{ isset($notification) ? 'Update Notification' : 'Publish Notification' }}

    </button>

</div>
