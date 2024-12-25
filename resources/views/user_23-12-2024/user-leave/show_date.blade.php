@foreach ($period as $key => $value) 

<?php  $key = array_search($value->format('Y-m-d'), array_column($holiday, 'date')); ?>
  
  <input type="hidden" value="{{$value->format('Y-m-d')}}" name="dates[]" >
  <div class="mb-3 col-lg-6">
    <label class="form-label">{{$value->format('D M d Y')}}</label>
  </div>  
  @if(!empty($key) || $key == 0 && $key != '')
      <div class="mb-3 col-lg-6"> 
        <label class="form-label">Public holiday</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>  
  @else
      @if($value->format('D') == 'Sat')
      <div class="mb-3 col-lg-6"> 
        <label class="form-label">Non working day</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>   
      @endif

  
      @if($value->format('D') == 'Sun')
      <div class="mb-3 col-lg-6">
        <label class="form-label">Non working day</label>
        <input type="hidden" value="" name="leave_timing_type[]">
        <input type="hidden" value="" name="start_time[]">
        <input type="hidden" value="" name="end_time[]"> 
      </div>
      @endif
    
      @if($value->format('D') == 'Mon' || $value->format('D') == 'Tue'|| $value->format('D') == 'Wed'|| $value->format('D') == 'Thu'|| $value->format('D') == 'Fri')

      <div class="mb-3 col-lg-6">
        {{-- <select class="form-select disable" name="" onchange="ChangeLeaveTime(this.value, '{{$value->format('DM')}}')">
          <option>Full Day</option>
        </select> --}}
        <span class=" btn btn-dark badge badge-dark" onchange="ChangeLeaveTime(this.value, '{{$value->format('DM')}}')">Full Day</span>

      </div>  

    @endif 
  @endif
 
  
     
    
@endforeach 
   
 <script>
function ChangeLeaveTime(start, id) {
  if(start == 4){
    $('#'+id).removeClass('d-none')
  }else{
    $('#'+id).addClass('d-none')
  } 
  }
  
</script>