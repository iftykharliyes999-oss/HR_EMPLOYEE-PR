<div class="card mb-4">
    <div class="card-body">

        <form action="{{ route('admin.notifications.index') }}" method="GET">

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-md-4">

                    <label class="form-label">Search</label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search notification..."
                        value="{{ request('search') }}">

                </div>

                {{-- Status --}}
                <div class="col-md-2">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="">All</option>

                        <option value="Published"
                            {{ request('status')=='Published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="Draft"
                            {{ request('status')=='Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>

                {{-- Priority --}}
                <div class="col-md-2">

                    <label class="form-label">Priority</label>

                    <select name="priority" class="form-select">

                        <option value="">All</option>

                        <option value="Urgent">Urgent</option>

                        <option value="Important">Important</option>

                        <option value="Normal">Normal</option>

                    </select>

                </div>

                {{-- Audience --}}
                <div class="col-md-2">

                    <label class="form-label">Audience</label>

                    <select name="audience" class="form-select">

                        <option value="">All</option>

                        <option value="All">All Users</option>

                        <option value="Managers">Managers</option>

                        <option value="Employees">Employees</option>

                    </select>

                </div>

                {{-- Buttons --}}
                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary me-2 w-100">

                        <i class="bx bx-search"></i>

                    </button>

                    <a href="{{ route('admin.notifications.index') }}"
                       class="btn btn-light w-100">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>
</div>
