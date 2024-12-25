@foreach ($certificates as $certificate)
<div class="card" style="width: 14rem;">
    <img src=" {{ asset('/upload/certificate') . '/' . $certificate->file }}" class="card-img-top"
        width="40%" alt="">
    <div class="card-body p-0">
        <div class="row mt-3 mb-2">
            <div class="col text-center">
                <a href="{{ asset('/upload/certificate') . '/' . $certificate->file }}" download class="card-link"><i class="fa fa-download" style="font-size: xx-large;" aria-hidden="true"></i></a>
            </div>
            <div class="col text-center">
                <a href="javascript:void(0)" class="card-link" onclick="deletecertificate({{$certificate->id}})" ><i class="fa fa-trash-o" style="font-size: xx-large;" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach
