@extends('user.layouts.app')

@section('content')


<div class="container-fluid">
    @php $assessPotential = App\Models\AssessPotential::where('performance_id',$performance->id)->first(); @endphp

    @if(empty($assessPotential))
    <form id="formSubmit" onsubmit="formSubmit(this);return false;">
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="performance_id" value="{{$performance->id}}">
        @csrf
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
                    </div>
                    <div class="row"> 
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Potential</label>
                            <select class="form-select" id="" name="potential">  
                                <option value="">--Select--</option>
                                <option value="1">Emerging Telent</option>
                                <option value="2">Placement Issue</option> 
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Retention</label>
                            <select class="form-select" id="" name="retention"> 
                                <option value="">--Select--</option> 
                                <option value="1">High Rist</option>
                                <option value="2">Low Rist</option>
                                <option value="3">Medium Rist</option> 
                            </select>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Achievable Level</label>
                            <select class="form-select" id="" name="achievable_level">  
                                <option value="">--Select--</option>
                                <option value="1">1-2 Level</option>
                                <option value="2">2-3 Level</option> 
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Loss Impact</label>
                            <select class="form-select" id="" name="loss_impact">  
                                <option value="">--Select--</option>
                                <option value="1">Negligible</option>
                                <option value="2">Minor</option> 
                                <option value="3">Critical</option> 
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 col-lg-12"> 
                        @if($performance->status == 1)
                        <button class="btn btn-primary" type="submit">Complete<i
                                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button> 
                                @endif
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end row -->
</form>
@else
<div>
    <h3>Assess potential already completed</h3>
    <div class="mt-3 col-lg-12"> 
        <form id="formSubmitComplete" onsubmit="formSubmitComplete(this);return false;">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="performance_id" value="{{$performance->id}}">
            @csrf
        
        <button class="btn btn-primary" type="submit">Next<i
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                style="display:none;"></i></button> 
              
            </form>
    </div>
</div>
@endif
</div>
@endsection

@section('page-js-script')
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
<script>
 function formSubmit(e) {  
$confirm = confirm("Are you sure you want to complete manager evalution?"); 
if ($confirm){
    $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('performance.manager.review.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) { 
                    toastr.success(response.message, 'Success'); 
                    window.setTimeout(function() { 
                        $('#formSubmit').find('.st_loader').hide(); 
                        var performanceId = response.performance_id;
                        var redirectUrl = "{{ route('performance.request.complete', ['id' => ':performanceId']) }}";
                            redirectUrl = redirectUrl.replace(':performanceId', performanceId); 
                            window.location.href = redirectUrl; 
                    }, 1000);

                } else {
                    toastr.error("Find some error", 'Error');
                    $('#formSubmit').find('.st_loader').hide();
                }
            },
            error: function(xhr, status, error) {
                $('#formSubmit').find('.st_loader').hide();
                var $err = ''
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $err = $err + value + "<br>"
                })
                toastr.error($err, 'Error')
            }
        });
}
} 

function formSubmitComplete(e) {  
 
 
    $('#formSubmitComplete').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmitComplete')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('performance.manager.review.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) { 
                    toastr.success(response.message, 'Success'); 
                    window.setTimeout(function() { 
                        $('#formSubmitComplete').find('.st_loader').hide(); 
                        var performanceId = response.performance_id;
                        var redirectUrl = "{{ route('performance.request.complete', ['id' => ':performanceId']) }}";
                            redirectUrl = redirectUrl.replace(':performanceId', performanceId); 
                            window.location.href = redirectUrl; 
                    }, 1000);

                } else {
                    toastr.error("Find some error", 'Error');
                    $('#formSubmitComplete').find('.st_loader').hide();
                }
            },
            error: function(xhr, status, error) {
                $('#formSubmitComplete').find('.st_loader').hide();
                var $err = ''
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $err = $err + value + "<br>"
                })
                toastr.error($err, 'Error')
            }
        });
}
 
 
</script>
@endsection