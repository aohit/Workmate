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
                    <div class="card">
                        <div class="card-body px-sm-3 px-0">
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 35%;">Title</td>
                                            <td>{{ $goal->title }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Description</td>
                                            <td>{{ $goal->description }}</td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive -->
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
 
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