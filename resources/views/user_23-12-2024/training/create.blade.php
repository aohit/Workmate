<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="singleUserform(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Training Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Training name" name="training_name" />
                                </div> 
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status"  onchange="Status(this);"> 
                                        <option value="0">In-Progress</option>
                                        <option value="1">Completed</option>
                                        <option value="2">Delayed</option>
                                    </select>
                                </div>
                            
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Institution/ Training Provider Name </label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Institution/ Training Provider Name " name="institution_or_training_provider" />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="validationCustom01"
                                        placeholder="Start Date" name="start_date" />
                                </div>
                                <div class="mb-3 col-lg-6" id="completeDate" style="display: none">
                                    <label for="validationCustom01" class="form-label">Completion Date</label>
                                    <input type="date" class="form-control" id="validationCustom01"
                                        placeholder="Completion Date" name="completion_date" />
                                </div>

                                <div class="mb-3 col-lg-12 d-none">
                                    <label for="validationCustom01" class="form-label">Employee</label>
                                    <input type="text" class="form-control"
                                    placeholder="Name" value="{{$employee_data->name}}" name="user_id" disabled>
                                    <input type="hidden" name="employee_id" class="form-control" value="{{$employee_data->id}}">
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom01" class="form-label">Objectives/Module </label>
                                    <textarea name="objectives" id="" class="form-control"   rows="3"></textarea>
                                </div> 

                                {{-- <div class="mb-3 col-lg-6" id="completeDate" style="display: none">
                                    <label for="validationCustom01" class="form-label">Completion Date</label>
                                    <input type="date" class="form-control" id="validationCustom01"
                                        placeholder="Completion Date" name="completion_date" />
                                </div> --}}


                                <div class="mb-3 col-lg-6" id="completeDate">
                                    <label for="validationCustom01" class="form-label">Certificate Awarded?</label>
                              <div>
                                    <input type="radio" class="c_award" name="certificate" value="1" id="yes">
                                    <label for="yes">Yes</label>
                                </div>
                                <div>    
                                    <input type="radio" name="certificate" value="0" id="no">
                                    <label for="no">No</label>
                                </div>
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
        <button class="btn btn-primary" type="submit">Save<i
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>