
<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">Add Certificate</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="certificateSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Certificate</label>
                                    <input type="file" class="form-control" id="validationCustom01"
                                         name="certificate" /> 
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Certificate Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Certificate Name" name="certificatename" />
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