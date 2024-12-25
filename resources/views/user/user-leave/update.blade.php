@extends('user.layouts.app')

@section('content')
<style>
    div#hours {
    margin-top: 29px;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-lg-12">
                            <form action="{{ route('userleave.file.upload') }}" method="post" class="dropzone"
                                id="image-upload" enctype="multipart/form-data">
                                <input name="file_uid" type="hidden" id="fileUid" value="{{rand(100000,999999)}}" />
                                @csrf
                                <div class="fallback d-none">
                                    <input name="file" type="file" multiple />
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        @if(count($upload_files) == 0)
                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted dripicons-cloud-upload"></i>
                                            <h3>Drop files here or click to upload.</h3>
                                        </div>
                                        @endif
                                        <div class="dropzone-previews mt-3" id="file-previews">

                                            @if(count($upload_files) != 0)
                                            @foreach($upload_files as $upload_file)
                                            <div
                                                class="dz-preview dz-file-preview dz-processing dz-success dz-complete remove">

                                                <div class="dz-image"><img data-dz-thumbnail="" /></div>
                                                <div class="dz-details">
                                                    <div class="dz-size">
                                                        <span data-dz-size=""><strong>12.23</strong> KB</span>
                                                    </div>
                                                    <div class="dz-filename"><span
                                                            data-dz-name="">{{$upload_file->file}}</span></div>
                                                </div>
                                                <div class="dz-progress"><span class="dz-upload"
                                                        data-dz-uploadprogress="" style="width: 100%;"></span></div>
                                                <div class="dz-error-message"><span data-dz-errormessage=""></span>
                                                </div>
                                                <div class="dz-success-mark">
                                                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                        <title>Check</title>
                                                        <defs></defs>
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd" sketch:type="MSPage">
                                                            <path
                                                                d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                                                id="Oval-2" stroke-opacity="0.198794158"
                                                                stroke="#747474" fill-opacity="0.816519475"
                                                                fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dz-error-mark">
                                                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                        <title>Error</title>
                                                        <defs></defs>
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd" sketch:type="MSPage">
                                                            <g id="Check-+-Oval-2" sketch:type="MSLayerGroup"
                                                                stroke="#747474" stroke-opacity="0.198794158"
                                                                fill="#FFFFFF" fill-opacity="0.816519475">
                                                                <path
                                                                    d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                                                    id="Oval-2" sketch:type="MSShapeGroup"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <a class="dz-remove" href="javascript:void(0);"
                                                    onclick="removeEditFile(this,{{$upload_file->id}})"
                                                    data-dz-remove="">Remove file</a>
                                            </div>

                                            @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <form id="formSubmit" onsubmit="formSubmit(this);return false;">
        @csrf
        <input name="file_id" type="hidden" id="fileUidUpload" />
        <input name="id" type="hidden" value="{{ $uinfo->id}}" />

        @if(count($upload_files) != 0)
        @foreach($upload_files as $upload_file_id)
        <input type="hidden" name="editfile_id[]" value="{{$upload_file_id->id}}">
        @endforeach
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-2">
                                <label for="validationCustom09" class="form-label">Reporting To Manager :</label>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <p>{{$employee_data->manager->name}}</p>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Employee</label>
                                <input type="text" class="form-control"
                                placeholder="Name" value="{{$employee_data->name}}" disabled>
                                <input type="hidden" name="employee_id" class="form-control" value="{{$employee_data->id}}">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Leave Type</label>
                                <select class="form-select" name="leave_type">
                                    <option value="">-Select-</option>
                                    @foreach($leave_type as $leavety)
                                    <option value="{{ $leavety->id }}" @if($uinfo->leave_type == $leavety->id) selected
                                        @endif>{{ $leavety->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12 align-items-center my-primary mb-3">
                                <div class="row align-items-center my-primary">
                                  <div class="col-md-3">
                                    <label>Age <span class="text-muted">(Leave duration)</span></label>
                                  </div>
                                  <div class="col-md-9">
                                     <div class="app-radio-group">
                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                          <input class="form-check-input" type="radio"  name="leave_timing_type[]" id="inlineRadio1" value="1" @if($uinfo->leaveSchedules[0]->type == 1) checked @endif>
                                          Single day
                                        </label>
                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio5" value="5" @if($uinfo->leaveSchedules[0]->type == 5) checked @endif>
                                          Multi day
                                        </label>
                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio3" value="3" @if($uinfo->leaveSchedules[0]->type == 2 || ($uinfo->leaveSchedules[0]->type == 3)) checked @endif>
                                          Half day
                                        </label>
                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio4" value="4" @if($uinfo->leaveSchedules[0]->type == 4) checked @endif>
                                          Hours
                                        </label>
                                      </div>
                                  </div>
                                </div>
                              </div>


                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom03" class="form-label label-basic-datepicker">Start Date</label>
                                <input type="text" id="basic-datepicker" value="{{ $uinfo->start_date}}"
                                    name="start_date" class="form-control" placeholder="Start Date" onchange="startDate(this.value)">
                            </div>

                            <div class="col-lg-6 mt-4" id="half_day">
                                <div class="app-radio-group">
                                  <label class="customized-radio radio-default custom-radio-default mx-2">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2"  @if($uinfo->leaveSchedules[0]->type == 2) checked @endif>
                                    Half day - Morning
                                  </label>
                                  <label class="customized-radio radio-default custom-radio-default mx-2">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3"  @if($uinfo->leaveSchedules[0]->type == 3) checked @endif>
                                    Half day - Evening
                                  </label>
                                 </div>
                            </div>

                            <div id="hours" class="col-lg-6 ">
                                <div class="row">
                                <div class="col-lg-6">
                                  <select class="form-select" name="start_time[]">
                                    <option value="">Select</option>
                                               <option value="08:00 AM"  @if($uinfo->leaveSchedules[0]->start_time == '08:00 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>08:00 AM</option>
                                                <option value="08:30 AM" @if($uinfo->leaveSchedules[0]->start_time == '08:30 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>08:30 AM</option>
                                                <option value="09:00 AM" @if($uinfo->leaveSchedules[0]->start_time == '09:00 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>09:00 AM</option>
                                                <option value="09:30 AM" @if($uinfo->leaveSchedules[0]->start_time == '09:30 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>09:30 AM</option>
                                                <option value="10:00 AM" @if($uinfo->leaveSchedules[0]->start_time == '10:00 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>10:00 AM</option>
                                                <option value="10:30 AM" @if($uinfo->leaveSchedules[0]->start_time == '10:30 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>10:30 AM</option>
                                                <option value="11:00 AM" @if($uinfo->leaveSchedules[0]->start_time == '11:00 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>11:00 AM</option>
                                                <option value="11:30 AM" @if($uinfo->leaveSchedules[0]->start_time == '11:30 AM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>11:30 AM</option>
                                                <option value="12:00 PM" @if($uinfo->leaveSchedules[0]->start_time == '12:00 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>12:00 PM</option>
                                                <option value="12:30 PM" @if($uinfo->leaveSchedules[0]->start_time == '12:30 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>12:30 PM</option>
                                                <option value="01:00 PM" @if($uinfo->leaveSchedules[0]->start_time == '1:00 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>01:00 PM</option>
                                                <option value="01:30 PM" @if($uinfo->leaveSchedules[0]->start_time == '1:30 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>01:30 PM</option>
                                                <option value="02:00 PM" @if($uinfo->leaveSchedules[0]->start_time == '2:00 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>02:00 PM</option>
                                                <option value="02:30 PM" @if($uinfo->leaveSchedules[0]->start_time == '2:30 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>02:30 PM</option>
                                                <option value="03:00 PM" @if($uinfo->leaveSchedules[0]->start_time == '3:00 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>03:00 PM</option>
                                                <option value="03:30 PM" @if($uinfo->leaveSchedules[0]->start_time == '3:30 PM'  && $uinfo->leaveSchedules[0]->type == '4') selected @endif>03:30 PM</option>
                                            </select> 
                              </div> 
                                 
                                <div class=" col-lg-6"> 
                                    <select class="form-select" name="end_time[]">
                                            <option value="">Select</option>
                                            <option value="08:30 AM" @if($uinfo->leaveSchedules[0]->end_time == '08:30 AM' && $uinfo->type == '4') selected @endif>08:30 AM</option>
                                                <option value="09:00 AM" @if($uinfo->leaveSchedules[0]->end_time == '09:00 AM') selected @endif>09:00 AM</option>
                                                <option value="09:30 AM" @if($uinfo->leaveSchedules[0]->end_time == '09:30 AM') selected @endif>09:30 AM</option>
                                                <option value="10:00 AM" @if($uinfo->leaveSchedules[0]->end_time == '10:00 AM') selected @endif>10:00 AM</option>
                                                <option value="10:30 AM" @if($uinfo->leaveSchedules[0]->end_time == '10:30 AM') selected @endif>10:30 AM</option>
                                                <option value="11:00 AM" @if($uinfo->leaveSchedules[0]->end_time == '11:00 AM') selected @endif>11:00 AM</option>
                                                <option value="11:30 AM" @if($uinfo->leaveSchedules[0]->end_time == '11:30 AM') selected @endif>11:30 AM</option>
                                                <option value="12:00 PM" @if($uinfo->leaveSchedules[0]->end_time == '12:00 PM') selected @endif>12:00 PM</option>
                                                <option value="12:30 PM" @if($uinfo->leaveSchedules[0]->end_time == '12:30 PM') selected @endif>12:30 PM</option>
                                                <option value="01:00 PM" @if($uinfo->leaveSchedules[0]->end_time == '1:00 PM') selected @endif>01:00 PM</option>
                                                <option value="01:30 PM" @if($uinfo->leaveSchedules[0]->end_time == '1:30 PM') selected @endif>01:30 PM</option>
                                                <option value="02:00 PM" @if($uinfo->leaveSchedules[0]->end_time == '2:00 PM') selected @endif>02:00 PM</option>
                                                <option value="02:30 PM" @if($uinfo->leaveSchedules[0]->end_time == '2:30 PM') selected @endif>02:30 PM</option>
                                                <option value="03:00 PM" @if($uinfo->leaveSchedules[0]->end_time == '3:00 PM') selected @endif>03:00 PM</option>
                                                <option value="03:30 PM" @if($uinfo->leaveSchedules[0]->end_time == '3:30 PM') selected @endif>03:30 PM</option>
                                                <option value="04:00 PM"  @if($uinfo->leaveSchedules[0]->end_time == '04:00 PM'  && $uinfo->type == '4') selected @endif>04:00 PM</option>
                                            </select>
                                </div> 
                                </div> 
                            </div>

                            <div class="mb-3 col-lg-6 ">
                                <label for="validationCustom04" class="form-label label-basic-datepicker-two">End Date</label>
                                <input type="text" id="basic-datepicker-two" value="{{ $uinfo->end_date}}"
                                    name="end_date" class="form-control" placeholder="End Date" onchange="endDate(this.value)">
                            </div>
                            
                            <div class="row leave_details">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom09" class="form-label">Leave Details</label>
                                </div>
                            <div class="row mb-3 show-all-date">
                                @foreach ($uinfo->leaveSchedules as $key => $value)
                                
                                @if($value->type == 5)
                                <input type="hidden" value="{{$value->date}}" name="dates[]">
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">{{$value->date}}</label>
                                </div> 

                                @if(date("D", strtotime($value->date)) == 'Mon' || date("D", strtotime($value->date)) == 'Tue'|| date("D", strtotime($value->date))
                                == 'Wed'|| date("D", strtotime($value->date)) == 'Thu'|| date("D", strtotime($value->date)) == 'Fri')

                                <div class="mb-3 col-lg-6">
                                    <span class=" btn btn-dark badge badge-dark"  onchange="ChangeLeaveTime(this.value, '{{date('DM', strtotime($value->date))}}')">Full Day</span>
                                    {{-- <select class="form-select" name=""
                                        onchange="ChangeLeaveTime(this.value,`{{date('DM', strtotime($value->date))}}`)">
                                        <option value="" @if($value->type == 5) selected @endif>Full Day</option>
                                    </select> --}}
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
 
                            </div>

                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom05" class="form-label">Description</label>
                                <textarea class="form-control" id="validationCustom01" placeholder="Description"
                                    name="description"></textarea>
                            </div>


                            <div class="mb-3 col-lg-12">
                                <a href="{{ route('userleave') }}" class="btn btn-light">Close</a>
                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                                <button class="btn btn-primary" type="submit">Update<i
                                        class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                        style="display:none;"></i></button>
                            </div>
                        </div>

                      
                    </div>
                </div>

            </div>
        </div> <!-- end row -->

    </form>
    <input type="hidden" id="start-date" value="{{ $uinfo->start_date}}">
    <input type="hidden" id="end-date"  value="{{ $uinfo->end_date}}">
    <input type="hidden" id="type"  value="{{ $uinfo->leaveSchedules[0]->type }}">
</div>
@endsection
@section('page-js-script')
<script>
  
  $(document).ready(function () {
    const toggleVisibility = (selectedOption) => {
        $('#basic-datepicker, .label-basic-datepicker, #basic-datepicker-two, .label-basic-datepicker-two, #hours, #half_day, .leave_details, .show-all-date').hide();
        switch (selectedOption) {
            case '1':
                $('#basic-datepicker, .label-basic-datepicker').show();
                // alert(1);
                break;
            case '5':
                $('#basic-datepicker, .label-basic-datepicker, #basic-datepicker-two, .label-basic-datepicker-two, .leave_details, .show-all-date').show();
                // alert(5);
                break;
            case '3':
                $('#basic-datepicker, .label-basic-datepicker, #half_day').show();
                // alert(3);
                break;
            case '4':
                $('#basic-datepicker, .label-basic-datepicker, #hours').show();
                // alert(4);
                break;
        }

       const hiddenType = $('#type').val();
       if(hiddenType == 5){
            $('#basic-datepicker-two').val();
        }else{
            $('#basic-datepicker-two').val('');
        }

        $('#basic-datepicker').on('change', function () {
        var selectedDate = new Date($(this).val()); 
        var currentDate = new Date(); 

        currentDate.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate < currentDate) {
            alert('Start Date should be today or in the future.');
            $(this).val('');
        }
});

    $('#basic-datepicker-two').on('change', function () {
        var startDate = new Date($('#basic-datepicker').val()); 
        var endDate = new Date($(this).val()); 

        startDate.setHours(0, 0, 0, 0);
        endDate.setHours(0, 0, 0, 0);

        if (endDate <= startDate) {
            alert('End Date should be after the Start Date.');
            $(this).val(''); 
        }
    });

    };

    let selectedOption = $('input[name="leave_timing_type[]"]:checked').val();
    toggleVisibility(selectedOption);

    $('input[name="leave_timing_type[]"]').change(function () {
        selectedOption = $(this).val();
        toggleVisibility(selectedOption);
    });
});

    flatpickr(".flatpickr-input", {
        disable: [
            function (date) {
                return date.getDay() === 0 || date.getDay() === 6;
            }
        ],
        dateFormat: "Y-m-d",
    });


    
function ChangeLeaveTime(start, id) {
  if(start == 4){
    $('#'+id).removeClass('d-none')
  }else{
    $('#'+id).addClass('d-none')
  } 
  }

  function startDate(start) {
        
        $('#start-date').val(start);
       var a = $('#end-date').val(); 
       if(a != 1){
        endDate(a);
       } 
    }

    function endDate(end) {
        $('#end-date').val(end);
        var endDate = end;
        var startDate = $('#start-date').val();
        var path = "{{ route('userleave.dates') }}";
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: path, // Adjust the URL as needed
            data: {
                'startDate': startDate,
                'endDate': endDate
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {
                if (response.success == 1) {
                    // file.previewElement.remove(); 
                    $('.show-all-date').html(response.view);
                } else {}
            },
            error: function(xhr, status, error) {
                alert('An error occurred during file removal.');
            }
        });
    }

    
    function formSubmit(e) {
        $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        // console.log(formData)
        $.ajax({
            type: 'POST',
            url: "{{ route('userleave.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) {
                    toastr.success(response.message, 'Success');
                    var surl = "{{route('userleave')}}";
                    window.setTimeout(function() {
                        $('#formSubmit').find('.st_loader').hide();
                        window.location.href = surl;
                    }, 500);
                }else if(response.success == 0) {
                    toastr.error(response.message, 'Error');
                    $('#formSubmit').find('.st_loader').hide();
                 
                } else {
                    $('#formSubmit').find('.st_loader').hide();
                    toastr.error("Find some error", 'Error');
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
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 1,
        acceptedFiles: null,
        init: function() {
            this.on("success", function(file, response) {
                var fileUid = $("#fileUid").val();
                $("#fileUidUpload").val(fileUid);
            });
            this.on("addedfile", function(file) {
                var fileId = generateFileId();
                $(file.previewElement).data("file-id", fileId);
                toastr.success("File uploaded successfully", 'Success');
            });
            this.on("removedfile", function(file) {
                // console.log('new')
                var responseObject = JSON.parse(file.xhr.response);
                var fileId = responseObject.file_id;
                removeFile(fileId);
            });
        }
    };
    Dropzone.options.imageUpload.addRemoveLinks = true;

    function generateFileId() {
        return Date.now().toString();
    }

    function removeFile(fileId) {
        if (confirm('Are you sure you want to remove this file?')) {
            var path = "{{ route('userleave.file.remove') }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: path, // Adjust the URL as needed
                data: {
                    'fileId': fileId
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("File removed successfully", 'Success');
                    } else {
                        toastr.success("File removal failed", 'Success');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred during file removal.');
                }
            });
        }
    }

    function removeEditFile(e, fileId) {
        if (confirm('Are you sure you want to remove this file?')) {
            $(e).parent().remove();
            var path = "{{ route('userleave.file.remove') }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: path, // Adjust the URL as needed
                data: {
                    'fileId': fileId
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success("File removed successfully", 'Success');
                    } else {
                        toastr.success("File removal failed", 'Success');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred during file removal.');
                }
            });
        }
    }
</script>

@endsection