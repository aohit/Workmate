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
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Full name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="First name" name="name" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustomUsername" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" class="form-control" id="validationCustomUsername"
                                            placeholder="Username" aria-describedby="inputGroupPrepend" name="email" />
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Employment start</label>
                                    <input type="text" id="basic-datepicker-two" name="employment_start" class="form-control basic-datepicker"
                                        placeholder="Employment Start Date">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">Employment end</label>
                                    <input type="text" name="employment_end" class="form-control basic-datepicker"
                                        placeholder="Employment Start Date">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom5" class="form-label">Date of Birth</label>
                                    <input type="text" id="basic-datepicker" name="date_of_birth"
                                        class="form-control basic-datepicker" placeholder="Date Of Birth">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Employee Code</label>
                                    <input type="text" class="form-control" id="validationCustom6"
                                        placeholder="Employee Code" name="employee_code" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Reporting To</label>
                                    <select class="form-select" name="reporting">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom09" class="form-label">Reportee</label>
                                    <select class="form-select" name="reportee[]" multiple>
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom10" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="validationCustom11"
                                        placeholder="Password" name="password" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom12" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="validationCustom12"
                                        placeholder="Password" name="password_confirmation" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom13" class="form-label">Department</label>
                                    <select class="form-select" name="department">
                                        <option value="">-Select-</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Manager</label>
                                    <select class="form-select" name="manager">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom13" class="form-label">Roles</label>
                                    <select class="form-select" id="mySelect" name="roles[]" multiple>
                                         
                                        @foreach($roles as $key=>$role)
                                        <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
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

<script>
// $(document).ready(function() {
// $('#mySelect').select2(); 
// });
 
</script>