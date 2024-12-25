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
                        {{-- <div class="card-body px-sm-3 px-0"> --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label"> Item</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Item" name="title" />
                                </div> 
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Training Status</label>
                                    <select class="form-select" name="status"> 
                                        <option value="0">In-Progress</option>
                                        <option value="1">Completed</option>
                                        <option value="2">Delayed</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom02" class="form-label">Employee Name</label>
                                    <select class="form-select" name="user_id"> 
                                        <option value="">Select Employee</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom01" class="form-label">Training Objectives </label>
                                    <textarea name="description" id="" class="form-control"   rows="3"></textarea>
                                </div> 
                            </div> 
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
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