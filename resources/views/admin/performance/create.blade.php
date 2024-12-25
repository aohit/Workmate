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
                                    <label for="validationCustom01" class="form-label">Employee</label>
                                    <select class="form-select" name="employee">
                                        <option value="">-Select-</option>
                                        @foreach($employee_data as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Review Template</label>
                                    <select class="form-select" name="review_template">
                                        <option value="">-Select-</option>
                                        @foreach($review_temp as $temp)
                                        <option value="{{ $temp->id }}">{{ $temp->temp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Start Date</label>
                                    <input type="text" id="basic-datepicker" name="start_date" class="form-control"
                                        placeholder="Start Date" onchange="startDate(this.value)">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">End Date</label>
                                    <input type="text" id="basic-datepicker-two" name="end_date" class="form-control"
                                        placeholder="End Date" onchange="endDate(this.value)">
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
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>