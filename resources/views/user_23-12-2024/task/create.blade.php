<?php 
use App\Enums\TaskStatusEnum;
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Document Name" name="title" /> 
                                </div>
                                {{-- <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">User</label>
                                    <select class="form-select" name="user_id">
                                        <option value="">--Choose--</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div> --}}
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">Start date</label>
                                    <input type="text" id="basic-datepicker-two" name="start_date" class="form-control basic-datepicker"
                                        placeholder="Employment Start Date">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">End date</label>
                                    <input type="text" name="end_date" class="form-control basic-datepicker"
                                        placeholder="Employment Start Date">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id=""  rows=""></textarea>
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