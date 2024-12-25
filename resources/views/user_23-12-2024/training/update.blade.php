<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="singleUserform(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $uinfo->id }}">
<div class=" modal-body">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Training name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Department name"
                                    name="training_name" value="{{ $uinfo->title }}" />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Status</label>
                                <select class="form-select" name="status" onchange="Status(this);"> 
                                    <option value="1" @if($uinfo->status == 1) selected @endif>Completed</option>
                                    <option value="0" @if($uinfo->status == 0) selected @endif>In-Progress</option>
                                    <option value="2" @if($uinfo->status == 2) selected @endif>Delayed</option> 
                                </select>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Institution/ Training Provider Name </label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Institution/ Training Provider Name " name="institution_or_training_provider" value="{{ $uinfo->institution_or_training_provider }}" />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="validationCustom01"
                                    placeholder="Start Date" name="start_date" 
                                    value="{{ \Carbon\Carbon::parse($uinfo->start_time)->format('Y-m-d') }}"/>
                                    
                            </div>
                            <div class="mb-3 col-lg-6" id="completeDate" style="display: none">
                                <label for="validationCustom01" class="form-label">Completion Date</label>
                                <input type="date" class="form-control" id="validationCustom01"
                                    placeholder="Completion Date" name="completion_date" value="{{ \Carbon\Carbon::parse($uinfo->end_date)->format('Y-m-d') }}"/>
                            </div>

                            {{-- <div class="mb-3 col-lg-12">
                                <label for="validationCustom02" class="form-label">Employee Name</label>
                                <select class="form-select" name="user_id"> 
                                    <option value="">Select Employee</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"@if($uinfo->user_id == $user->id ) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3 col-lg-12 d-none">
                                <label for="validationCustom01" class="form-label">Employee</label>
                                <input type="text" class="form-control"
                                placeholder="Name" value="{{$employee_data->name}}" name="user_id" disabled>
                                <input type="hidden" name="employee_id" class="form-control" value="{{$employee_data->id}}">
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom01" class="form-label">Training Objectives </label>
                                <textarea name="objectives" id="" class="form-control"   rows="3">{{ $uinfo->description }}</textarea>
                            </div> 
                            <div class="mb-3 col-lg-6" id="completeDate">
                                <label for="validationCustom01" class="form-label">Certificate Awarded?</label>
                                
                                <div>
                                <input type="radio" class="c_award" name="certificate" value="1" id="yes" {{ $uinfo->certificate_award ? 'checked' : '' }}>
                                <label for="yes">Yes</label>
                                </div>
                                <div>    
                                <input type="radio" name="certificate" value="0" id="no" {{ !$uinfo->certificate_award ? 'checked' : '' }}>
                                <label for="no">No</label>
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
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>