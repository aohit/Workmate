<?php 
use App\Enums\EmergencyContectPersonEnum;
?>
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
                                    <input type="text" id="basic-datepicker-two" name="employment_start"
                                        class="form-control basic-datepicker" placeholder="Employment Start Date">
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

                            {{-- <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Reporting To</label>
                                    <select class="form-select" name="reporting">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key => $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6" id="mainselect">
                                    <label for="validationCustom09" class="form-label">Reportee</label>
                                    <select class="form-select select2" name="reportee[]" multiple>
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key => $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

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
                                        @foreach($employee as $key => $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6" id="mainselect">
                                    <label for="validationCustom13" class="form-label">Roles</label>
                                    <select class="form-select " id="mySelect" name="roles">
                                        @foreach($roles as $key => $role)
                                            <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom12" class="form-label">National ID</label>
                                    <input type="text" class="form-control" id="validationCustom12"
                                        placeholder="National Id" name="national_id" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom10" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="validationCustom11"
                                        placeholder="Phone Number" name="phone_number" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom12" class="form-label">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option value="">Select Genger ...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom10" class="form-label">Nationality</label>
                                    <select class="form-select select2" name="nationality">
                                        <option value="">Select Nationality...</option>
                                        @foreach ($countris as $country)
                                            <option value="{{$country->id}}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom12" class="form-label">Marital Status</label>
                                    <select class="form-select" name="marital_status">
                                        <option value="">Select Marital Status...</option>
                                        <option value="married">Married</option>
                                        <option value="single">Single</option>
                                        <option value="in-relationship">In-relationship</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- <div class="row"> -->
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">language</label>
                                        <select class="form-select select2" name="language_id[]" multiple>
                                            <option value=""> Select Languages ... </option>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->id }}"> {{ $language->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom10" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="validationCustom11"
                                            placeholder="Job Title " name="job_title" />
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                <!-- </div> -->
                                <!-- <div class="row"> -->
                                    <div class="mb-3 col-lg-12">
                                        <label for="validationCustom10" class="form-label">Residential Address</label>
                                        <textarea name="residention_address" id="" class="form-control"
                                            rows="2"></textarea>
                                    </div>
                                <!-- </div> -->
                                <label for="validationCustom10" class="form-label">Emergency Contacts</label>
                                <section class="" id="select">
                                    <div class="mb-3 col-lg-12 border  overflow-auto p-2" style="height: 147px" id="">
                                        <table class="m-auto">
                                            <tbody>
                                                <tr>
                                                    <td class="pb-2">
                                                        <div class="row ">
                                                            <div class="col-lg-3 col-sm-6">
                                                                <input type="text" name="emergency_contact_person[]"
                                                                    class="form-control"
                                                                    placeholder="Contact person name" value="">
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6 py-sm-0 py-2">
                                                                <input type="text" name="emergency_contact_number[]"
                                                                    class="form-control" placeholder="Contact Number"
                                                                    value="">
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6 my-lg-0 my-sm-2">
                                                                <select class="form-select"
                                                                    name="emergency_contact_relaton[]" id="">
                                                                    <option value="">Select Relationship </option>
                                                                    @foreach (EmergencyContectPersonEnum::cases() as $key => $value)
                                                                        <option value="{{$value}}"> {{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-baseline">
                                                        <div class="d-flex">
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="deleteoptionsRow(this)">
                                                                <span class="mdi mdi-delete fs-3"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="addRow(this)">
                                                                <span class="mdi mdi-plus fs-3"></span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </section>
                            </div>
                        </div>
                    {{-- </div>
                </div> --}}

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save<i
                    class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                    style="display:none;"></i></button>
        </div>
</form>

<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>

<script>
    $('.select2').select2({
        dropdownParent: $('#mainselect')
    });
    function addRow(e) {
        let row = $(e).parents('tr');
        let tableRowCount = $("#select").find("tr").length;
        if (tableRowCount == 2) {
            toastr.info("You can only add 2 persons", "Information");
        } else {

            $(row).after('<tr>' + row.html() + '</tr>');
        }
        // rowValue();
    }

    function deleteoptionsRow(e) {
        let rowCount = $('#select').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                // rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }
</script>