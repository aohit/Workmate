
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
                <div class="card">
                    <div class="card-body px-sm-3 px-0">  
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom04" class="form-label">Color Name</label>
                                <input type="text" class="form-control" id="validationCustom04"
                                    placeholder="Color name" name="color_name" value="{{ $uinfo->color_name }}"">
                                
                            </div>  
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom04" class="form-label">Color Code</label>
                                <input type="text" class="form-control" id="validationCustom04"
                                    placeholder="Color Code" name="color_code" value="{{ $uinfo->color_code }}"">
                                
                            </div>  
                        </div> 
                     
                    </div>
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