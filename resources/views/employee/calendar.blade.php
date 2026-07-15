@extends('employee.master')

@section('content')

<div class="page-content">

    <div class="card">

        <div class="card-header bg-white">

            <h4>

                Attendance Calendar

            </h4>

        </div>

        <div class="card-body">

            <div id="calendar"></div>

        </div>

    </div>

</div>
<div class="modal fade" id="attendanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Attendance Details
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <p>
                    <strong>Status:</strong>
                    <span id="attendanceStatus"></span>
                </p>

                <p>
                    <strong>Clock In:</strong>
                    <span id="clockIn"></span>
                </p>

                <p>
                    <strong>Clock Out:</strong>
                    <span id="clockOut"></span>
                </p>

                <p>
                    <strong>Working Hours:</strong>
                    <span id="workingHours"></span>
                </p>

                <p>
                    <strong>Clock-in Approval:</strong>
                    <span id="clockInApproval"></span>
                </p>

                <p>
                    <strong>Clock-out Approval:</strong>
                    <span id="clockOutApproval"></span>
                </p>
            </div>

        </div>
    </div>
</div>

@endsection

@push('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl =
        document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(
        calendarEl,
        {

            initialView: 'dayGridMonth',

            height: 750,

            events:
            "{{ route('employee.calendar.events') }}"

        }
    );

    calendar.render();

});

</script>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarElement =
        document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(
        calendarElement,
        {
            initialView: 'dayGridMonth',
            height: 750,

            events: "{{ route('employee.calendar.events') }}",

            eventClick: function (info) {
                const props = info.event.extendedProps;

                document.getElementById(
                    'attendanceStatus'
                ).textContent = info.event.title || '-';

                document.getElementById(
                    'clockIn'
                ).textContent = props.clock_in || '-';

                document.getElementById(
                    'clockOut'
                ).textContent = props.clock_out || '-';

                document.getElementById(
                    'workingHours'
                ).textContent = props.working_hours || '-';

                document.getElementById(
                    'clockInApproval'
                ).textContent =
                    props.clock_in_approval || '-';

                document.getElementById(
                    'clockOutApproval'
                ).textContent =
                    props.clock_out_approval || '-';

                const modal = new bootstrap.Modal(
                    document.getElementById(
                        'attendanceModal'
                    )
                );

                modal.show();
            }
        }
    );

    calendar.render();
});
</script>
@endpush

@endpush
