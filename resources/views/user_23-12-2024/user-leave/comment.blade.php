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
                                <table class="table table-centered table-borderless table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{ $leaveRequests->comment }}</td>
                                        </tr>  
                                    </tbody>
                                    
                                </table>
                                
                                 
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

