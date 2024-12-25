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
                    <div class="card-body">  
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Title" name="title" value="{{ $uinfo->title }}" /> 
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Roles</label>
                                <select class="form-select" name="role">
                                    <option value="">-Select-</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($uinfo->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom03" class="form-label">Status</label>
                                <select class="form-select" name="status"> 
                                    <option value="1" @if($uinfo->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($uinfo->status == 0) selected @endif>In-Active</option> 
                                </select>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="mb-3 col-lg-126">
                                <label for="validationCustom04" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="validationCustom04"
                                    placeholder="Description..." name="description">{{ $uinfo->description }}</textarea>
                                
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