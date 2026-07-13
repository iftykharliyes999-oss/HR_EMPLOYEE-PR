<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Title</th>

                        <th>Priority</th>

                        <th>Audience</th>

                        <th>Status</th>

                        <th>Created By</th>

                        <th>Date</th>

                        <th width="120">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($notifications as $notification)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $notification->title }}</td>

                        <td>

                            @switch($notification->priority)

                                @case('Urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                    @break

                                @case('Important')
                                    <span class="badge bg-warning text-dark">
                                        Important
                                    </span>
                                    @break

                                @default
                                    <span class="badge bg-success">
                                        Normal
                                    </span>

                            @endswitch

                        </td>

                        <td>

                            <span class="badge bg-info">

                                {{ $notification->audience }}

                            </span>

                        </td>

                        <td>

                            @if($notification->status=='Published')

                                <span class="badge bg-success">

                                    Published

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Draft

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $notification->creator->name ?? '-' }}

                        </td>

                        <td>

                            {{ $notification->created_at->format('d M Y') }}

                        </td>

                        <td>

                            <div class="dropdown">

    <button class="btn btn-sm btn-light dropdown-toggle"
            data-bs-toggle="dropdown">

        Action

    </button>

    <ul class="dropdown-menu">

        <li>

            <a class="dropdown-item"
               href="{{ route('admin.notifications.show', $notification) }}">

                <i class="bx bx-show"></i>

                View

            </a>

        </li>

        <li>

            <a class="dropdown-item"
               href="{{ route('admin.notifications.edit', $notification) }}">

                <i class="bx bx-edit"></i>

                Edit

            </a>

        </li>

        <li>

            <form action="{{ route('admin.notifications.destroy', $notification) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this notification?');">

                @csrf
                @method('DELETE')

                <button class="dropdown-item text-danger">

                    <i class="bx bx-trash"></i>

                    Delete

                </button>

            </form>

        </li>

    </ul>

</div>

                        </td>

                    </tr>

                    @empty

                        @include('admin.notifications.partials._empty')

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $notifications->links() }}

        </div>

    </div>

</div>
