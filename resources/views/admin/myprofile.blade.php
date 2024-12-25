@extends('admin.layouts.app')

@section('content')

    
             <div class="container">
  <div class="row">
    <div class="col-12">
       <div class="card h-100">
          <div class="card-body">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                   <li class="nav-item">
                      <a class="nav-link one active" id="tab1-tab"  data-tabName ="profile" data-target="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Employees</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" id="tab2-tab"  data-tabName ="skills"   data-target="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Skills</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" id="tab3-tab"   data-tabName ="education"  data-target="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Wages & Benefits</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" id="tab4-tab"   data-tabName ="certificate"  data-target="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Certificate</a>
                   </li>
                   <!--<li class="nav-item">-->
                   <!--   <a class="nav-link" id="tab5-tab"   data-tabName ="language"  data-target="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Language</a>-->
                   <!--</li>-->
                   <!--<li class="nav-item">-->
                   <!--   <a class="nav-link" id="tab6-tab"   data-tabName ="dependents"  data-target="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Dependents</a>-->
                   <!--</li>-->
                   <li class="nav-item">
                      <a class="nav-link" id="tab7-tab"   data-tabName ="emergency"  data-target="#tab7" role="tab" aria-controls="tab7" aria-selected="false">Emergency Contact</a>
                   </li>
                </ul>
                <div class="tab-content" id="myTabsContent">
                   <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"></div>
                   <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab"></div>
                   <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab"></div>
                   <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab"> </div>
                   <!--<div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab"> </div>-->
                   <!--<div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab"> </div>-->
                   <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-tab"> </div>
                </div>
             </div>
             <div class="container" id="second">
                <div class="h-100" >
                   <ul class="nav nav-tabs item2" id="myTabs2" role="tablist">
                      <li class="nav-item">
                         <a class="nav-link active" id="tab11-tab"  data-tab_ID ="basic_info" data-target="#tab11" role="tab" aria-controls="tab11" aria-selected="true">Basic Information</a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link" id="tab22-tab"  data-tab_ID ="login_info" data-target="#tab22" role="tab" aria-controls="tab22" aria-selected="false">Login info</a>
                      </li>
                   </ul>
                   <div class="profile-bottom" id="myTabsContent2">
                      <div class="tab-info fade" id="tab11"  aria-labelledby="tab11-tab"></div>
                      <div class="tab-info fade" id="tab22"  aria-labelledby="tab22-tab"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

@endsection
 
@section('page-js-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  $(document).ready(function() {   
  function loadTabContent(tabname, targetTab) {
    var href = "{{ route('admin.team.profile.tabs') }}";
    $.ajax({
      url: href,
      method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            tab: tabname ,
            team_emp_id:{{ $team_emp_id }}
        },
      success: function(data) {
        $('#myTabsContent .tab-pane').html('').removeClass('show active');
        $(targetTab).html(data).addClass('show active');
      },
      error: function(error) {
      //   console.error(error);
      }
    });
  }
  $('#myTabs a').click(function(e) {
    e.preventDefault();
    var targetTab = $(this).attr('data-target');
    var tabname = $(this).attr('data-tabname');
    var href = $(this).attr('href');

    loadTabContent(tabname, targetTab);
    $('#myTabs a').removeClass('active');
    $(this).addClass('active');

    localStorage.setItem('activeTab', targetTab);
  });

  var activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
   //  $(activeTab).load('{{ route("employee_profile") }}');
    $(activeTab).addClass('show active');
  } else {
   //  $('#tab1').load('{{ route("employee_profile") }}');
  }
});




$(document).ready(function() {
       function openTab(tabname, tabId) {
         var href = "{{ route('admin.team.profile.tabs') }}";
         $.ajax({
            url: href,
            method: 'POST',
            data: {
                  _token: '{{ csrf_token() }}',
                  tab: tabname ,
                  team_emp_id:{{ $team_emp_id }}
            },
           success: function(data) {
                        $('#myTabsContent2 .tab-info').html('').removeClass('show active');
                        $(tabId).html(data).addClass('show active');
                        // console.log(tabId);
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
    var tabname = $(this).attr('data-tab_ID');

    openTab(tabname, tabId);
    $('#myTabs2 a').removeClass('active');
    $(this).addClass('active');

    localStorage.setItem('active', tabId);
  });
  var active = localStorage.getItem('active');

  if (active) {
         //  $(active).load('{{ route("basic_info") }}');
                $(active).addClass('show active');
            } else {
                
                $('#tab11').addClass('show active');
            }
  
  });

    $(document).ready(function(){
      $('#myTabs .nav-link').click(function(){
        var target = $(this).attr('data-target'); 
        $('.tab-info').removeClass('show active'); 
        // alert('RR');
        $('.item2').hide(); 
        $(target).addClass('show active');
        // console.error(target);
      //   console.error(target);
      });

      $('#myTabs .one').click(function(){
        $('.tab-info').addClass('show active'); 
        $('.item2').show();
      });

      $('#myTabs .one').click();
      $('#myTabs2 .active').click();
    });


</script>
@endsection