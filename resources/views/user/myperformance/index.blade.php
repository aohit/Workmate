@extends('user.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab"
                                        href="{{ route('pending_task') }}" data-target="#tab1" role="tab"
                                        aria-controls="tab1" aria-selected="true">Pending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" data-toggle="tab"
                                        href="{{ route('completed_task') }}" data-target="#tab2" role="tab"
                                        aria-controls="tab2" aria-selected="false">Completed</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3-tab" data-toggle="tab"
                                        href="{{ route('disciplinary_action') }}" data-target="#tab3" role="tab"
                                        aria-controls="tab3" aria-selected="false">Disciplinary Action</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabsContent">
                                <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"></div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab"> </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @section('page-js-script')
            {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
            <script>
                $(document).ready(function() {

                    function loadTabContent(href, targetTab) {

                        $.ajax({
                            url: href,
                            type: 'GET',
                            success: function(data) {
                                $('#myTabsContent .tab-pane').html('').removeClass('show active');
                                $(targetTab).html(data).addClass('show active');
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }

                    $('#myTabs a').click(function(e) {
                        e.preventDefault();
                        var targetTab = $(this).attr('data-target');
                        var href = $(this).attr('href');

                        loadTabContent(href, targetTab);
                        $('#myTabs a').removeClass('active');
                        $(this).addClass('active');

                        localStorage.setItem('activeTab', targetTab);
                    });

                    var activeTab = localStorage.getItem('activeTab');
                    if (activeTab) {
                        $(activeTab).load('{{ route('pending_task') }}');
                        $(activeTab).addClass('show active');
                    } else {
                        $('#tab1').load('{{ route('pending_task') }}');
                    }
                });
            </script>
        @endsection
