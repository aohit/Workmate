 @extends('user.layouts.app')

 @section('content')
     {{-- <div class="container-fluid"> --}}
     <div class="card h-100">
         <div class="card-body">
             <div class="d-sm-flex">
                 <div class="mx-1">
                     <?php
                     if (isset($uinfo->Image->file) && $uinfo->Image->file != '') {
                         $image_url = url('/upload/employee/'. $uinfo->Image->file);
                     } else {
                         $image_url = url('upload/employee/demo.jpg');
                     }
                     ?>
                     <img src="{{ $image_url }}" class="rounded-circle img-thumbnail" style="height: 100px; width: 105px;">


                 </div>
                 <div class="my-1">
                     <h3 class="m-0 p-0" style="">{{ $uinfo->name }}</h3>
                     <div class="">
                         <span class="card-text m-0 p-0"><i class="fa fa-phone"
                                 aria-hidden="true"></i> {{ $uinfo->phone_number }}</span>
                         <span class=""><i class="fa fa-envelope" aria-hidden="true"></i> {{ $uinfo->email }}</span>
                     </div>
                     <span class="">{{ @$uinfo->department->name }}</span>
                 </div>

                 <div class="ms-auto">
                     <?php
                     $file_path = route('get.pdf');
                    //  $action = '<a class="btn btn-primary" href="' . $file_path . '" class="btn">Download Pdf <i class="fa fa-download" aria-hidden="true"></i></a>';
                    //  echo $action;
                     ?>
                 </div>
             </div>
         </div>

         <div class="container" id="second">
             <div class="h-100">
                 <ul class="nav nav-tabs item2" id="myTabs2" role="tablist">
                    <li class="nav-item">
                         <a class="nav-link active" id="tab11-tab" href="{{ route('my_goals',base64_encode($uinfo->id)) }}" data-target="#tab11"
                             role="tab" aria-controls="tab11" aria-selected="true">GOALS</a>

                     </li>
                     <li class="nav-item">
                          <a class="nav-link" id="tab22-tab" href="{{ route('goal.competencies',['id' => base64_encode($uinfo->id) ]) }}" data-target="#tab22"
                             role="tab" aria-controls="tab22" aria-selected="false">COMPETENCIES</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="tab33-tab" href="{{ route('goal.responsibility',['id' => base64_encode($uinfo->id) ]) }}" data-target="#tab33"
                             role="tab" aria-controls="tab33" aria-selected="false">RESPONSIBILITY</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="tab44-tab" href="{{ route('goal.development',['id' =>base64_encode($uinfo->id) ]) }}" data-target="#tab44"
                             role="tab" aria-controls="tab44" aria-selected="false">DEVELOPMENT</a>
                     </li>
                 </ul>
                 <div class="profile-bottom" id="myTabsContent2">
                     <div class="tab-info fade" id="tab11" aria-labelledby="tab11-tab"></div>
                     <div class="tab-info fade" id="tab22" aria-labelledby="tab22-tab"></div>
                     <div class="tab-info fade" id="tab33" aria-labelledby="tab33-tab"></div>
                     <div class="tab-info fade" id="tab44" aria-labelledby="tab44-tab"></div>
                 </div>
             </div>
         </div>
     </div>
 @endsection

 @section('page-js-script')
     <script>
         $(document).ready(function() {
             function openTab(routeName, tabId) {
                 $.ajax({
                     url: routeName,
                     type: 'GET',
                     success: function(data) {
                         $('#myTabsContent2 .tab-info').html('').removeClass('show active');
                         $(tabId).html(data).addClass('show active');
                         // console.error(tabId);
                         // console.error(data);
                     },
                     error: function(xhr, status, error) {
                         console.error(error);
                     }
                 });
             }
             $('#myTabs2 a').click(function(e) {
                 e.preventDefault();
                 var tabId = $(this).attr('data-target');
                 var href = $(this).attr('href');

                 openTab(href, tabId);
                 $('#myTabs2 a').removeClass('active');
                 $(this).addClass('active');

                 localStorage.setItem('active', tabId);
             });
             var active = localStorage.getItem('active');

             if (active) {
                 $(active).load('{{ route('my_goals',base64_encode($uinfo->id)) }}');
                 $(active).addClass('show active');
             } else {
                 $('#tab11').load('{{ route('my_goals',base64_encode($uinfo->id) ) }}');
                 $('#tab11').addClass('show active');
             }

         });
     </script>
 @endsection