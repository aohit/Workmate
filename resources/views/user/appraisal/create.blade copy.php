@extends('user.layouts.app')

@section('content')
    <div class="container-fluid p-2">
        <div class="card">
            <div class="card-body ">
                <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                    @csrf
                    <div class="row">
                        <h4>Performance Appraisal: Self-Review</h4>
                        <div class="col-sm-6 p-3">
                            <div class="row">
                                <div class="col-sm-3">
                                 <img src="{{ asset('assets/images/users/user-8.jpg') }}" style="width: 85px" class="rounded-circle" alt="">
                                </div>
                                <div class="col-sm-9">
                                    <p class="m-0">name user</p>
                                    <span> Manager Name:</span> <span> Test Name</span><br>
                                    <span> Review cycle :</span> (<span>test cycle </span>)
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 p-3 border-start">
                            <p>Please complete the questionnaire below and use the Submit
                                button to send your final responses. You can use the Save Draft
                                button to save the questionnaire in its current state and come
                                back later to complete it.</p>
                        </div>

                        <div class="companyvalues">
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
                        <hr>
                        <input type="hidden" name="appraisal_id" id="" value="{{ $appraisal_id }}">
                        <h4>Job definition</h4>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label">Current position description; if applicable,
                                make note of any significant changes since last year’s performance review.</label>
                            <textarea name="current_position" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->current_position }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> If performance goals were set at the last
                                performance review, add here a copy of those goals and comment on the progress.</label>
                            <textarea name="performance_goals" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->performance_goals }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <h4> Performance Competencies </h4>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label">Possesses skills and knowledge to perform the
                                job competently.</label>
                            <div class="row">
                                <input type="radio" id="html" name="skill_and_knowledge" checked value="0">
                                <label for="html" class="form-label">Need Improvement</label><br>
                                <input type="radio" id="css" name="skill_and_knowledge" value="1">
                                <label for="css" class="form-label">Below Expecation </label><br>
                                <input type="radio" id="javascript" name="skill_and_knowledge" value="2">
                                <label for="javascript" class="form-label">Meets Expectations</label>
                                <input type="radio" id="javascript" name="skill_and_knowledge" value="3">
                                <label for="javascript" class="form-label">Exceeds Expection</label>
                                <input type="radio" id="javascript" name="skill_and_knowledge" value="4">
                                <label for="javascript" class="form-label"> Exceptionl</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> Communicates effectively with supervisor,
                                peers, and customers. </label>
                            <div class="row">
                                <input type="radio" id="html" name="communicates_effectively" checked value="0">
                                <label for="html" class="form-label">Need Improvement</label><br>
                                <input type="radio" id="css" name="communicates_effectively" value="1">
                                <label for="css" class="form-label">Below Expecation </label><br>
                                <input type="radio" id="javascript" name="communicates_effectively" value="2">
                                <label for="javascript" class="form-label">Meets Expectations</label>
                                <input type="radio" id="javascript" name="communicates_effectively" value="3">
                                <label for="javascript" class="form-label">Exceeds Expection</label>
                                <input type="radio" id="javascript" name="communicates_effectively" value="4">
                                <label for="javascript" class="form-label"> Exceptionl</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> Holds self accountable for assigned
                                responsibilities; sees tasks through to completion in a timely manner. </label>
                            <div class="row">
                                <input type="radio" id="html" name="assigned_responsibilities" checked
                                    value="0">
                                <label for="html" class="form-label">Need Improvement</label><br>
                                <input type="radio" id="css" name="assigned_responsibilities" value="1">
                                <label for="css" class="form-label">Below Expecation </label><br>
                                <input type="radio" id="javascript" name="assigned_responsibilities" value="2">
                                <label for="javascript" class="form-label">Meets Expectations</label>
                                <input type="radio" id="javascript" name="assigned_responsibilities" value="3">
                                <label for="javascript" class="form-label">Exceeds Expection</label>
                                <input type="radio" id="javascript" name="assigned_responsibilities" value="4">
                                <label for="javascript" class="form-label"> Exceptionl</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> Comments on performance competencies:
                            </label>
                            <textarea name="comments_on_performance" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->comments_on_performance }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <h4>Goal Setting and Development Planning</h4>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> Performance goals for the coming year:
                            </label>
                            <textarea name="future_goals" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->future_goals }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> Development goals for the coming year:
                            </label>
                            <textarea name="future_dev_goals" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->future_dev_goals }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> How do these align with departmental
                                goals? </label>
                            <textarea name="align_department_goals" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->align_department_goals }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <h4>Performance Summary</h4>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> List aspects of employee’s performance
                                that require improvement for greater effectiveness. </label>
                            <textarea name="employ_performance_improvement" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->employ_performance_improvement }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom01" class="form-label"> List all aspects of employee’s performance
                                that contribute to his or her effectiveness. </label>
                            <textarea name="employ_performance_contribute" id="" class="form-control" rows="5"></textarea>
                        </div>
                        @if (!empty($questionnaire))
                            <div class="mb-3 col-lg-12">
                                <div class="readonly">
                                    <div class="innearcontainer">
                                        <span class="name"> {{ $questionnaire?->username->name }} <span
                                                class="badge bg-secondary"> self</span> </span>
                                        <p class="content"> {{ $questionnaire?->employ_performance_contribute }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <h4>Overall performance rating.</h4>
                        <div class="row">
                            <input type="radio" id="html" name="performance_rating" checked value="0">
                            <label for="html" class="form-label">Far Below Expectations</label><br>
                            <input type="radio" id="css" name="performance_rating" value="1">
                            <label for="css" class="form-label">Below Expectations </label><br>
                            <input type="radio" id="javascript" name="performance_rating" value="2">
                            <label for="javascript" class="form-label">Meets Expectations</label>
                            <input type="radio" id="javascript" name="performance_rating" value="3">
                            <label for="javascript" class="form-label">Above Expectations</label>
                            <input type="radio" id="javascript" name="performance_rating" value="4">
                            <label for="javascript" class="form-label"> Far Above Expectations</label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('user.appraisal') }}" class="btn btn-light">Close</a>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Save<i
                                    class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                    style="display:none;"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page-js-script')
    <script>
        function formSubmit(e) {
            url = "{{ route('user.appraisal.store') }}";
            $('#formSubmit').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmit')[0]);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
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
