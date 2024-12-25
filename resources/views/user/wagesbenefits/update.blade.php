<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $uinfo->id }}">
    <div class=" modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body"> --}}
                            <div class="row">
                              
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Employee</label>
                                    <select class="form-select" name="user_id">
                                        <option value="">--Choose--</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"@if($uinfo->user_id == $employee->id) selected @endif>{{ $employee->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">Item</label>
                                    <input type="text" class="form-control" id="validationCustom04"
                                        placeholder="items" name="items" value="{{ $uinfo->items }}"">
                                    
                                </div> 
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">Currency</label>
                                    <input type="text" class="form-control" id="validationCustom04"
                                        placeholder="currency" name="currency" value="{{ $uinfo->currency }}"">
                                    
                                </div> 
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom04" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="validationCustom04"
                                        placeholder="amount" name="amount" value="{{ $uinfo->amount }}"">
                                    
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
        <button class="btn btn-primary" type="submit">Update<i
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>
