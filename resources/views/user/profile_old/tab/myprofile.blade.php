@extends('user.layouts.app')

@section('content')

<div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
         <div class="card-body"> 
             {{-- <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Employees</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Skills</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Education</button>
    <button class="nav-link" id="nav-certificate-tab" data-bs-toggle="tab" data-bs-target="#nav-certificate" type="button" 
    role="tab" aria-controls="nav-certificate" aria-selected="false">Certificate</button>
    <button class="nav-link" id="nav-language-tab" data-bs-toggle="tab" data-bs-target="#nav-language" type="button" 
    role="tab" aria-controls="nav-language" aria-selected="false">Language</button>
    <button class="nav-link" id="nav-dependents-tab" data-bs-toggle="tab" data-bs-target="#nav-dependents" type="button" 
    role="tab" aria-controls="nav-dependents" aria-selected="false">Dependents</button>
    <button class="nav-link" id="nav-emergency-tab" data-bs-toggle="tab" data-bs-target="#nav-emergency" type="button" 
    role="tab" aria-controls="nav-emergency" aria-selected="false">Emergency Contacts</button>
  </div>
</nav> --}}

{{-- <div class="tab-content" id="nav-tabContent"> --}}

  {{-- <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> --}}
   
           
    {{-- <div class="col-3"> --}}
    {{-- <div class="card"> --}}
        {{-- <div class="card-body text-center"> --}}
        {{-- <div class="row">
           <div class="col-3">
            <img  src="{{ asset('upload/employee/demo.png') }}" class="mb-2 w-100 h-100" style="">
           </div>
           <div class="col-9">
            <p class="card-text text-dark my-2" style="">{{ $uinfo->name }}</p>
            <p class="card-text my-2">{{ $uinfo->email }}</p>
            <p class="card-text"><span class="text-dark" ></span></p>
            <a href="javascript:void(0);" class="btn btn-success" >
            <i class="bx bxs-plus-square"></i>Edit</a>
           <a href="" class="btn btn-primary" >
            <i class="bx bxs-plus-square"></i>Delete</a>            
        </div>  
    </div>     --}}
        {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    

{{-- </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Skills</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Education</div>
  <div class="tab-pane fade" id="nav-certificate" role="tabpanel" aria-labelledby="nav-certificate-tab">Certificate</div>
  <div class="tab-pane fade" id="nav-language" role="tabpanel" aria-labelledby="nav-language-tab">Language</div>
  <div class="tab-pane fade" id="nav-dependents" role="tabpanel" aria-labelledby="nav-dependents-tab">Dependents</div>
  <div class="tab-pane fade" id="nav-emergency" role="tabpanel" aria-labelledby="nav-emergency-tab">Emergency Contacts</div>
</div> --}}

          

     

{{-- </div>
</div> --}}


<div class="container">
  <ul class="nav nav-tabs" id="myTabs" role="tablist">
      <li class="nav-item">
          <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="{{ route('employee_profile') }}" data-target="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Tab 1</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="tab2-tab" data-toggle="tab" href="{{ route('employee_skills') }}" data-target="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Tab 2</a>
      </li>
  </ul>
  <div class="tab-content" id="myTabsContent">
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
          <!-- Content of Tab 1 will be loaded dynamically -->
      </div>
      <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
          <!-- Content of Tab 2 will be loaded dynamically -->
      </div>
  </div>
</div>


</div>
</div> <!-- end row -->

</div>

@endsection
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      
        $('#tab1').load('{{ route("employee_profile") }}');
  
        $('#myTabs a').click(function(e) {
            e.preventDefault();
            var targetTab = $(this).attr('data-target');
            var href = $(this).attr('href');
            $(targetTab).load(href);
            $(this).tab('show');
        });
    });


    $(document).ready(function() {
      
      $('#tab1').load('{{ route("employee_skills") }}');

      $('#myTabs a').click(function(e) {
          e.preventDefault();
          var targetTab = $(this).attr('data-target');
          var href = $(this).attr('href');
          $(targetTab).load(href);
          $(this).tab('show');
      });
  });
  </script>