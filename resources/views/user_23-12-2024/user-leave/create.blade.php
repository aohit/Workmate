@extends('user.layouts.app')

@section('content')
<style>
    div#hours {
    margin-top: 29px;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<div class="container-fluid">

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
                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted dripicons-cloud-upload"></i>
                                            <h3>Drop files here or click to upload.</h3>
                                        </div>
                                        <div class="dropzone-previews mt-3" id="file-previews"></div>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-2">
                                <label for="validationCustom09" class="form-label">Reporting To Manager:</label>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <p>{{$employee_data->manager->name}}</p>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- <div class="mb-3 col-lg-6">
                                                <label for="validationCustom01" class="form-label">Employee</label>
                                                <select class="form-select" name="employee_id">
                                                    <option value="">-Select-</option>
                                                    @foreach($employee_data as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
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
                                                    <option value="{{ $leavety->id }}">{{ $leavety->type }}</option>
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
                                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio1" value="1">
                                                          Single day
                                                        </label>
                                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio2" value="5">
                                                          Multi day
                                                        </label>
                                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio3" value="3">
                                                          Half day
                                                        </label>
                                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                                          <input class="form-check-input" type="radio" name="leave_timing_type[]" id="inlineRadio4" value="4">
                                                          Hours
                                                        </label>
                                                      </div>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              
                                            <div class="mb-3 col-lg-6">
                                                <label for="validationCustom03" class="form-label label-basic-datepicker">Start Date</label>
                                                <input type="text" id="basic-datepicker" name="start_date" class="form-control"
                                                       placeholder="Start Date" onchange="startDate(this.value)">
                                            </div>
                                           
                
                                             <div class="col-lg-6 mt-4" id="half_day">
                                                      <div class="app-radio-group">
                                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2">
                                                          Half day - Morning
                                                        </label>
                                                        <label class="customized-radio radio-default custom-radio-default mx-2">
                                                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                                          Half day - Evening
                                                        </label>
                                                       </div>
                                                  </div>
                                             
                                           
                                            <div id="hours" class="col-lg-6">
                                                <div class="row">
                                                <div class="col-lg-6">
                                                <select class="form-select" name="start_time[]">
                                                  <option value="">Select</option>
                                                  <option value="08:00 AM">08:00 AM</option>
                                                  <option value="08:30 AM">08:30 AM</option>
                                                  <option value="09:00 AM">09:00 AM</option>
                                                  <option value="09:30 AM">09:30 AM</option>
                                                  <option value="10:00 AM">10:00 AM</option>
                                                  <option value="10:30 AM">10:30 AM</option>
                                                  <option value="11:00 AM">11:00 AM</option>
                                                  <option value="11:30 AM">11:30 AM</option>
                                                  <option value="12:00 PM">12:00 PM</option>
                                                  <option value="12:30 PM">12:30 PM</option>
                                                  <option value="01:00 PM">01:00 PM</option>
                                                  <option value="01:30 PM">01:30 PM</option>
                                                  <option value="02:00 PM">02:00 PM</option>
                                                  <option value="02:30 PM">02:30 PM</option>
                                                  <option value="03:00 PM">03:00 PM</option>
                                                  <option value="03:30 PM">03:30 PM</option>
                                                </select> 
                                              </div> 
                                                 
                                                <div class=" col-lg-6"> 
                                                  <select class="form-select" name="end_time[]">
                                                    <option value="">Select</option>
                                                    <option value="08:30 AM">08:30 AM</option>
                                                    <option value="09:00 AM">09:00 AM</option>
                                                    <option value="09:30 AM">09:30 AM</option>
                                                    <option value="10:00 AM">10:00 AM</option>
                                                    <option value="10:30 AM">10:30 AM</option>
                                                    <option value="11:00 AM">11:00 AM</option>
                                                    <option value="11:30 AM">11:30 AM</option>
                                                    <option value="12:00 AM">12:00 PM</option>
                                                    <option value="12:30 PM">12:30 PM</option>
                                                    <option value="01:00 PM">01:00 PM</option>
                                                    <option value="01:30 PM">01:30 PM</option>
                                                    <option value="02:00 PM">02:00 PM</option>
                                                    <option value="02:30 PM">02:30 PM</option>
                                                    <option value="03:00 PM">03:00 PM</option>
                                                    <option value="03:30 PM">03:30 PM</option>
                                                    <option value="04:00 PM">04:00 PM</option>
                                                  </select> 
                                                </div> 
                                                </div> 
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="validationCustom04" class="form-label label-basic-datepicker-two">End Date</label>
                                                <input type="text" id="basic-datepicker-two" name="end_date" class="form-control"
                                                       placeholder="End Date" onchange="endDate(this.value)">
                                            </div>
                
                                            
                
                                            <div class="row leave_details">
                                                <div class="mb-3 col-lg-6">
                                                    <label for="validationCustom09" class="form-label">Leave Details</label>
                                                </div>
                                                <div class="row mb-3 show-all-date">
                                                    No data selected!
                                                </div>
                                            </div>
                
                                            <div class="mb-3 col-lg-12">
                                                <label for="validationCustom05" class="form-label">Description</label>
                                                <textarea class="form-control" id="validationCustom06" placeholder="Description"
                                                    name="description"></textarea>
                                            </div>
                                            
                                            <div class="mb-3 col-lg-12">
                                                    <a href="{{ route('admin.leave') }}" class="btn btn-light">Close</a>
                                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                                                <button class="btn btn-primary" type="submit">Save<i
                                                        class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                                        style="display:none;"></i></button>
                                            </div>
                
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                   
                    </div>
                </div>

            </div>
        </div>
    </form>
    <input type="hidden" id="start-date" value="1">
    <input type="hidden" id="end-date" value="1">
</div>
@endsection

@section('page-js-script')

<script>
    $(document).ready(function() {
    $('#basic-datepicker').hide();
    $('.label-basic-datepicker').hide();
    $('#basic-datepicker-two').hide(); 
    $('.label-basic-datepicker-two').hide(); 

    $('#hours').hide(); 
    $('#half_day').hide(); 
    $('.leave_details').hide();
    
    $('input[name="leave_timing_type[]"]').change(function() {
        var selectedOption = $('input[name="leave_timing_type[]"]:checked').val();
        
        $('#basic-datepicker').hide();
        $('.label-basic-datepicker').hide();
        $('#basic-datepicker-two').hide();
        $('.label-basic-datepicker-two').hide(); 
        $('#hours').hide();
        $('#half_day').hide(); 
        
        
        if (selectedOption == '1') {
            $('#basic-datepicker').show();
            $('.label-basic-datepicker').show();
            $('.leave_details').hide();
        } else if (selectedOption == '2') {
            $('#basic-datepicker').show();
            $('.label-basic-datepicker').show();
            $('#basic-datepicker-two').show();
            $('.label-basic-datepicker-two').show(); 
            $('.leave_details').show();
        } else if (selectedOption == '3') {
            $('#basic-datepicker').show();
            $('.label-basic-datepicker').show();
            $('#half_day').show(); 
            $('.leave_details').hide();
        } else if (selectedOption == '4') {
            $('#basic-datepicker').show();
            $('.label-basic-datepicker').show();
            $('#hours').show();
            $('.leave_details').hide();
        }else if(selectedOption  == 5){
            $('#basic-datepicker').show();
            $('.label-basic-datepicker').show();
            $('#basic-datepicker-two').show();
            $('.label-basic-datepicker-two').show(); 
            $('.leave_details').show();
        }
    });

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
    });

    flatpickr(".flatpickr-input", {
        disable: [
            function (date) {
                return date.getDay() === 0 || date.getDay() === 6;
            }
        ],
        dateFormat: "Y-m-d",
    });
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
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'POST',
            url: path, // Adjust the URL as needed
            data: {
                'startDate': startDate,
                'endDate': endDate
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
                        window.location.href = surl;
                        $('#formSubmit').find('.st_loader').hide();
                    }, 500);
                }else if(response.success == 0) {
                    toastr.error(response.message, 'Error');
                    $('#formSubmit').find('.st_loader').hide();
                }else if(response.success == 3) {
                    toastr.warning(response.message, 'Error');
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
                toastr.success("File uploaded successfully", 'Success');
                var fileId = generateFileId();
                $(file.previewElement).data("file-id", fileId);
            });
            this.on("removedfile", function(file) {
                if (confirm('Are you sure you want to remove this file?')) {
                    var responseObject = JSON.parse(file.xhr.response);
                    var fileId = responseObject.file_id;
                    removeFile(fileId);
                }
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
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'POST',
                url: path, // Adjust the URL as needed
                data: {
                    'fileId': fileId
                }, 
                success: function(response) {
                    if (response.success) {
                        file.previewElement.remove();
                        toastr.success("File removed successfully", 'Success');
                    } else {
                        toastr.success("File removal failed", 'Success');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred during file removal.');
                }
            });
        } else {
            // console.log('not rem/ove')
        }
    }
</script>

@endsection