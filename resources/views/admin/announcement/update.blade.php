
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
                    {{-- <div class="card-body px-sm-3 px-0">   --}}
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Title" name="title" value="{{ $uinfo->title }}"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            {{-- <div class="mb-3 col-lg-6">
                                <label for="validationCustom08" class="form-label">Employee</label>
                                <select class="form-select" name="employee_id">
                                    <option value="">-Select-</option>
                                        @foreach($employee as $emp)
                                        <option value="{{ $emp->id }}" @if($uinfo->employee_id ==
                                            $emp->id) selected @endif>{{ $emp->name }}</option>
                                        @endforeach
                                </select>
                            </div> --}}
                        </div>

                        <div class="row">
                          
                                <div class="col--md-6 my-4">
                                   <div class="d-sm-flex align-item-center ">
                                      <label class="form-label ">Background Color<sup class="text-danger">*</sup></label>
                                      <input type="color" id="colorpicker" name="background_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{$uinfo->background_color_id}}" class="mx-2 align-middle"> 
                                      <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" name="color_theme_one" value="{{$uinfo->background_color_id}}" id="hexcolor">
                                   </div>
                                </div>
                           
                 
                                <div class="col--md-6 my-4">
                                   <div class="d-sm-flex align-item-center ">
                                      <label class="form-label ">Text Color<sup class="text-danger">*</sup></label>
                                      <input type="color" id="colorpickers" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{$uinfo->text_color_id}}" class="mx-2 align-middle"> 
                                      <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" name="color_theme_two" value="{{$uinfo->text_color_id}}" id="hexcolors">
                                   </div>
        
                        </div>
                    </div>
                      
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustomUsername" class="form-label">Description</label>
                                    <textarea  class="form-control" id="validationCustomUsername"
                                        placeholder="Description" aria-describedby="inputGroupPrepend" name="description" />{{ $uinfo->description }}</textarea>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                    
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
 
     $('#colorpickers').on('input', function() {
       $('#hexcolors').val(this.value);
     });
     $('#hexcolors').on('input', function() {
       $('#colorpickers').val(this.value);
     });
 </script>