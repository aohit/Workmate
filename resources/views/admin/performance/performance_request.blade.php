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
                        <div class="card-body px-sm-3 px-0">
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 35%;">Employee Name</td>
                                            <td>{{ $leaveRequests->employee->name }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Leave Type</td>
                                            <td>{{ $leaveRequests->leaveType->type }}</td>
                                        </tr>  
                                        <tr>
                                            <td style="width: 35%;">Leave Description</td>
                                            <td>{{ $leaveRequests->description }}</td>
                                        </tr>  
                                    </tbody>
                                    
                                </table>
                                <span><center>Leave Details</center></span>
                                <?php $leaveScheduleType = config('constants.leaveScheduleType'); ?>
                                <table class="table table-centered table-borderless table-bordered mb-0">
                                    <tbody> 
                                        @foreach($leaveRequests->leaveSchedules as $schedule)
                                        <tr>
                                            <td style="width: 35%;">Date</td>
                                            <td>{{$schedule->date}}</td>
                                        </tr>
                                         

                                        @foreach($leaveScheduleType as $key => $val)
                                        @if($schedule->type == $key)
                                        <tr>
                                            <td style="width: 35%;">Schedule Type</td>
                                            <td>{{$val}}</td>
                                        </tr>
                                        @endif
                                        @endforeach 

                                        @if($schedule->type == 4)
                                        <tr>
                                            <td style="width: 35%;">Start Time</td>
                                            <td>{{$schedule->start_time}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">End Time</td>
                                            <td>{{$schedule->end_time}}</td>
                                        </tr>
                                        @endif
                                        @endforeach 
                                        <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                                            @csrf
                                        <tr>
                                            <td style="width: 35%;">Leave Approve / Reject</td>
                                            <td> 
                                                <input type="hidden" value="{{$leaveRequests->id}}" name="reqId">
                                                <div class="col-lg-6">
                                                    
                                                    <select class="form-select" id="leave-approve-reject" name="is_leave" onchange="appReject(this)"> 
                                                       
                                                        <option value="1">Approve</option>
                                                        <option value="2">Reject</option> 
                                                    </select>
                                                </div> 
                                            </td> 
                                        </tr>
                                        <tr id="reject-comment" class="d-none">
                                            <td style="width: 35%;">Comment</td>
                                            <td> 
                                                <input type="hidden" value="{{$leaveRequests->id}}" name="reqId">
                                                <div class="col-lg-12"> 
                                                    <textarea class="form-control" id="validationCustom06" placeholder="Comment..."
                                                    name="comment"></textarea>
                                                </div> 
                                            </td> 
                                        </tr>
                                        
                                    </form>
                                    </tbody>
                                    
                                </table>
                                <div class="mt-3 col-lg-12">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Submit<i
                                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                            style="display:none;"></i></button>
                                    
                                </div>
                            </div> <!-- end .table-responsive -->
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

