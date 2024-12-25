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
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Full name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Department name"
                                    name="title" value="{{ $uinfo->title }}" />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Status</label>
                                <select class="form-select" name="status"> 
                                    <option value="1" @if($uinfo->status == 1) selected @endif>Completed</option>
                                    <option value="0" @if($uinfo->status == 0) selected @endif>In-Progress</option>
                                    <option value="2" @if($uinfo->status == 2) selected @endif>Delayed</option> 
                                </select>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom01" class="form-label">Training Objectives </label>
                                <textarea name="description" id="" class="form-control"   rows="3">{{ $uinfo->description }}</textarea>
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