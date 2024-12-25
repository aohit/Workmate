@extends('admin.layouts.app')

@section('content')

<link rel="stylesheet" href="https://fullcalendar.io/releases/core/4.2.0/main.min.css">
<link rel="stylesheet" href="https://fullcalendar.io/releases/timeline/4.2.0/main.min.css">
<link rel="stylesheet" href="https://fullcalendar.io/releases/resource-timeline/4.2.0/main.min.css">

<script src="https://fullcalendar.io/releases/core/4.2.0/main.min.js"></script>
<script src="https://fullcalendar.io/releases/interaction/4.2.0/main.min.js"></script>
<script src="https://fullcalendar.io/releases/timeline/4.2.0/main.min.js"></script>
<script src="https://fullcalendar.io/releases/resource-common/4.2.0/main.min.js"></script>
<script src="https://fullcalendar.io/releases/resource-timeline/4.2.0/main.min.js"></script>
<script src="https://fullcalendar.io/releases/timegrid/4.2.0/main.min.js"></script>

<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 100%;
        margin: 40px auto;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@php 
    //  foreach ($leaveschedule as  $value) {
    //     echo $value->leaveRequests->leaveType->type;
    //  }
 @endphp
@endsection

@section('page-js-script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    const employeeData = @json($employees);
    const leaveData = @json($leavedata);
    const leavescheduleData = @json($leaveschedule);

    var employees = employeeData.map(employee => {
        return {
            id: employee.id,
            title: employee.name
        };
    });

    function convertToISO(date, time) {

        const [hours, minutes, period] = time.match(/(\d+):(\d+)\s(AM|PM)/).slice(1);

        let hours24 = parseInt(hours);
        if (period === 'PM' && hours24 !== 12) {
            hours24 += 12;
        } else if (period === 'AM' && hours24 === 12) {
            hours24 = 0;
        }
        return `${date}T${hours24.toString().padStart(2, '0')}:${minutes.padStart(2, '0')}:00`;
    }


        var events = leavescheduleData.map(leave => {
           
            let startTime;
            let endTime;

            if(leave.type == 2){
              startTime = '9:00 AM';
              endTime = '1:00 PM';
            }else if (leave.type == 3){
                 startTime = '2:00 PM';
                 endTime = '6:00 PM';
            }else if(leave.type == 1){
                startTime = '12:00 AM';
                 endTime = '11:59 PM';
            }else if(leave.type == 4){
                startTime = leave.start_time;
                 endTime = leave.end_time;
            }

            return {
                id: leave.id,
                resourceId: leave.employee_id,
                title: leave.leave_requests.leave_type.type,
                start: convertToISO(leave.date, startTime),
                end: convertToISO(leave.date, endTime),
                color: leave.leave_requests.leave_type.color_code
            };
        });

    // console.log(events)

    //     var leaveEvents = leaveData.map(leaves => { 
    //     return {
    //     id: leaves.id,
    //     resourceId: leaves.employee_id,
    //     start: leaves.start_date,
    //     end: leaves.end_date,
    //     color: leaves.leave_type.color_code,
    //     title: leaves.leave_type.type
    //     };
    // });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'resourceTimeline', 'timeGrid'],
        timeZone: 'local', // Use local time zone
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineTwentyDay,resourceTimelineMonth,resourceTimelineYear'
        },
        defaultView: 'resourceTimelineDay',
        scrollTime: '08:00',
        aspectRatio: 1.5,
        minTime: '00:00:00',
        maxTime: '24:00:00',
        views: {
            resourceTimelineDay: {
                buttonText: ':15 slots',
                slotDuration: '00:15'
            },
            resourceTimelineTenDay: {
                type: 'resourceTimeline',
                duration: { days: 10 },
                buttonText: '10 days'
            },
            resourceTimelineTwentyDay: {
                type: 'resourceTimeline',
                duration: { days: 12 },
                buttonText: '12 days',
                slotDuration: '24:00:00'
            },
            timeGridDay: {
                slotDuration: '00:15',
                slotLabelInterval: '01:00',
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit'
                }
            }
        },
        editable: true,
        resourceLabelText: 'Employees',
        resources: employees,
        events: [...events],
    });

    calendar.render();
});

</script>
@endsection