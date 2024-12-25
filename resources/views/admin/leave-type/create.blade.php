<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body"> --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Leave title" name="name" /> 
                                </div> 
                                <div class="col-md-6 my-4">
                                    <div class="d-flex flex-wrap justify-content-sm-start  justify-content-between align-item-center">
                                       <label class="form-label ">Color<sup class="text-danger">*</sup></label>
                                       <input type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" class="mx-2"> 
                                       <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" name="color_theme_one"  id="hexcolor">
                                    </div>
                                 </div>
                               
                            </div> 
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Leave Days(Allowance)</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Leave days" name="leave_day" /> 
                                </div> 

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status"> 
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Leave Accurals</label>
                                    <select class="form-select" name="leave_accurals"> 
                                        <option value="1">Active</option>
                                        <option value="0">Deactivated</option> 
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Carry Over Days</label>
                                    <input type="number" class="form-control" id="validationCustom01"
                                        placeholder="" name="carry_over_days" /> 
                                </div> 
                            </div> 

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label" >Expires After</label>
                                    <select class="form-select" id="type" name="type"  onchange="selected()"> 
                                        <option value="0" >Never</option> 
                                        <option value="1" data-title="{{ 'days' }}">Days</option>
                                        <option value="2" data-title="{{ 'month' }}">Month</option>
                                    </select>
                                </div> 

                                <div class="mb-3 col-lg-6 d-none" id="ratingScales">
                                    <label for="validationCustom01" class="form-label">Expire Number</label>
                                    <input type="text" class="form-control" id="type" name="days_or_month"
                                    placeholder="" /> 
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label" >Allow Exceed</label>
                                    <select class="form-select" name="allow_exceed"> 
                                        <option value="0" >Select</option> 
                                        <option value="1" data-title="">Yes</option>
                                        <option value="0" data-title="">No</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save<i
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>
<script>
    
    $('#colorpicker').on('input', function() {
       $('#hexcolor').val(this.value);
     });
     $('#hexcolor').on('input', function() {
       $('#colorpicker').val(this.value);
     });

     function selected() { 
        var selectedTitle = $('#type option:selected').attr('data-title');
         if(selectedTitle == 'days'|| selectedTitle  == 'month'){
            $('#ratingScales').removeClass('d-none');
            $('#placeholder').addClass('d-none');
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#select').addClass('d-none');
        }else{
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#select').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }

    }
 </script>