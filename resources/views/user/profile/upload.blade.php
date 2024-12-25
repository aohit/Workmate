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
                            {{-- <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom01" class="form-label">Employee</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Title" name="empoyee_id" />
                                    
                                </div> 
                            </div>  --}}
                            <div class="row">
                                <div class="row mt-2">
                                    <div class="col-md-10">
                                        <label for="Outletname" class="form-label">Image</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="image_path" value="upload/employee/">
                                            <input type="hidden" name="image_name" value="image">
                                            <input type="file" class="custom-file form-control" name="image"
                                                onchange="upload_image($(form),'{{ $route->saveimage }}','image','file_id');return false;"
                                                accept=".jpg,.jpeg,.png">
                                            <input type="hidden" name="file_id" id="file_id" value="">
                                            <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                                style="display:none;"></i>
                                            <label id="lblErrorMessageBannerImage" style="color:red"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <img src="" id="image_prev" class="img-thumbnail " alt="" width="100" height="100"
                                            style="display:none">
                                        <label id="lblErrorMessageBannerImage" style="color:red"></label>
                                    </div>
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

<script>
    function upload_image(form, url, id, input) 
{
  $(form).find('.' + id + '_loader').show();
  $.ajax({
    type: "POST",
    url: url + '?type=' + id,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    contentType: false,
    cache: false,
    processData: false,
    dataType: "json",
    data: new FormData(form[0]),
    success: function (res) {
      if (res.status == 0) {
        $(form).find('.' + id + '_loader').hide();
        toastr.error(res.msg, 'Error');
      } else {
        $(form).find('.' + id + '_loader').hide();
        $('#' + id + '_prev').attr('src', res.file_path);
        $('#' + id + '_prev').addClass('form-image');
        $('#' + id + '_prev').show();
        $('#' + input).val(res.file_id);
      }

    }
  });
}
</script>