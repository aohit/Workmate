
<div class="card">
    <div class="card-header mt-3 border">
     <h3 class="breadcrumb-title">Personal Information</h3>
     </div>
 <div class="card-body">
     <div class="tab-content py-3">
         <div class="tab-pane fade show active" id="common_data" role="tabpanel">
             <div class="row">
              
                 <div class="col-md-3">
                     <strong>Email</strong> <p class="text-primary">{{ $uinfo->email }}</p>
                 </div>
              
                 <div class="col-md-3">
                     <strong>Phone Number </strong> <p class="text-primary">{{ $uinfo->phone_number }}</p>
                 </div>
                
             </div>
         </div>
     </div>
 </div>
</div>