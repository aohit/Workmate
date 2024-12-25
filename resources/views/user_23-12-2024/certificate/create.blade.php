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
                                    <label for="validationCustom08" class="form-label">Employee</label>
                                    <select class="form-select" name="employee">
                                        <option value="">-Select-</option>
                                        @foreach($employee as $key=>$emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
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

<script>
    
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