<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                   
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="validationCustomUsername" class="form-label">Description</label>
                                            <textarea  class="form-control" rows="8"  cols="5" id="validationCustomUsername"
                                                placeholder="Description" aria-describedby="inputGroupPrepend" name="description" readonly/>{{ $uinfo->description }}</textarea>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                    </div>
                            </div> <!-- end .table-responsive -->
                    </div> <!-- end card -->
                </div><!-- end col -->
          
 
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
</form>
 
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>

<script>
// $(document).ready(function() {
// $('#mySelect').select2(); 
// });
 
</script>