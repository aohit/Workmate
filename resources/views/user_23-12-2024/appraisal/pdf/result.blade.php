<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Appraisal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .gap-badge {
            background-color: #ffc107;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .comment-box {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .comment-header {
            font-weight: bold;
        }
        .comment-self::before, .comment-manager::before {
            content: ' ';
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #6c757d;
            margin-right: 5px;
            border-radius: 50%;
        }
        .comment-self::before {
            background-color: #007bff;
        }
        .comment-manager::before {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="mt-4">Performance Appraisal:{{ $questionnaires->FormQue->title  }}</h3>
        <div class="row mt-4">
            <div class="col-md-2 text-center">
                <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-8.jpg') }}" alt="Profile Image" class="profile-img">
            </div>
            <div class="col-md-5">
                <p><strong>Name:</strong> {{ $questionnaires->User->name}}</p>
                <p><strong>Manager Name:</strong> {{ $questionnaires->Manager->name}}</p>
                <p><strong>Review cycle:</strong> {{ $questionnaires->reviewcycle->title }} ( {{$questionnaires->reviewcycle->start_date}}  to{{ $questionnaires->reviewcycle->end_date }} )</p>
            </div>
            <div class="col-md-5">
                <p>Result  {{ ($questionnaires->results_shared == 0) ? 'Not':'' }} has been shared with  {{ $questionnaires->User->name}}</p>
                <p>Self-review submitted on date {{$questionnaires->self_review_submited}}.</p>
                <p>Manager review submitted on date {{$questionnaires->manager_review_submited}}.</p>
            </div>
        </div>

        <hr>

        <table class="table table-bordered mt-4">
            <thead class="thead-light">
                <tr>
                    <th>Performance Competencies</th>
                    <th>Self</th>
                    <th>Manager</th>
                    <th>Gap</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Performance Competencies</td>
                    <td>{{$empperfom}}</td>
                    <td>{{ $managerperfom }}</td>
                    <td><span class="gap-badge">{{ $totalrating }}</span></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{$empperfom}}</td>
                    <td>{{ $managerperfom }}</td>
                    <td><span class="gap-badge">{{ $totalrating }}</span></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <h4>Company Values</h4>
        <ul>
            <li><strong>Accountability</strong> - Assume responsibility for actions, products, decisions and policies.</li>
            <li><strong>Commitment</strong> - Commit to deliver great products and outstanding service.</li>
            <li><strong>Innovation</strong> - Pursue new creative ideas that have the potential to change the world.</li>
            <li><strong>Integrity</strong> - Act with honesty and honor without compromising the truth. Keep your word.</li>
            <li><strong>Ownership</strong> - Take care of the company and customers as they were your own.</li>
        </ul>
        <p>See our company's values, vision and mission statement here: <a href="http://example.com/values">http://example.com/values</a></p>

        <hr>
        @foreach ($questionnaires->FormQue->FormSection as $formSection) 
            <h4>{{ $formSection->title }}</h4>
                @foreach ($formSection->FormInput as $formInputs)
                    @if($formInputs->InputType->name == 'input')
                        <h5>{{ $formInputs->label }}</h5>
                            @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                                <div class="comment-box">
                                    <div class="comment-header">
                                        <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                    </div>
                                    <p>{{ $quesData->que_employ_value }}</p>
                                </div>
                                <div class="comment-box">
                                    <div class="comment-header">
                                        <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                    </div>
                                    <p>{{ $quesData->que_manager_value }}</p>
                                </div>
                            @endif
                    @elseif($formInputs->InputType->name == 'textarea')
                        <h5>{{ $formInputs->label }}</h5>
                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                </div>
                                <p>{{ $quesData->que_employ_value }}</p>
                            </div>
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                </div>
                                <p>{{ $quesData->que_manager_value }}</p>
                            </div>
                        @endif
                    @elseif($formInputs->InputType->name == 'radio')
                    <h5>{{ $formInputs->label }}</h5>
                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                </div>
                                <p>{{ $quesData->que_employ_value }}</p>
                            </div>
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                </div>
                                <p>{{ $quesData->que_manager_value }}</p>
                            </div>
                        @endif
                    @elseif($formInputs->InputType->name == 'checkbox')
                        <h5>{{ $formInputs->label }}</h5>
                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                </div>
                                <p>{{ $quesData->que_employ_value }}</p>
                            </div>
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                </div>
                                <p>{{ $quesData->que_manager_value }}</p>
                            </div>
                        @endif
                    @elseif($formInputs->InputType->name == 'select')
                        <h5>{{ $formInputs->label }}</h5>
                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                </div>
                                <p>{{ $quesData->que_employ_value }}</p>
                            </div>
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                </div>
                                <p>{{ $quesData->que_manager_value }}</p>
                            </div>
                        @endif

                    @elseif($formInputs->InputType->name == 'rating')
                        <h5>{{ $formInputs->label }}</h5>
                        @if(!empty($quesData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first()))
                        @php $radingQuestionsData = $formInputs->questionnairesData->where('appraisal_id',$questionnaires->id)->first(); @endphp
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-self">{{$questionnaires->User->name}}</span> (Self)
                                </div>
                                <p>{{ $radingQuestionsData->que_self_rating }}  {{ $quesData->que_employ_value }}</p>
                            </div>
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-manager"> {{$questionnaires->Manager->name}}</span> (Manager)
                                </div>
                                <p>{{ $radingQuestionsData->que_manager_rating }} {{ $quesData->que_manager_value }}</p>
                            </div>
                            <div class="mt-4">
                                @php $gap =   $radingQuestionsData->que_self_rating - $radingQuestionsData->que_manager_rating; @endphp
                               Gap <span class="gap-badge">{{ $gap}}</span>
                            </div>
                        @endif

                    @endif

                @endforeach  
        @endforeach 
    </div>
</body>
</html>
