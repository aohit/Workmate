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
        /* font-size: 14px; */
    }

    #calendar {
        max-width: 100%;
        margin: 40px auto;
    }

    span.fc-cell-text.fc-sticky {
        white-space: break-spaces;
    }

    /* .fc-timeline td, .fc-timeline th {
    white-space: pre-line !important;
} */


    .modal{



/*From Right/Left */
&.drawer{

  display: flex !important;

  pointer-events: none;
  * {
    pointer-events: none;
  }

  .modal-dialog{
    margin: 0px;
    display: flex;
    flex: auto;
    transform: translate(25%, 0);
    .modal-content{
      border:none;
      border-radius: 0px;
      .modal-body{
        overflow: auto;
      }
    }

  }

  &.show{
    pointer-events: auto;
    * {
      pointer-events: auto;
    }
    .modal-dialog{
      transform: translate(0, 0);
    }
  }

  &.right-align{
    flex-direction: row-reverse;
  }
  &.left-align{
    &:not(.show){
      .modal-dialog{
        transform: translate(-25%, 0);
      }
    }
  }

}


}
</style>

<div class="container p-0">
    <div class="row">
              <div class="mb-3 col-lg-2">
        <div class="mb-3">
        <label for="validationCustom13" class="form-label">Department</label>
        <select class="form-select" name="department" onchange="GetEmployee(this)">
          <option value="">-Select-</option>
          @foreach($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
        </div>
        <div class="employee-data">
        
        </div>
      </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="modal fade drawer right-align" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       
      </div>
    </div>
  </div>
  
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
        if (!time || !/(\d+):(\d+)\s(AM|PM)/.test(time)) {
            throw new Error(`Invalid time format: ${time}`);
        }

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

        if (leave.type == 2 || leave.type == 3 || leave.type == 4 || leave.type == 0) {
            startTime = leave.start_time;
            endTime = leave.end_time;
        } else if (leave.type == 1) {
            startTime = '8:00 AM';
            endTime = '4:00 PM';
        } else if (leave.type == 5) {
        startTime = '8:00 AM';
        endTime = '4:00 PM';
    }

        try {
            return {
                id: leave.id,
                resourceId: leave.employee_id,
                title: leave.leave_requests.leave_type.type,
                start: convertToISO(leave.date, startTime),
                end: convertToISO(leave.date, endTime),
                color: leave.leave_requests.leave_type.color_code
            };
        } catch (error) {
            return null;
        }
    }).filter(event => event !== null);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'resourceTimeline', 'timeGrid'],
        timeZone: 'local',
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineTwentyDay,resourceTimelineMonth,resourceTimelineYear'
        },
        defaultView: 'resourceTimelineDay',
        scrollTime: '08:00',
        aspectRatio: 1.5,
        minTime: '08:00:00',
        maxTime: '16:00:00',
        views: {
            resourceTimelineDay: {
                buttonText: 'Today',
                slotDuration: '00:30'
            },
            resourceTimelineTenDay: {
                type: 'resourceTimeline',
                duration: { days: 7 },
                buttonText: '7 days',
            },
            resourceTimelineTwentyDay: {
                type: 'resourceTimeline',
                duration: { days: 14 },
                buttonText: '14 days',
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
        events: events,
        selectable: true,
        selectHelper: true,

        // Disable weekends (Saturday and Sunday)
        validRange: {
            start: '2024-01-01', // Specify start date (adjust as needed)
            end: '2024-12-31'   // Specify end date (adjust as needed)
        },
        businessHours: {
            // Disable weekends for dragging and event creation
            daysOfWeek: [1, 2, 3, 4, 5], // Only Monday through Friday are valid
            startTime: '08:00',
            endTime: '16:00'
        },

       
        drop: function(info) {
            var date = info.date;
            if (date.getDay() === 0 || date.getDay() === 6) { 
                info.revert();
                alert("You cannot drag events to weekends.");
            }
        },

        // Event selection (on click or click + drag)
        select: function(info) {
            var startTime = info.startStr;
            var endTime = info.endStr;
            var id = info.resource.id;
            var defaltView = info.view.viewSpec.buttonTextDefault;

            // Prevent selection of weekends (Saturday and Sunday)
            if (info.start.getDay() === 0 || info.start.getDay() === 7 || info.end.getDay() === 0 || info.end.getDay() === 7) {
                calendar.unselect();
                alert("You cannot select weekends.");
                return;
            }

            const url = "{{ route('admin.calendar.fullcalendar') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    startTime: startTime,
                    endTime: endTime,
                    employeeId: id,
                    defaltView: defaltView,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.modal-content').html(response);
                    $('#exampleModalRight').modal('show');
                },
                error: function(error) {
                    console.error(error);
                    alert('There was an error while adding the event.');
                }
            });
        }
    });

    $('#calendar').wrap('<div class="table-responsive my-3"></div>');
    calendar.render();

    window.GetEmployee = function(element) {
        var depId = $(element).val();
        var url = "{{ route('admin.calendar.filterEmployees') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                'depId': depId
            },
            success: function(response) {
                var user = response.user;
                var usersData = user.map(users => {
                    return {
                        id: users.id,
                        title: users.name
                    };
                });
                console.log(usersData);
                calendar.getResources().forEach(resource => resource.remove());

                if (usersData.length > 0) {
                    usersData.forEach(employee => {
                        calendar.addResource(employee);
                    });
                } else {
                    alert("No employees found for the selected department.");
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    };
});
</script>
@endsection