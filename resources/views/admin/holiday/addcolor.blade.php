<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="colorformSubmit" onsubmit="colorFormSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body px-sm-3 px-0"> --}}
                            <div class="row">
                                <div class="col-md-12 my-4">
                                    <div class="d-flex flex-wrap justify-content-sm-start  justify-content-between  align-item-center">
                                       <label class="form-label "> Color<sup class="text-danger">*</sup></label>
                                       <input type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" class="mx-2"> 
                                       <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" name="color_theme_one"  id="hexcolor">
                                    </div>
                                 </div>
                            
                                 
                            {{-- </div>  --}}
                            
                        {{-- </div> --}}
                    </div>
                </div>
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



<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>
{{-- @section('page-js-script') --}}
<script>
    $('#colorpicker').on('input', function() {
       $('#hexcolor').val(this.value);
     });
     $('#hexcolor').on('input', function() {
       $('#colorpicker').val(this.value);
     });
 
 
 </script>
  {{-- @endsection --}}
