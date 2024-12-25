 @extends('admin.layouts.app')

 @section('content')
     {{-- <div class="container-fluid"> --}}
     <div class="card h-100">
         <div class="container mt-2" id="second">
             <div class="h-100">
                 <ul class="nav nav-tabs item2" id="myTabs2" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link active" id="tab11-tab" href="{{ route('admin.my_goals') }}" data-target="#tab11"
                             role="tab" aria-controls="tab11" aria-selected="true">GOALS</a>

                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="tab22-tab" href="{{ route('admin.goal.competencies') }}" data-target="#tab22"
                             role="tab" aria-controls="tab22" aria-selected="false">COMPETENCIES</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="tab33-tab" href="{{ route('admin.goal.responsibility') }}" data-target="#tab33"
                             role="tab" aria-controls="tab33" aria-selected="false">RESPOSIBILITY</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" id="tab44-tab" href="{{ route('admin.goal.development') }}" data-target="#tab44"
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
                 $(active).load('{{ route('admin.my_goals') }}');
                 $(active).addClass('show active');
             } else {
                 $('#tab11').load('{{ route('admin.my_goals') }}');
                 $('#tab11').addClass('show active');
             }

         });
     </script>
 @endsection