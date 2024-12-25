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
                        {{-- <div class="card-body"> --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Title" name="title" /> 
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Issue Date</label>
                                    <input type="text" id="basic-datepicker" name="issue_date" class="form-control"
                                        placeholder="Issue Date" onchange="startDate(this.value)">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Disciplinary action type</label>
                                    <select class="form-select" name="actiontype_id">
                                        <option value="">-Select-</option>
                                        @foreach($disciplinaryactions as $disciplinaryaction)
                                        <option value="{{ $disciplinaryaction->id }}">{{ $disciplinaryaction->action_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Department</label>
                                    <select class="form-select" name="department_id">
                                        <option value="">-Select-</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Departments</label>
                                    <select class="form-select" name="department_id" id="department" onchange="selectSate()">
                                        <option value=""> Select Departments..</option>
                                        @foreach($departments as $departmentId=>$department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Employee</label>
                                    <select class="form-select select2" name="employee" id="employee">
                                    <option value=""> Select Employee ... </option>
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Upload Pdf</label>
                                    <input type="file" class="form-control" name="file_path" id="image">
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
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>

<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>

<script>
    function selectSate()
       {
        var selectedValue = document.getElementById("department").value;
        $.ajax({
                 headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                 url: "{{route('disciplinary.getStateData')}}",
                 method: "POST",
                 data: { id: selectedValue },
                 success: function (response)
                { 
                 $('#employee').html(response.cities);
               },
              });
       }
 
</script>