@extends('admin.layouts.app')

@section('content')


<div class="container-fluid">
    <form id="formSubmit" onsubmit="formSubmit(this,'{{ route('admin.profile.update') }}');return false;">
        @csrf
        <input type="hidden" name="id" value="{{ $uinfo->id }}">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="bg-picture card-body">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="validationCustom01" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                            name="name" value="{{ $uinfo->name }}" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="validationCustomUsername" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control" id="validationCustomUsername"
                                placeholder="Username" aria-describedby="inputGroupPrepend" name="email"
                                value="{{ $uinfo->email }}" />
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="validationCustom02" class="form-label">Password</label>
                        <input type="password" class="form-control" id="validationCustom02"
                            placeholder="Password" name="password" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="validationCustom02" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="validationCustom03"
                            placeholder="Password" name="password_confirmation" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>          
                <div class="mb-3 col-lg-12 d-flex justify-content-between">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-light">Back</a>
                    <button class="btn btn-primary" type="submit">Update<i
                        class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                        style="display:none;"></i></button>
                    </div>
           </div>
        </div>
           
        </div>

         
    </div>  
</form>
    <div class="card">
        <div class="card-body">
            <form id="formSubmit1" onsubmit="formSubmit(this,'{{route('admin.profile.images')}}');return false;">
                @csrf
                <input type="hidden" name="id" value="{{ $uinfo->id }}">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <div class="custom-file">
                                    <input type="hidden" name="profile_image_path" value="uploads/employee/">
                                    <input type="hidden" name="profile_image_name" value="profile_image">
                                    <input type="file" class="custom-file-input form-control" value="{{ $uinfo->profile_image }}" name="profile_image" 
                                        onchange="upload_image(this.form, '{{ route('admin.profile.image') }}', 'profile_image');"
                                        accept=".jpg,.jpeg,.png">
                                    <input type="hidden" name="file_id" id="profile_image_file_id" value="{{$uinfo->profile_image}}">
                                    <i class="profile_image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
                                    <label id="lblErrorMessageProfileImage" style="color:red"></label>
                                </div>
                            </div>
                            <div class="col-md-2 mt-3">
                                @if($uinfo->profile_image)
                                <img src="{{asset('uploads/employee/'.$uinfo->prfileImage->file)}}" id="profile_image_prev" class="img-thumbnail" alt="" width="100" height="100" >
                                @else
                                <img src="" id="profile_image_prev" class="img-thumbnail" alt="" width="100" height="100" style="display:none">
                                @endif
                                <label id="lblErrorMessageProfileImage" style="color:red"></label>
                            </div>
                        </div>
                    </div>
                
                    <div class="mb-3 col-lg-6">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="system_logo" class="form-label">System Logo</label>
                                <div class="custom-file">
                                    <input type="hidden" name="system_logo_path" value="uploads/employee/">
                                    <input type="hidden" name="system_logo_name" value="system_logo">
                                    <input type="file" class="custom-file-input form-control" value="{{ $uinfo->logo }}" name="system_logo" 
                                        onchange="upload_image(this.form, '{{ route('admin.profile.image') }}', 'system_logo');"
                                        accept=".jpg,.jpeg,.png">
                                    <input type="hidden" name="system_logo_file_id" id="system_logo_file_id" value="{{$uinfo->logo}}">
                                    <i class="system_logo_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
                                    <label id="lblErrorMessageSystemLogo" style="color:red"></label>
                                </div>
                            </div>
                            <div class="col-md-2 mt-3">
                                @if($uinfo->logo)
                                <img src="{{asset('uploads/employee/'.$uinfo->logoimage->file)}}" id="system_logo_prev" class="img-thumbnail" alt="" width="100" height="100">
                                @else
                                <img src="" id="system_logo_prev" class="img-thumbnail" alt="" width="100" height="100" style="display:none">
                                @endif
                              
                                <label id="lblErrorMessageSystemLogo" style="color:red"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-lg-12 d-flex justify-content-between">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-light">Back</a>
                    <button class="btn btn-primary" type="submit">Update<i
                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                            style="display:none;"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page-js-script')
<script> 
 
// public/js/common.js

function formSubmit(form, url) {
    $(form).find('.st_loader').show();
    event.preventDefault();
    var formData = new FormData(form);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.success == 1) {
                toastr.success(response.message, 'Success');
                window.setTimeout(function() {
                    window.location.reload();
                    $(form).find('.st_loader').hide();
                }, 500);
            } else {
                $(form).find('.st_loader').hide();
                toastr.error("Find some error", 'Error');
            }
        },
        error: function(xhr, status, error) {
            $(form).find('.st_loader').hide();
            var $err = '';
            $.each(xhr.responseJSON.errors, function(key, value) {
                $err = $err + value + "<br>";
            });
            toastr.error($err, 'Error');
        }
    });
}













   function upload_image(form, url, type) {
        $(form).find('.' + type + '_loader').show();
        $.ajax({
            type: "POST",
            url: url + '?type=' + type,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            data: new FormData(form),
            success: function (res) {
                $(form).find('.' + type + '_loader').hide();
                if (res.status == 0) {
                    toastr.error(res.msg, 'Error');
                } else {
                    $('#' + type + '_prev').attr('src', res.file_path);
                    $('#' + type + '_prev').show();
                    $('#' + type + '_file_id').val(res.file_id);
                }
            }
        });
   }


 
</script>
@endsection