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
                    <div class="card">
                        <div class="card-body px-sm-3 px-0">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Employee</label>
                                    <select class="form-select" name="employee">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                    <div class="mb-3 col-lg-6">
                                        <label for="validationCustom01" class="form-label">Qualification</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            placeholder="Qualification" name="qualification">
                                    </div> 
                                    
                            </div> 

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Percentage</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Percentage" name="percentage">
                                </div> 

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Passing Year</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Year" name="passing_year">
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