<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $appraisal->id }}">
<div class=" modal-body">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="card"> --}}
                    {{-- <div class="card-body px-sm-3 px-0"> --}}
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Employes Name</label>
                                <select class="form-select select2" name="employeename" id="employeeName">
                                    <option value="">--Choose--</option>
                                    @foreach ($employee as $employe)
                                    <option value="{{ $employe->id }}" @if($appraisal->user_id == $employe->id ) selected @endif >{{ $employe->name}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Self-review Deadline</label>
                                <input type="text" id="datepicker" class="form-control" name="self_review_deadline" data-date-format='yyyy-mm-dd' value="{{$appraisal->self_review_deadline }}">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Manager-review Deadline</label>
                                <input type="text" id="datepicker-tow" class="form-control" name="manager_review_deadline" data-date-format='yyyy-mm-dd' value="{{$appraisal->manager_review_deadlin}}">
                            </div>
                              <div class="mb-3 col-lg-6">
                                <label for="validationCustom02" class="form-label">Questionnaire</label>
                                <select class="form-select" name="questionnaire">
                                    <option value="">--Choose--</option>
                                    @foreach($questionnaires as $questionnaire)
                                    <option value="{{$questionnaire->id}}" @if($appraisal->questionnaire == $questionnaire->id) selected @endif><?php  echo ucfirst($questionnaire->title)  ?></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom02" class="form-label">Review cycle</label>
                                <select class="form-select" name="reviewcycle">
                                    <option value="">--Choose--</option>
                                    @foreach ($reviewcycles as $reviewcycle)
                                    <option value="{{$reviewcycle->id}}"  @if($appraisal->review_cycle == $reviewcycle->id) selected @endif >{{ $reviewcycle->title }}</option>
                                    @endforeach
                                </select>
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
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
<script>
    $( function() {
  $( "#datepicker" ).datepicker({
      dateFormat: 'Y-m-d'
  });
  $( "#datepicker-tow" ).datepicker({
      dateFormat: 'Y-m-d'
  });
} );

</script>