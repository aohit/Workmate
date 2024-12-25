@extends('user.layouts.app')
@section('content')
    <style>
        th.days {
            font-size: 10px;
            font-weight: 500;
            padding-right: 9px;
        }

        tr {
            height: 3px;
        }

        .weekend {
            /* background-color: aliceblue; */
        }

        #holidayPopup {
            display: none;
            position: absolute;
            z-index: 10;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
        }

        .holidayhover {
            cursor: pointer;
        }

        .modal {

            /*From Right/Left */
            &.drawer {
                display: flex !important;
                pointer-events: none;

                * {
                    pointer-events: none;
                }

                .modal-dialog {
                    margin: 0px;
                    display: flex;
                    flex: auto;
                    transform: translate(25%, 0);

                    .modal-content {
                        border: none;
                        border-radius: 0px;

                        .modal-body {
                            overflow: auto;
                        }
                    }
                }

                &.show {
                    pointer-events: auto;

                    * {
                        pointer-events: auto;
                    }

                    .modal-dialog {
                        transform: translate(0, 0);
                    }
                }

                &.right-align {
                    flex-direction: row-reverse;
                }

                &.left-align {
                    &:not(.show) {
                        .modal-dialog {
                            transform: translate(-25%, 0);
                        }
                    }
                }
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        #calendarContainer {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            gap: 5px
        }

        .month {
            flex: 1 0 100%;
            /* Default to one column */
            box-sizing: border-box;
            margin: 2px;
            padding: 0px;
            position: relative;
        }

        .month .card {
            height: 100%;
        }

        .month h3 {
            text-align: center;
            margin: 0 0 10px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            /* 7 columns for 7 days of the week */
            gap: 1px;
        }

        .day {
            box-sizing: border-box;
            height: 50px;
            padding: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .weekend {
            background-color: #f0f0f0;
        }

        .leave {
            background-color: #ffcccc;
        }

        .tooltip {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            border-radius: 3px;
            display: none;
        }
        span.keycolor {
            display: block;
            width: 15px;
            height: 15px;
        }

        /* Responsive layout */
        @media (min-width: 600px) {
            .month {
                flex: 1 0 48%;
                /* Two columns for screens >= 600px */
            }
        }

        @media (min-width: 900px) {
            .month {
                flex: 1 0 30%;
                /* Three columns for screens >= 900px */
            }
        }

        @media (min-width: 1200px) {
            .month {
                flex: 1 0 21%;
                /* Five columns for screens >= 1200px */
            }
        }
    </style>

    <div class="modal fade drawer right-align" id="exampleModalRight" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="rightSideModal">
                <!-- Modal content will be dynamically loaded here -->
            </div>
        </div>
    </div>
    <div class="container p-0">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div id="calendarContainer"></div>
            </div>
            <div id="announcements" class="col-lg-3 col-md-4">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Key</h4>
                           <div class="row align-items-center">
                            @foreach ($annulLeaveTypes as $leavetype)     
                                <div class="col-8">{{$leavetype->type}}</div>
                                <div class="col-4"><span class="keycolor rounded-circle" style="background-color:{{$leavetype->color_code}};"></span></div>
                            @endforeach
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Quick Summary</h3>
                              <label for="leave">Leave Types</label>
                            <select class="form-select pb-1" name="leavetype" id="leaveTypeData" onchange="LeaveTypeData()">
                                @foreach ($leaveTypes as $leaveType)
                                    <option value="{{$leaveType->id}}">{{$leaveType->type}}</option>
                                @endforeach
                            </select>
                            <div class="main pt-2">
                            </div>
                            
                            {{-- <h4 class="card-title">Annual Leave</h4>
                            <p> Annual Leave <samp class="annualLeave"></samp> </p>
                            <p>Booked/Taken <samp class="bookedAnnulLeaved"></samp></p>
                            <p> Remaining <samp class="remainingAnnulLeave"></samp></p> --}}
                           {{--   @foreach ($leaveTypes as $leaveType)
                            @if($leaveType->id == 1 || $leaveType->id == 4 )    
                            <h4 class="card-title"> {{$leaveType->type}} </h4>
                            <p> Entitlement <samp >{{$leaveType->leave_days}} </samp> </p>
                            <p> Booked/Taken <samp >{{$leaveType->totalLeavesrequest}} </samp> </p>
                            <p> Remaining <samp >{{$leaveType->remainingLeaves}} </samp> </p>
                            @endif
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('page-js-script')
        <script>

document.addEventListener("DOMContentLoaded", function() {
    function openRightModal(content) {
        const modalContainer = document.createElement('div');
        modalContainer.className = 'right-modal-container';
        modalContainer.innerHTML = content;
        document.body.appendChild(modalContainer);
    }

    const leaveData = @json($leave);
    const annualLeaveType = @json($annulLeaveTypes);
    const lastLeave = @json($lastLeave);
    const holidays = @json($public_holidays);
    const calendarContainer = document.getElementById('calendarContainer');
    const months = @json($months);
    const daysOfWeek = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

    function padZero(number) {
        return number.toString().padStart(2, '0');
    }
    let countofleavetype = 0;
    annualLeaveType.forEach(leavetype => {
        countofleavetype += leavetype.leave_days;
    });

    function formatDate(year, month, day) {
        return `${year}-${padZero(month)}-${padZero(day)}`;
    }

    function dateInRange(date, start, end) {
        const d = new Date(date);
        const s = new Date(start);
        const e = new Date(end);
        return d >= s && d <= e;
    }

    function isWeekend(date) {
        const day = date.getDay();
        return day === 0 || day === 6; // Sunday = 0, Saturday = 6
    }

    function countDaysExcludingWeekends(start, end) {
    let count = 0;
    let currentDate = new Date(start);
    const endDate = new Date(end);

    while (currentDate <= endDate) {
        const day = currentDate.getDay();
        if (day !== 0 && day !== 6) { // Exclude Sundays (0) and Saturdays (6)
            count++;
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }
    return count;
}

    function countNonWeekendDays(start, end) {
        let count = 0;
        let currentDate = new Date(start);
        const endDate = new Date(end);

        while (currentDate <= endDate) {
            if (!isWeekend(currentDate)) {
                count++;
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }
        return count;
    }

    function updateAnnualLeaveCount() {
        let totalLeaveDays = 0;
        leaveData.forEach(leave => {
            totalLeaveDays += countNonWeekendDays(leave.start_date, leave.end_date);
        });

        const annualLeaveSpan = document.querySelector('.annualLeave');
        const bookedAnnulLeavedSpan = document.querySelector('.bookedAnnulLeaved');
        const remainingAnnulLeaveSpan = document.querySelector('.remainingAnnulLeave');
        const lastLeaveCountSpan = document.querySelector('.lastLeaveCount');
        const lastLeaveTypeSpan = document.querySelector('.lastLeaveType');
        
        if (annualLeaveSpan) {
            annualLeaveSpan.textContent = countofleavetype;
        }

        if (bookedAnnulLeavedSpan) {
            bookedAnnulLeavedSpan.textContent = totalLeaveDays;
        }

        if (remainingAnnulLeaveSpan) {
            remainingAnnulLeaveSpan.textContent = countofleavetype - totalLeaveDays;
        }

        if (lastLeaveCountSpan && lastLeaveTypeSpan) {
            const lastLeaveDays = countDaysExcludingWeekends(lastLeave.start_date, lastLeave.end_date);
            lastLeaveCountSpan.textContent = lastLeaveDays;
            lastLeaveTypeSpan.textContent = lastLeave.leave_type.type;
        
        }
    }

    function generateCalendar() {
        const year = new Date().getFullYear();
        let monthcount = {{ count($months) }}
        for (let month = 0; month < monthcount; month++) {
            const monthDiv = document.createElement('div');
            monthDiv.className = 'month';

            const cardDiv = document.createElement('div');
            cardDiv.className = 'card';

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            const monthHeader = document.createElement('h3');
            monthHeader.className = 'card-title';
            monthHeader.textContent = `${months[month]} ${year}`;
            cardBody.appendChild(monthHeader);

            const daysDiv = document.createElement('div');
            daysDiv.className = 'days';

            // Add day names
            daysOfWeek.forEach(day => {
                const dayNameDiv = document.createElement('div');
                dayNameDiv.className = 'day';
                dayNameDiv.textContent = day;
                daysDiv.appendChild(dayNameDiv);
            });

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Adjust firstDay to make Monday the first day of the week
            const adjustedFirstDay = (firstDay + 6) % 7;

            // Add empty days for the first week
            for (let i = 0; i < adjustedFirstDay; i++) {
                const emptyDiv = document.createElement('div');
                emptyDiv.className = 'day';
                daysDiv.appendChild(emptyDiv);
            }

            // Add days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'day';
                dayDiv.textContent = day;

                const date = formatDate(year, month + 1, day);
                const isWeekend = (new Date(date).getDay() === 0 || new Date(date).getDay() === 6);

                if (isWeekend) {
                    dayDiv.classList.add('weekend');
                }

                leaveData.forEach(leave => {
                    if (dateInRange(date, leave.start_date, leave.end_date)) {
                        dayDiv.classList.add('leave');
                        if (leave.leave_type && leave.leave_type.color_code) {
                            dayDiv.style.backgroundColor = leave.leave_type.color_code;
                        }

                        if (!dayDiv.hasAttribute('data-clicked')) {
                            dayDiv.setAttribute('data-clicked', 'false'); // Initial state

                            dayDiv.addEventListener('click', function() {
                                const leaveId = leave.id;
                                const url =
                                    "{{ route('leave.sidemodal', ['id' => ':leaveId']) }}"
                                    .replace(':leaveId', leaveId);
                                fetch(url)
                                    .then(response => response.text())
                                    .then(data => {
                                        const rightSideModal = document.getElementById(
                                            'exampleModalRight');
                                        if (rightSideModal) {
                                            const modalContent = rightSideModal
                                                .querySelector('.modal-content');
                                            modalContent.innerHTML = data;
                                            new bootstrap.Modal(rightSideModal).show();
                                        } else {
                                            alert.error(
                                                'Error: Modal element not found.');
                                        }
                                    })
                                    .catch(error => {
                                        alert.error('Error fetching leave details:',
                                            error);
                                    });

                                this.setAttribute('data-clicked', 'true');
                            });
                        }
                    }
                });

                const holiday = holidays.find(holiday => holiday.date === date);
                if (holiday) {
                    dayDiv.style.backgroundColor = holiday.color;
                }

                daysDiv.appendChild(dayDiv);
            }

            cardBody.appendChild(daysDiv);
            cardDiv.appendChild(cardBody);
            monthDiv.appendChild(cardDiv);
            calendarContainer.appendChild(monthDiv);
        }
    }

    generateCalendar();
    updateAnnualLeaveCount();
    
    LeaveTypeData()
});

function LeaveTypeData() {

    const leaveTypeId  = $('#leaveTypeData').val();
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{route('leaves.leavetype')}}",
        type: "POST",
        data: {
            'id': leaveTypeId
        },
        success: function(res) {
          if(res.success == 1){
            $('.main').html(res.view);
          }
        },
        error: function(data) {
            if (typeof data.responseJSON.status !== 'undefined') {
                toastr.error(data.responseJSON.error, 'Error');
            } else {
                $.each(data.responseJSON.errors, function(key, value) {
                    toastr.error(value, 'Error');
                });
            }
            //  console.log('Error:', data);
        }
    });
}

        </script>
    @endsection
