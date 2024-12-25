<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Leave Dates</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}"
    rel="stylesheet" type="text/css" /> 
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}"
    rel="stylesheet" type="text/css" /> 
    <div class="container-fluid">
         
        <form id="formSubmit" onsubmit="formSubmit(this);return false;">
            @csrf
            <input name="file_id" type="hidden" id="fileUidUpload" />
            <div class="row">
                <div class="col-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body px-sm-3 px-0"> --}}
                            <div class="row">
                              <?php 
                                //  echo "<pre>";print_r($data);die;
                                ?>
                                {{-- <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Employee</label>
                                    <input type="text" class="form-control" name="employee_id" value="{{ $employee_data->name }}" readonly>
                                </div> --}}
                                 <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Employee Name</label>
                                <select class="form-select" name="employee_id" readonly> 
                                    <option value="">Select Employee</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"@if($employee_data->id == $user->id ) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Leave Type</label>
                                    <select class="form-select" name="leave_type">
                                        <option value="">-Select-</option>
                                        @foreach ($leave_type as $leavety)
                                            <option value="{{ $leavety->id }}">{{ $leavety->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="mb-3 col-lg-6">
                                    <label class="form-label">Dates</label>
                                    <input type="text" id="range-datepicker" name="dates" class="form-control" placeholder="Please select dates">
                                </div> --}}

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Start Date</label>
                                    <input type="text" value="{{ $startDate }}"   id="basicdatepicker" name="start_date"  class="form-control"
                                        placeholder="Start Date">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">End Date</label>
                                    <input type="text" value="{{ $endDate }}" id="basicdatepickertwo" name="end_date" class="form-control"
                                        placeholder="End Date"  >
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom05" class="form-label">Description</label>
                                    <textarea class="form-control" id="validationCustom06" placeholder="Description" name="description"></textarea>
                                </div>
                                @if(($slot == 'day') || ($slot == 'resourceTimelineTenDay')) 
                                <div class="mb-3 col-lg-6 d-none">
                                  <label for="validationCustom03" class="form-label">Start time</label>
                                  <input type="text"   id="start-time" name="starttime"  class="form-control"
                                      placeholder="Start Date" value="{{ $startTime }}" >
                              </div>
                              <div class="mb-3 col-lg-6 d-none">
                                  <label for="validationCustom04" class="form-label">End time</label>
                                  <input type="text" value="{{ $endTime }}" id="end-time" name="endtime" class="form-control"
                                      placeholder="End Date"  >
                              </div>
                              @endif

                              <div class="mb-3 col-lg-6 d-none">
                                <label for="validationCustom04" class="form-label">Slot</label>
                                <input type="text" value="{{ $slot }}" id="slot" name="slot" class="form-control"
                                    placeholder="slot"  >
                            </div>

                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="validationCustom09" class="form-label">Leave Details</label>
                                    </div>
                                    <div class="row mb-3 show-all-date">
                                        No data selected!
                                    </div>

                                </div>

                                <div class="mb-3 col-lg-12">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Save<i
                                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                            style="display:none;"></i></button>
                                </div>

                            </div>
                        {{-- </div> --}}
                    {{-- </div> --}}

                </div>
            </div>
        </form>
        <input type="hidden" id="start-date" value="{{ $startDate }}">
        <input type="hidden" id="end-date" value="{{ $endDate }}">
        <input type="hidden" id="slot" value="{{ $slot }}">
        {{-- @if(($slot == 'day') || ($slot == 'resourceTimelineTenDay')) 
        <input type="hidden" id="start-time" value="{{ $startTime }}">
        <input type="hidden" id="end-time" value="{{ $endTime }}">
        @endif --}}
    </div>
</div>
{{-- <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div> --}}
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script>

$(document).ready(function(){


  function allDatee(){
    var startDates =  $("#basicdatepicker").val();
    var endDates =  $("#basicdatepickertwo").val();
    startDate(startDates);
    endDate(endDates);

  }

  function startDate(start) {
    $('#start-date').val(start);
     var a = $('#end-date').val(); 
  }

  function endDate(end) {
      $('#end-date').val(end);
      var endDate = end;
      var startDate = $('#start-date').val();
      var startTime = $('#start-time').val();
      var endTime = $('#end-time').val();
      var slot = $('#slot').val();
      var path = "{{ route('admin.fullcalender.dates') }}";
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          type: 'POST',
          url: path, // Adjust the URL as needed
          data: {
              'startDate': startDate,
              'endDate': endDate,
              'startTime': startTime,
              'endTime': endTime,
              'slot': slot
          },
          headers: {
              'X-CSRF-TOKEN': csrfToken 
          },
          success: function(response) {
              if (response.success == 1) {
                  // file.previewElement.remove(); 
                  $('.show-all-date').html(response.view);
              } else {}
          },
        //   error: function(xhr, status, error) {
        //       alert('An error occurred during file removal.');
        //   }
      });
  }

  allDatee();
 
  
  });


  function ChangeLeaveTime(start, id) {
  if(start == 4){
    $('#'+id).removeClass('d-none')
  }else{
    $('#'+id).addClass('d-none')
  } 
  }



  function formSubmit(e) {
      $('#formSubmit').find('.st_loader').show();
      event.preventDefault();
      var formData = new FormData($('#formSubmit')[0]);
      $.ajax({
          type: 'POST',
          url: "{{ route('admin.calendar.store') }}",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              if (response.success == 1) {
                  toastr.success(response.message, 'Success');
                  var surl = "{{route('admin.calendar.getleave')}}";
                  window.setTimeout(function() {
                      window.location.href = surl;
                      $('#formSubmit').find('.st_loader').hide();
                  }, 500);
              }else if(response.success == 0) {
                  toastr.error(response.message, 'Error');
                  $('#formSubmit').find('.st_loader').hide();
             
              } else {
                  toastr.error("Find some error", 'Error');
                  $('#formSubmit').find('.st_loader').hide();
              }
          },
          error: function(xhr, status, error) {
              $('#formSubmit').find('.st_loader').hide();
              var $err = ''
              $.each(xhr.responseJSON.errors, function(key, value) {
                  $err = $err + value + "<br>"
              })
              toastr.error($err, 'Error')
          }
      });
  }


</script>

