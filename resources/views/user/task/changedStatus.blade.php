<?php 
use App\Enums\TaskStatusEnum;
?>
<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="storeStatus(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $uinfo->id }}">
    <div class=" modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">--Choose--</option>
                                    
                                        @foreach (TaskStatusEnum::cases() as $key => $value)
                                            <option value="{{$value}}"  @selected($uinfo->status == $value->value)>{{ $value }}</option>
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Update<i
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script>
