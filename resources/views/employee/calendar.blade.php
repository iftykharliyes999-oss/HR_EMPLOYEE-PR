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

@endpush
