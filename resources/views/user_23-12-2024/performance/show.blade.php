<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    <input type="hidden" name="status" value="1">
    <input type="hidden" name="performance_id" value="{{$performance->id}}">
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
                                            <td style="width: 35%;">Start Date</td>
                                            <td>{{$performance->start_date}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">End Date</td>
                                            <td>{{$performance->end_date}}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="mt-3 col-lg-12">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    @if($performance->status == 0)
                                    <button class="btn btn-primary" type="submit">Done<i
                                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                            style="display:none;"></i></button> 
                                            @endif
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
   function formSubmit(e) { 

       
        $confirm = confirm("Are you sure you want to accept?"); 
        if ($confirm){
            $('#formSubmit').find('.st_loader').show();
                event.preventDefault();
                var formData = new FormData($('#formSubmit')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('performance.employee.review.update') }}",
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
      
</script>