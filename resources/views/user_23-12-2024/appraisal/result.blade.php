@extends('user.layouts.app')
@section('content')
<style>
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
</style>
<div class="container-fluid p-2">
    <div class="card">
        <div class="card-body "> <form action="{{route('appraisal.pdf')}}" method="post" id="pdfdown">
            @csrf
            <input type="hidden" name="id" value="{{$questionnaires->id}}">
            <input type="hidden" class="empperfom" name="empperfom" value="">
            <input type="hidden" class="managerperfom" name="managerperfom" value="">
            <input type="hidden" class="totalrating" name="totalrating" value="">
            </form>
            <form id="formSubmit">
                @csrf
                <div class="row">
                    <div>
                        <div class="row">
                            <div class="col-sm-6 text-center text-sm-start">
                                <h4>Performance Appraisal: {{ $questionnaires->FormQue->title }}</h4> 
                            </div>
                            <div class="col-sm-6 text-sm-end text-center">
                            
                                 <button type="submit"  class="btn btn-outline-secondary btn-sm" form="pdfdown">Download PDF <i class="fa fa-download" aria-hidden="true"></i></button>
                                
                                    {{-- <a class="btn btn-outline-secondary btn-sm" href="{{ route('appraisal.pdf',encrypt($questionnaires->id))}}" class="btn">Download Pdf <i class="fa fa-download" aria-hidden="true"></i></a> --}}
                            </div>
 
                        </div>
                    </div>
                    <div class="col-sm-6 p-3">
                        <div class="row">
                            <div class="col-sm-3 text-center text-sm-start">
                                @php
                                    if(isset($questionnaires->User->Profile->file)){
                                            $image_url = url('/upload/employee/' . $questionnaires->User->Profile->file);
                                        }else{
                                            $image_url = url('upload/employee/demo.jpg');
                                        }
                                        @endphp
                                        <img src="{{ $image_url }}" class="img-thumbnail profile-img" style="height: 105px; width: 160px;border-radius:50%">
                             <!--<img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-8.jpg') }}" style="width: 80px" class="profile-img" alt="">-->
                            </div>
                            <div class="col-sm-9 text-center text-sm-start">
                                <p class="m-0">name :<span> {{ $questionnaires->User->name}}</span> </p>
                                <span> Manager Name:</span> <span> {{ $questionnaires->Manager->name}}</span><br>
                                <span> Review cycle :</span> {{ $questionnaires->reviewcycle->title }}  (<span>from {{$questionnaires->reviewcycle->start_date}} to {{ $questionnaires->reviewcycle->end_date }}  </span>)
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-3 border-start">
                        <p> <b>Result  {{ ($questionnaires->results_shared == 0) ? 'Not':'' }} have been shared with {{ $questionnaires->User->name}}</b> <br>
                            Selft-review submitted on date {{$questionnaires->self_review_submited}}. <br>
                            Manager review submited on date {{$questionnaires->manager_review_submited}}.</p>
                    </div> 
                    <hr>
                    <div class="d-flex justify-content-center pb-2">
                        <div>
                            <div class="table-container table-responsive">
                                <table class="table table-borderless ">
                                    <thead >
                                        <tr>
                                            <th></th>
                                            <th>Self</th>
                                            <th>Manager</th>
                                            <th><span class="badge bg-warning text-dark p-1"> Gap </span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <th>Performance Competencies a</th>
                                            <td><span>{{ $questionnaires->total_self_rating ?? 0 }}</span></td>
                                            <td><span>{{ $questionnaires->total_manager_rating ?? 0 }}</span></td>
                                            <td><span  class="badge bg-warning text-dark p-1">{{ $questionnaires->total_gap ?? 0 }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><span>{{ $questionnaires->total_self_rating ?? 0 }}</span></td>
                                            <td><span>{{ $questionnaires->total_manager_rating ?? 0 }}</span></td>
                                            <td><span class="badge bg-warning text-dark p-1">{{ $questionnaires->total_gap ?? 0 }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="companyvalues mb-2">
                        <h3>Company Values</h3>
                        <ul>
                            <li><b>Accountability </b>- Assume responsibility for actions, products, decisions and policies.</li>
                            <li><b>Commitment </b> -Commit to deliver great products and outstanding service.</li>
                            <li><b>Innovation </b>- Pursue new creative ideas that have the potential to change the world.</li>
                            <li><b>Integrity </b>-Act with honesty and honor without compromising the truth. Keep your word.</li>
                            <li><b>Ownership </b> -Take care of the company and customers as they were your own.</li>
                        </ul>
                        <span>See our company's values, vision and mission statement here: <a href="http://example.com/values">http://example.com/values</a></span>
                    </div>
                </div>
                <hr>
                {{-- @if($questionnaires->user_id == $user)
                <div class="section mb-3">
                    @foreach ($questionnaires->FormQue->FormSection as $formSection) 
                    
                    <input type="hidden" name="formQueID" value="{{  $questionnaires->FormQue->id }}">
                    <input type="hidden" name="appraisal_id" value="{{  $questionnaires->id }}">
                    <div class="sectionheading mb-3">
                        <h4>{{ $formSection->title }}</h4>
                    </div>
                    @foreach ($formSection->FormInput as $formInputs)   
                    <?php  //echo "<pre>"; print_r($formInputs->toArray());  ?>
                   @if($formInputs->InputType->name == 'input')
                    <div class="sectionlabel mb-3">
                            <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                            <input type="{{$formInputs->InputType->type}}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" class="form-control" placeholder="{{ $formInputs->placeholder }}">
                    </div>
                    @elseif($formInputs->InputType->name == 'textarea')
                    <div class="sectionlabel mb-3">
                        <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                        <textarea class="form-control" rows="3" name="{{ $formSection->sec_id}}[{{$formInputs->id}}]" placeholder="{{ $formInputs->placeholder }}"></textarea> 
                    </div>
                    @elseif($formInputs->InputType->name == 'radio')
                    <div class="label">
                    <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                    </div>
                    @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                    <div class="sectionlabel mb-3">
                        <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" >
                        <label class="form-check-label"  for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                    </div>
                    @endforeach
                    @elseif($formInputs->InputType->name == 'checkbox')
                    <div class="label">
                        <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                    </div>
                    @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                    <div class="sectionlabel mb-3">
                        <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" >
                        <label class="form-check-label" for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                    </div>
                    @endforeach
                    @elseif($formInputs->InputType->name == 'select')
                    <div class="sectionlabel mb-3">
                         <label class="form-label" for="{{ $formInputs->label }}" >{{ $formInputs->label }}</label>
                            <select  class="form-select"name="{{$formSection->sec_id}}[{{$formInputs->id}}]" id="">
                                @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                <option value="{{  $multipleInput->label }}">{{  $multipleInput->label }}</option>
                                @endforeach
                            </select>
                     </div>
                   @endif
                    @endforeach
                    <hr>
                    @endforeach
                </div>
                @elseif($questionnaires->manager_id == $user) --}}

                <div class="section mb-3">
                    @foreach ($questionnaires->FormQue->FormSection as $formSection) 
                    
                    <input type="hidden" name="formQueID" id="formQueID" value="{{  $questionnaires->FormQue->id }}">
                    <input type="hidden" name="appraisal_id" id="appraisal_id" value="{{  $questionnaires->id }}">
                    <div class="sectionheading mb-3">
                        <h4>{{ $formSection->title }}</h4>
                    </div>
                        @foreach ($formSection->FormInput as $formInputs)   
                                @if($formInputs->InputType->name == 'input')
                                    <div class="sectionlabel mb-3">
                                        <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                    </div>
                                    @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                                    <div class="mb-3 col-lg-12">
                                        <div class="readonly">
                                            <div class="innearcontainer">
                                                <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                                <p class="content"> {{ $quesData->que_employ_value }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-12">
                                        <div class="readonly">  
                                            <div class="innearcontainer">
                                                <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                                <p class="content">{{ $quesData->que_manager_value }}</p>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    @endif
                                @elseif($formInputs->InputType->name == 'textarea')
                                <div class="sectionlabel mb-3">
                                    <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                </div>
                                    @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                                        <div class="mb-3 col-lg-12">
                                            <div class="readonly">
                                                <div class="innearcontainer">
                                                    <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                                    <p class="content"> {{ $quesData->que_employ_value }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12">
                                            <div class="readonly">  
                                                <div class="innearcontainer">
                                                    <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                                    <p class="content">{{ $quesData->que_manager_value }}</p>
                                                </div>
                                            </div>
                                        </div>
                                     @endif
                                @elseif($formInputs->InputType->name == 'radio')
                                        <div class="label">
                                            <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                        </div>
                                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                                        <div class="mb-3 col-lg-12">
                                            <div class="readonly">
                                                <div class="innearcontainer">
                                                    <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                                    <p class="content"> {{ $quesData->que_employ_value }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-12">
                                            <div class="readonly">  
                                                <div class="innearcontainer">
                                                    <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                                    <p class="content">{{ $quesData->que_manager_value }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        {{-- @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                            <div class="sectionlabel mb-3">
                                                <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" value="{{$multipleInput->label}}">
                                                <label class="form-check-label"  for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                                            </div>
                                        @endforeach --}}
                                        
                                @elseif($formInputs->InputType->name == 'checkbox')
                                    <div class="label">
                                        <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                    </div>
                                    @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                                    <div class="mb-3 col-lg-12">
                                        <div class="readonly">
                                            <div class="innearcontainer">
                                                <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                                <p class="content"> {{ $quesData->que_employ_value }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-12">
                                        <div class="readonly">  
                                            <div class="innearcontainer">
                                                <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                                <p class="content">{{ $quesData->que_manager_value }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                    <div class="sectionlabel mb-3">
                                        <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}][]" value="{{$multipleInput->label}}">
                                        <label class="form-check-label" for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                                    </div>
                                    @endforeach --}}

                                @elseif($formInputs->InputType->name == 'select')
                                <div class="label">
                                    <label class="form-label" for="{{ $formInputs->label }}" >{{ $formInputs->label }}</label>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <div class="readonly">
                                        <div class="innearcontainer">
                                            <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                            <p class="content"> {{ $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()->que_employ_value }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <div class="readonly">  
                                        <div class="innearcontainer">
                                            <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                            <p class="content">{{ $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()->que_manager_value }}</p>
                                        </div>
                                    </div>
                                </div>

                                @elseif($formInputs->InputType->name == 'rating' || $formInputs->inputType->name == 'goal'  || $formInputs->inputType->name == 'competency' || $formInputs->inputType->name == 'responsibility'  || $formInputs->inputType->name == 'development')
                                <div class="label">
                                    <label class="form-label" for="{{ $formInputs->label }}" >{{ $formInputs->label }}</label>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <div class="readonly">
                                        @php $radingQuestionsData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first(); @endphp
                                        <div class="innearcontainer">
                                            <span class="name"> {{$questionnaires->User->name}} <span class="badge bg-secondary"> self</span> </span>
                                            <p class="content"> <span class="ratingEmp">{{ $radingQuestionsData?->que_self_rating }} </span> {{ $radingQuestionsData?->que_employ_value }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <div class="readonly">  
                                        <div class="innearcontainer">
                                            <span class="name"> {{$questionnaires->Manager->name}} <span class="badge bg-secondary"> Manager</span> </span>
                                            <p class="content"><span class="ratingManager">{{ $radingQuestionsData?->que_manager_rating }} </span>{{ $radingQuestionsData?->que_manager_value }}</p>
                                        </div>
                                    </div>
                                </div>
                                    <div class="">
                                        <div>
                                            @php $gap = $radingQuestionsData?->que_manager_rating - $radingQuestionsData?->que_self_rating ; @endphp
                                            <span> <b> Gap </b> </span>  <span class=" badge bg-warning text-dark p-1 totalGap">{{ $gap}}</span>
                                        </div>
                                        
                                    </div>
                                
                                    {{-- <div class="sectionlabel mb-3">
                                        <select  class="form-select"name="{{$formSection->sec_id}}[{{$formInputs->id}}]" id="">
                                            @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                            <option value="{{  $multipleInput->label }}">{{  $multipleInput->label }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}


                                @endif
                         @endforeach
                    @endforeach
                </div>
                {{-- @endif --}}
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('user.appraisal') }}" class="btn btn-light">Close</a>
                    </div>
                    @if($questionnaires->results_shared == 0)
                    <div>
                        <button class="btn btn-primary" type="button" onclick="shareResult(this)" >Share Result<i
                                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-js-script')
    <script>
        function shareResult(e)
        {
          var id =  $('#appraisal_id').val()
            url = "{{ route('user.appraisal.shareresult') }}";
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: 'post',
                url: url,
                data:{
                   'id':id,
                },
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        $('#formSubmit').find('.st_loader').hide();
                        window.location.replace("{{ route('user.appraisal') }}");
                    } else {
                        toastr.error("Find some error", 'Error');
                        $('#formSubmit').find('.st_loader').hide();
                    }


                },
                error: function(xhr, status, error) {
                    $('#formSubmit').find('.st_loader').hide();
                    var $err = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $err = $err + value + "<br>";
                    })
                    toastr.error($err, 'Error');
                }
            });
        }

        // function shareAppraisal(e)
        // {

        //     let route = "{{route('appraisal.pdf')}}";
        //     $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //     $.ajax({
        //         type: 'post',
        //         url: route,
        //         data:{
        //            'empperform':$('.empperfom').text(),
        //            'managerperfom':$('.managerperfom').text(),
        //            'totalrating':$('.totalrating').text(),
        //            'id':e
                   
        //         },
        //         success: function(response) {

        //         },
        //         error: function(xhr, status, error) {
        //             $('#formSubmit').find('.st_loader').hide();
        //             var $err = '';
        //             $.each(xhr.responseJSON.errors, function(key, value) {
        //                 $err = $err + value + "<br>";
        //             })
        //             toastr.error($err, 'Error');
        //         }
        //     });
        // }
        
    

        let sumEmp = 0;
        let sumManager = 0;
        let totalRating =0;

        let emp = $('.ratingEmp');
        let manager = $('.ratingManager');
           emp.each(function(){
            sumEmp +=  parseInt($(this).text());
           }); 
           manager.each(function(){
            sumManager +=  parseInt($(this).text());
           });
           $('.employPerform').text(sumEmp);
           $('.empperfom').val(sumEmp);
           $('.managerPerform').text(sumManager);
           $('.managerperfom').val(sumManager);
           totalRating = sumManager -sumEmp;
           $('.totalRating').text(totalRating);
           $('.totalrating').val(totalRating);
    </script>
@endsection
