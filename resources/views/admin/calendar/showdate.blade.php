
@foreach ($period as $key => $value) 
<?php  $key = array_search($value->format('Y-m-d'), array_column($holiday, 'date')); ?>
  
  <input type="hidden" value="{{$value->format('Y-m-d')}}" name="dates[]" >
  <div class="mb-3 col-lg-6">
    <label class="date">{{$value->format('D M d Y')}}</label>
  </div>  
  @if(!empty($key) || $key == 0 && $key != '')
      <div class="mb-3 col-lg-6"> 
        <label class="public_holiday">Public holiday</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>  
  @else
      @if($value->format('D') == 'Sat')
      <div class="mb-3 col-lg-6"> 
        <label class="non_working">Non working day</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>   
      @endif

  
      @if($value->format('D') == 'Sun')
      <div class="mb-3 col-lg-6">
        <label class="non_working">Non working day</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>
      @endif
    
      @if($value->format('D') == 'Mon' || $value->format('D') == 'Tue'|| $value->format('D') == 'Wed'|| $value->format('D') == 'Thu'|| $value->format('D') == 'Fri')
               
      
      <div class="mb-3 col-lg-6">
        <div class="leave-details">
            <div class="leave-item">
              
              {{-- <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="1"  @if($leaveType == 1) selected @endif>
              <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="2" @if($leaveType == 2) selected @endif>
              <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="3" @if($leaveType == 3) selected @endif>
              <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="4"  @if($leaveType == 4) selected @endif>
              <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="5" @if($leaveType == 5) selected @endi> --}}

                <select class="form-select leave_timing_type" name="leave_timing_type[]" id="leave_timing_type_1">
                    <option value="1" @if($leaveType == 1) selected @else  disabled @endif >Single day</option>
                    <option value="2" @if($leaveType == 2) selected @else  disabled @endif >Half day - Morning</option>
                    <option value="3" @if($leaveType == 3) selected @else  disabled @endif >Half day - Evening</option>
                    <option value="4" @if($leaveType == 4) selected @else  disabled @endif >Hours</option>
                    <option value="5" @if($leaveType == 5) selected @else  disabled @endif >Multiple Days</option>
                </select>
                <div id="time_selection_1" class="time_selection d-none row">
                    <div class="mt-2 col-lg-12">
                        <select class="form-select" name="start_time[]" id="start_time_1">
                        <option value="">Select</option>
                        <option value="08:00 AM"  @if($start_time == '08:00 AM') selected @endif>08:00 AM</option>
                         <option value="08:30 AM" @if($start_time == '08:30 AM'  && $leaveType == '4') selected @endif>08:30 AM</option>
                         <option value="09:00 AM" @if($start_time == '09:00 AM'  && $leaveType == '4') selected @endif>09:00 AM</option>
                         <option value="09:30 AM" @if($start_time == '09:30 AM'  && $leaveType == '4') selected @endif>09:30 AM</option>
                         <option value="10:00 AM" @if($start_time == '10:00 AM'  && $leaveType == '4') selected @endif>10:00 AM</option>
                         <option value="10:30 AM" @if($start_time == '10:30 AM'  && $leaveType == '4') selected @endif>10:30 AM</option>
                         <option value="11:00 AM" @if($start_time == '11:00 AM'  && $leaveType == '4') selected @endif>11:00 AM</option>
                         <option value="11:30 AM" @if($start_time == '11:30 AM'  && $leaveType == '4') selected @endif>11:30 AM</option>
                         <option value="12:00 PM" @if($start_time == '12:00 PM'  && $leaveType == '4') selected @endif>12:00 PM</option>
                         <option value="12:30 PM" @if($start_time == '12:30 PM'  && $leaveType == '4') selected @endif>12:30 PM</option>
                         <option value="01:00 PM" @if($start_time == '01:00 PM'  && $leaveType == '4') selected @endif>01:00 PM</option>
                         <option value="01:30 PM" @if($start_time == '01:30 PM'  && $leaveType == '4') selected @endif>01:30 PM</option>
                         <option value="02:00 PM" @if($start_time == '02:00 PM'  && $leaveType == '4') selected @endif>02:00 PM</option>
                         <option value="02:30 PM" @if($start_time == '02:30 PM'  && $leaveType == '4') selected @endif>02:30 PM</option>
                         <option value="03:00 PM" @if($start_time == '03:00 PM'  && $leaveType == '4') selected @endif>03:00 PM</option>
                         <option value="03:30 PM" @if($start_time == '03:30 PM'  && $leaveType == '4') selected @endif>03:30 PM</option>
                     </select> 
                    </div>

                    <div class="mt-2 col-lg-12">
                        <select class="form-select" name="end_time[]" id="end_time_1" >
                          <option value="">Select</option>
                          <option value="08:30 AM" @if($end_time == '08:30 AM' && $leaveType == '4') selected @endif>08:30 AM</option>
                              <option value="09:00 AM" @if($end_time == '09:00 AM'  && $leaveType == '4') selected @endif>09:00 AM</option>
                              <option value="09:30 AM" @if($end_time == '09:30 AM'  && $leaveType == '4') selected @endif>09:30 AM</option>
                              <option value="10:00 AM" @if($end_time == '10:00 AM'  && $leaveType == '4') selected @endif>10:00 AM</option>
                              <option value="10:30 AM" @if($end_time == '10:30 AM'  && $leaveType == '4') selected @endif>10:30 AM</option>
                              <option value="11:00 AM" @if($end_time == '11:00 AM'  && $leaveType == '4') selected @endif>11:00 AM</option>
                              <option value="11:30 AM" @if($end_time == '11:30 AM'  && $leaveType == '4') selected @endif>11:30 AM</option>
                              <option value="12:00 PM" @if($end_time == '12:00 PM'  && $leaveType == '4') selected @endif>12:00 PM</option>
                              <option value="12:30 PM" @if($end_time == '12:30 PM'  && $leaveType == '4') selected @endif>12:30 PM</option>
                              <option value="01:00 PM" @if($end_time == '01:00 PM'  && $leaveType == '4') selected @endif>01:00 PM</option>
                              <option value="01:30 PM" @if($end_time == '01:30 PM'  && $leaveType == '4') selected @endif>01:30 PM</option>
                              <option value="02:00 PM" @if($end_time == '02:00 PM'  && $leaveType == '4') selected @endif>02:00 PM</option>
                              <option value="02:30 PM" @if($end_time == '02:30 PM'  && $leaveType == '4') selected @endif>02:30 PM</option>
                              <option value="03:00 PM" @if($end_time == '03:00 PM'  && $leaveType == '4') selected @endif>03:00 PM</option>
                              <option value="03:30 PM" @if($end_time == '03:30 PM'  && $leaveType == '4') selected @endif>03:30 PM</option>
                              <option value="04:00 PM"  @if($end_time == '04:00 PM'  && $leaveType == '4') selected @endif>04:00 PM</option>
                          </select>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="time-selector"></div>
    </div>
    

    @endif 
  @endif
  @endforeach 

  <script>
function toggleTimeSelectionOnModalOpen() {
    const leaveTypeDropdown = document.getElementById('leave_timing_type_1');
    const timeSelection = document.getElementById('time_selection_1');
    
    if (leaveTypeDropdown.value === '4') {
        timeSelection.classList.remove('d-none');
    } else {
        timeSelection.classList.add('d-none');
    }
}



     $(document).ready(function() { 
       
       function toggleTimeSelection() {
         $('.leave_timing_type').each(function() {
            const leaveTimingType = $(this);
            const timeSelection = leaveTimingType.closest('.leave-item').find('.time_selection');
              //  alert();
            leaveTimingType.on('change', function() {
                if ($(this).val() === '4') {
                    timeSelection.removeClass('d-none');
                } else {
                    timeSelection.addClass('d-none');
                }
            });
        });
    }

    $('.leave_timing_type').on('drag', function() {
        const draggedTime = getDraggedTime();
        // updateLeaveTiming(draggedTime);
    });
    
    toggleTimeSelection();
    // updateLeaveTiming();
    toggleTimeSelectionOnModalOpen();
  });
  </script>