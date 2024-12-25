
<div class="card">
    <div class="card-header mt-3 border">
     <h3 class="breadcrumb-title">Personal Information</h3>
     </div>
 <div class="card-body">
     <div class="tab-content py-3">
         <div class="tab-pane fade show active" id="common_data" role="tabpanel">
             <div class="row">
              
                 <div class="col-md-3">
                     <strong>National ID Number</strong> <p class="text-primary">{{ $uinfo->national_id }}</p>
                 </div>
              
                 <div class="col-md-3">
                     <strong>Phone Number </strong> <p class="text-primary">{{ $uinfo->phone_number }}</p>
                 </div>
                
                 <div class="col-md-3">
                     <strong>Date of Birth</strong><p class="text-primary">{{ $dateOfBirth}} </p>
                 </div>
                 
                 <div class="col-md-3">
                     <strong>Gender</strong><p class="text-primary"> {{ $uinfo->gender }} </p>
                 </div>
             
                 <div class="col-md-3">
                     <strong>Nationality</strong> <p class="text-primary"> {{ @$uinfo->county?->name }} </p>
                 </div>

                 <div class="col-md-3">
                     <strong>Marital Status</strong> <p class="text-primary"> {{ $uinfo->marital_status }} </p>
                 </div>

                 <div class="col-md-3">
                     <strong>Data of Joining</strong>  <p class="text-primary"> {{ $startEmployment }} </p>
                 </div>
               
                 
              
             </div>
         </div>
     </div>
 </div>
</div>