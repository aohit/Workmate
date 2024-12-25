<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmitAppraisal" onsubmit="formSubmitAppraisal(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Employes Name</label>
                                    <select class="form-select select2" name="employeename[]" id="employeeName" multiple >
                                        <option value="">--Choose--</option>
                                        @foreach ($employee as $employe)
                                        <option value="{{ $employe->id }}">{{ $employe->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Self-review Deadline</label>
                                    <input type="text" id="datepicker" class="form-control" name="self_review_deadline" data-date-format='yyyy-mm-dd'>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Manager-review Deadline</label>
                                    <input type="text" id="datepicker-tow" class="form-control" name="manager_review_deadline" data-date-format='yyyy-mm-dd'>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Questionnaire</label>
                                    <select class="form-select" name="questionnaire">
                                        <option value="">--Choose--</option>
                                        @foreach($questionnaires as $questionnaire)
                                        <option value="{{$questionnaire->id}}"><?php  echo ucfirst($questionnaire->title)  ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom02" class="form-label">Review cycle</label>
                                    <select class="form-select" name="reviewcycle">
                                        <option value="">--Choose--</option>
                                        <option value="0">Yearly review</option>
                                        <option value="1">Mid year review</option>
                                    </select>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
      $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#bs-example-modal-lg')
        }); 
    
      });
      $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'Y-m-d'
    });
    $( "#datepicker-tow" ).datepicker({
        dateFormat: 'Y-m-d'
    });
  } );

</script>