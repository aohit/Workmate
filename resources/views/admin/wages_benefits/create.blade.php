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
                                    <label for="validationCustom02" class="form-label">Employee</label>
                                    <select class="form-select" name="user_id">
                                        <option value="">--Choose--</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Items</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="items" name="items" /> 
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Currency</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="currency" name="currency" /> 
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="validationCustom01"
                                        placeholder="amount" name="amount" /> 
                                </div>
                                 <div class="mb-3 col-lg-12">
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