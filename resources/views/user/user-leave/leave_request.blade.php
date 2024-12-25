<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-flex align-items-top">
                                    @php 
                                        if(isset($leaveRequests->employee->Image->file) && $leaveRequests->employee->Image->file != ''){
                                            $image_url = url('/upload/employee/' . $leaveRequests->employee->Image->file);
                                        }else{
                                            $image_url = url('assets/images/users/user-1.jpg');
                                        }    
                                    @endphp
                                    <img src="{{ $image_url }}" class="img-thumbnail rounded-circle" style="height: 70px; width: 70px;" style="border-radius: 50%;">

                                    {{-- <img src="assets/images/users/profile.jpg"
                                            class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start me-3" alt="profile-image"> --}}
                                    <div class="flex-grow-1 overflow-hidden mx-1 p-1">
                                        <h4 class="m-0">{{ $leaveRequests->employee->name }}</h4>
                                        <p class="text-muted m-0"><i>{{ ucfirst($leaveRequests->employee->job_title) }}</i></p>
                                        <p class="font-13">{{ $leaveRequests->comment  }}</p>
                                    </div>

                                    <ul class="list-inline">
                                        @foreach($leaveHistories as $leavehistory )
                                        <li class="list-inline-item me-4">
                                            <h4 class="mb-0">{{ round(@$leavehistory->leaveHistory->remaining) .' Days' }}</h4>
                                            <p class="text-muted">Remaining</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h4 class="mb-0">{{ @$leavehistory->leaveHistory->advance_leave  .' Days' }}</h4>
                                            <p class="text-muted">Advance</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                               
                                    <?php $leaveScheduleType = config('constants.leaveScheduleType'); ?>
                                    <div class="card-body taskboard-box p-2">
                                        <h4 class="header-title  my-2" style="color:{{ $leaveRequests->leaveType->color_code }};">{{ $leaveRequests->leaveType->type }}</h4>
                                        <div class="row">
                                                @foreach($leaveRequests->leaveSchedules as $schedule)
                                                <div class="col-lg-6">
                                                <div class="card mb-3 p-0">
                                                    <div class="card-body m-0 p-0">
                                                        <div class=" align-items-center border p-2 rounded">
                                                            <i class="mdi mdi-calendar-blank-outline"></i>
                                                            <span class="fw-bold text-dark">{{ $schedule->date }}</span>
                                                            
                                                            @foreach($leaveScheduleType as $key => $val)
                                                                @if($schedule->type == $key)
                                                                 <span class="badge bg-danger float-end">{{ $val }}</span>
                                                                @endif
                                                            @endforeach
                                            
                                                            @if($schedule->type == 4)
                                                            <div>

                                                                <span class="fw-bold text-dark m-0 p-0">
                                                                    {{-- <i class="mdi mdi-calendar-month"></i> --}}
                                                                    <i class="mdi mdi-clock-outline"></i>
                                                                     {{ $schedule->start_time }} : {{ $schedule->end_time }}</span>
                                                                {{-- <span class="fw-bold text-dark m-0 p-0"> </span> --}}
                                                            </div>
                                                            @endif
                                                        </div>
                                            
                                                 </div>
                                                 </div>
                                                </div>
                                                @endforeach
                                            <form id="formSubmit" onsubmit="formSubmit(this); return false;">
                                                @csrf
                                                <div class="mt-3">
                                                    <label for="leave-approve-reject" class="form-label">Leave Approve / Reject</label>
                                                    <input type="hidden" value="{{ $leaveRequests->id }}" name="reqId">
                                                    <select class="form-select" id="leave-approve-reject" name="is_leave" onchange="appReject(this)">
                                                        <option value="1">Approve</option>
                                                        <option value="2">Reject</option>
                                                    </select>
                                                </div>
                                
                                                <div id="reject-comment" class="mt-3 d-none">
                                                    <label for="validationCustom06" class="form-label">Comment</label>
                                                    <input type="hidden" value="{{ $leaveRequests->id }}" name="reqId">
                                                    <textarea class="form-control" id="validationCustom06" placeholder="Comment..." name="comment"></textarea>
                                                </div>
                                            </form>
                                       </div>
                                       
                                       {{-- <span><center>Leave Details</center></span> --}}
                                       <?php $leaveScheduleType = config('constants.leaveScheduleType'); ?>
                                       <table class="table table-centered table-borderless table-bordered mb-0">
                                           
                                           
                                    </table>
                                    <div class="mt-3 col-lg-12">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">Submit<i
                                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                            style="display:none;"></i></button>
                                            
                                        </div>
                                    </div>
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
 
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
</form>
 
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>

<script>


 function appReject(e) {
   var appRej =  $(e).val();
    $("#reject-comment").addClass('d-none');
    if(appRej == 2){
        $("#reject-comment").removeClass('d-none');
    }
 } 


 function formSubmit(e) {

    
         var approveOrReject = $('#leave-approve-reject').val();
         if(approveOrReject){
            if(approveOrReject == 1){
                $confirm = confirm("Are you sure you want to approve?");
            }else{
                $confirm = confirm("Are you sure you want to reject?");
            } 
            if ($confirm){
                $('#formSubmit').find('.st_loader').show();
                    event.preventDefault();
                    var formData = new FormData($('#formSubmit')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('userleave.request.update') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success == 1) { 
                                toastr.success(response.message, 'Success'); 
                                window.setTimeout(function() {
                                    window.location.reload();
                                    $('#formSubmit').find('.st_loader').hide();
                                    $("#bs-example-modal-lg").modal("hide");
                                }, 1000);

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
         } 
         } 
       
 
</script>


