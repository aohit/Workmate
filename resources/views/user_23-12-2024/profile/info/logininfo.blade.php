
<div class="card">
    <div class="card-header mt-3 border">
     <h3 class="breadcrumb-title">Personal Information</h3>
     </div>
 <div class="card-body">
     <div class="tab-content py-3">
         <div class="tab-pane fade show active" id="common_data" role="tabpanel">
             <div class="row">
              
                 <div class="col-md-3">
                     <strong>Email</strong> <p class="text-primary">{{ $uinfo->email }}</p>
                 </div>
              
                 <div class="col-md-3">
                     <strong>Phone Number </strong> <p class="text-primary">{{ $uinfo->phone_number }}</p>
                 </div>
                 <div class="col-md-3">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Reset Password</button>
                 </div>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="validationCustom01"
                                    placeholder="New Password" name="newpassword" /> 
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom04" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control basic-datepicker"
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Reset<i
                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                    </form>
                  </div>
                </div>
                
             </div>
         </div>
     </div>
 </div>
</div>
<script>
    function formSubmit(e) {
    $('#formSubmit').find('.st_loader').show(); 
    event.preventDefault();
    var formData = new FormData($('#formSubmit')[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('userReset-password') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {  
            console.log(response);
            if(response.success == 1){
                toastr.success(response.message, 'Success');
                $('#formSubmit').find('.st_loader').hide();
                $('#formSubmit').get(0).reset();

            }else{
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