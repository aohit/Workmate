<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $uinfo->id }}">
<div class=" modal-body">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="card"> --}}
                    {{-- <div class="card-body"> --}}
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Leave title"
                                    name="name" value="{{ $uinfo->type }}" /> 
                            </div>
                            <div class="col-md-6 my-4">
                                <div class="d-flex align-item-center ">
                                   <label class="form-label ">Color<sup class="text-danger">*</sup></label>
                                   <input type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{$uinfo->color_code}}" class="mx-2"> 
                                   <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" name="color" value="{{$uinfo->color_code}}" id="hexcolor">
                                </div>
                             </div>
                             
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Leave Days</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Leave days" name="leave_day" value="{{ $uinfo->leave_days }}"/> 
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Status</label>
                                <select class="form-select" name="status"> 
                                    <option value="1" @if($uinfo->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($uinfo->status == 0) selected @endif>In-Active</option> 
                                </select>
                            </div>
                             
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Leave Accurals</label>
                                <select class="form-select" name="leave_accurals"> 
                                    <option value="1" @if($uinfo->leave_accurals == 1) selected @endif>Active</option>
                                    <option value="0"  @if($uinfo->leave_accurals == 0) selected @endif>Deactivated</option> 
                                </select>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Carry Over Days</label>
                                <input type="number" class="form-control" id="validationCustom01"
                                    placeholder="" name="carry_over_days"  value="{{ $uinfo->carry_over_days }}"/> 
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label" >Expires After</label>
                                <select class="form-select" id="type" name="type"  onchange="selected()"> 
                                    <option value="0" data-title="{{ 'never' }}"  @if($uinfo->expire_after == 0) selected @endif>Never</option> 
                                    <option value="1" data-title="{{ 'days' }}" @if($uinfo->expire_after == 1) selected @endif>Days</option>
                                    <option value="2" data-title="{{ 'month' }}" @if($uinfo->expire_after == 2) selected @endif>Month</option>
                                </select>
                            </div> 
                          
                            {{-- @if(($uinfo->expire_after == 1)   || ($uinfo->expire_after == 2)) --}}
                            <div class="mb-3 col-lg-6 d-none" id="ratingScales">
                                <label for="validationCustom01" class="form-label">Expire Number</label>
                                <input type="text" class="form-control" id="type" name="days_or_month"
                                value="{{ $uinfo->expire_number }}"/> 
                            </div>
                            {{-- @endif --}}
                            {{-- <div class="mb-3 col-lg-6 d-none" id="ratingScales">
                                <label for="validationCustom01" class="form-label">Value</label>
                                <input type="text" class="form-control" id="ratingScales" name="days_or_months"
                                placeholder="" value="{{ $uinfo->days_or_month }}"/> 
                            </div> --}}
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label" >Allow Exceed</label>
                                <select class="form-select" name="allow_exceed"> 
                                    <option value="0" >Select</option> 
                                    <option value="1" @if($uinfo->is_exceed == 1) selected @endif>Yes</option>
                                    <option value="0" @if($uinfo->is_exceed == 0) selected @endif>No</option>
                                </select>
                            </div>
                    </div>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>

    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Update<i
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>

<script>
    $('#colorpicker').on('input', function() {
       $('#hexcolor').val(this.value);
     });
     $('#hexcolor').on('input', function() {
       $('#colorpicker').val(this.value);
     });
 
    //  function selected() { 
    //     var selectedTitle = $('#type option:selected').attr('data-title');
    //      if(selectedTitle == 'days'|| selectedTitle  == 'month'){
    //         $('#ratingScales').removeClass('d-none');
    //     }else if (selectedTitle == 'never'){   
    //         alert('b');        
    //         $('#ratingScales').addClass('d-none');
    //     }

    // }

    $(document).ready(function() {
    // Call the selected function on document ready
    selected();

    // Function to handle the visibility of the "Value" input field
    function selected() { 
        var selectedTitle = $('#type option:selected').attr('data-title');
        if (selectedTitle === 'days' || selectedTitle === 'month') {
            $('#ratingScales').removeClass('d-none');
        } else if (selectedTitle === 'never') {
            $('#ratingScales').addClass('d-none');
        }
    }

    // Call the selected function on change of the dropdown
    $('#type').change(function() {
        selected();
    });
});

 </script>