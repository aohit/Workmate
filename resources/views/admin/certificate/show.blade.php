<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row justify-content-center" id="certificate">
                @foreach ($certificates as $certificate)
                    <div class="card" style="width: 14rem;">
                        <img src=" {{ asset('/upload/certificate') . '/' . $certificate->file }}" class="card-img-top"
                            width="40%" alt="">
                        <div class="card-body p-0 px-sm-3 px-0">
                            <div class="row mt-3 mb-2">
                                <div class="col text-center">
                                    <a href="{{ asset('/upload/certificate') . '/' . $certificate->file }}" download class="card-link"></a>
                                </div>
                                {{-- <div class="col text-center">
                                    <a href="javascript:void(0)" class="card-link" onclick="deletecertificate({{$certificate->id}})" ><i class="fa fa-trash-o" style="font-size: xx-large;" aria-hidden="true"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
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