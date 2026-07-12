@extends('admin.master')

@section('content')

<div class="page-content">

    <div class="card radius-10 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0">
                    <i class="bx bx-calendar-event"></i>
                    Holiday Management
                </h4>

                <small class="text-muted">
                    Manage company holidays
                </small>

            </div>

            <a href="{{ route('admin.holidays.create') }}"
               class="btn btn-primary">

                <i class="bx bx-plus"></i>
                Add Holiday

            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Holiday</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Total Days</th>

                            <th>Status</th>

                            <th width="180">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($holidays as $key => $holiday)

                        <tr>

                            <td>
                                {{ $holidays->firstItem()+$key }}
                            </td>

                            <td>

                                <strong>

                                    {{ $holiday->title }}

                                </strong>

                            </td>

                            <td>

                                {{ date('d M Y',strtotime($holiday->start_date)) }}

                            </td>

                            <td>

                                {{ date('d M Y',strtotime($holiday->end_date)) }}

                            </td>

                            <td>

                                {{ $holiday->total_days }}

                                Days

                            </td>

                            <td>

                                @if($holiday->status=='Active')

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.holidays.show',$holiday->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="bx bx-show"></i>

                                </a>

                                <a href="{{ route('admin.holidays.edit',$holiday->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bx bx-edit"></i>

                                </a>

                                <form
                                    action="{{ route('admin.holidays.destroy',$holiday->id) }}"
                                    method="POST"
                                    style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete Holiday?')"
                                        class="btn btn-danger btn-sm">

                                        <i class="bx bx-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                No Holiday Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{ $holidays->links() }}

        </div>

    </div>

</div>

@endsection
