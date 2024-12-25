<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $role->id }}">
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Role Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Role name" name="name" value="{{$role->name}}" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                {{-- <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Guard Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Role name" name="guard_name" value="{{$role->guard_name}}" />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div> --}}
                                
                            </div>
                            <div class="row"> 
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Permission:</label>
                                    @foreach ($permission as $value)
                                    <br />
                                    <label>
                                         @php $name = $value->name;
                                        $permissionName = str_replace('-',' ',$name);
                                          @endphp
                                        <input type="checkbox" value="{{$value->id}}" name="permission[]" @if(in_array($value->id, $rolePermissions)) checked @endif >
                                        {{ ucwords($permissionName) }}</label>
                                    <br />
                                    @endforeach
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