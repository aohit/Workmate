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
                                    <label for="validationCustom08" class="form-label">Departments</label>
                                    <select class="form-select" name="department" id="department" onchange="selectSate()">
                                        <option value=""> Select Departments..</option>
                                        @foreach($departments as $departmentId=>$department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 

                                {{-- <div class="mb-3 col-lg-6">
                                    <label for="validationCustom08" class="form-label">Employee</label>
                                    <select class="form-select" name="employee">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  --}}

                                <div class="col-md-6">
                                    <label for="status" class="form-label">Employee</label>
                                    <select class="form-select select2" name="employee" id="cities">
                                    <option value=""> Select Employee ... </option>
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Certificate Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Certificate Name" name="certificatename" />
                                  </div> 


                                <div class="col-sm-6 text-secondary">
                                    <label for="validationCustom08" class="form-label">Upload</label>
                                    <input type="file" class="form-control" name="certificate_image" id="photoInput" />
                                </div>
                               
                            </div>
                                {{-- <div class="row mb-3"> --}}
                                  
                                    {{-- <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="certificate_image" id="photoInput" />
                                    </div> --}}
                                    {{-- <div class="col-sm-3">
                                        <div id="photoPreview"></div>
                                    </div> --}}
                                {{-- </div>  --}}
                         

                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
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

<script>
     function selectSate()
        {
         var selectedValue = document.getElementById("department").value;
         $.ajax({
                  headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                  url: "{{route('admin.getStateData')}}",
                  method: "POST",
                  data: { id: selectedValue },
                  success: function (response)
                 { 
                  $('#cities').html(response.cities);
                },
               });
        }
    // $('#photoInput').on('change', function(e) {
    //         var files = e.target.files;
    //         var previewContainer = $('#photoPreview');

    //         previewContainer.empty();

    //         for (var i = 0; i < files.length; i++) {
    //             var file = files[i];
    //             var reader = new FileReader();

    //             reader.onload = (function(file) {
    //                 return function(e) {

    //                     var img = $('<img>').addClass('img-thumbnail')
    //                                         .attr('src', e.target.result)
    //                                         .css({'width': '70px', 'height': '70px'}); 
    //                     previewContainer.append(img);
    //                 };
    //             })(file);

    //             reader.readAsDataURL(file);
    //         }
    //     });
</script>