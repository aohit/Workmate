 <form id="formSubmit" onsubmit="formSubmit(this);return false;"> 
     <input type="hidden" name="performance_id" value="{{$performance->id}}">
     @csrf
     @php $goalCategory = config('constants.goalCategory'); @endphp
     @php $goalStatus = config('constants.goalStatus'); 
     
     @endphp
     
     @if(!empty($goal))
     
     <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Goal</label>
                            <input type="text" class="form-control"placeholder="Title" name="title" value="{{$goal->title}}"/>
                        </div>  
                        <div class="mb-3 col-lg-6">
                           <label for="validationCustom02" class="form-label">Category</label>
                           <select class="form-select" name="category"> 
                               <option value="">--Select--</option>
                              @foreach($goalCategory as $catKey => $catVal)
                              <option value="{{$catKey}}" @if($goal->category_id == $catKey) selected @endif>{{$catVal}}</option>
                              @endforeach
                           </select>
                       </div>  
                    </div>
                    <div class="row">
                       <div class="mb-3 col-lg-12">
                           <label for="validationCustom01" class="form-label">Description</label>
                           <textarea type="text" class="form-control"placeholder="Description" name="description" >{{$goal->description}}</textarea>
                       </div>  
                   </div>
                   <div class="row">
                       <div class="mb-3 col-lg-6">
                           <label for="validationCustom01" class="form-label">Due Date</label>
                           <input type="text" class="form-control basic-datepicker"placeholder="Due Date" name="due_date" value="{{$goal->due_date}}"/>
                       </div>  
                       <div class="mb-3 col-lg-6">
                           <label for="validationCustom02" class="form-label">Status</label>
                           <select class="form-select" name="status"> 
                               <option value="">--Select--</option>
                               @foreach($goalStatus as $goalKey => $goalVal)
                               <option value="{{$goalKey}}" @if($goal->status == $goalKey) selected @endif>{{$goalVal}}</option>
                               @endforeach
                           </select>
                      </div>  
                   </div>
                    <div class="mt-3 col-lg-12">
                        @if($performance->status == 1)
                        <button class="btn btn-primary" type="submit">Save<i
                                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end row -->
    @else
    <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Goal</label>
                            <input type="text" class="form-control"placeholder="Title" name="title" />
                        </div>  
                        <div class="mb-3 col-lg-6">
                           <label for="validationCustom02" class="form-label">Category</label>
                           <select class="form-select" name="category"> 
                               <option value="">--Select--</option>
                               @foreach($goalCategory as $catKey => $catVal)
                              <option value="{{$catKey}}">{{$catVal}}</option>
                              @endforeach
                           </select>
                       </div>  
                    </div>
                    <div class="row">
                       <div class="mb-3 col-lg-12">
                           <label for="validationCustom01" class="form-label">Description</label>
                           <textarea type="text" class="form-control"placeholder="Description" name="description" ></textarea>
                       </div>  
                   </div>
                   <div class="row">
                       <div class="mb-3 col-lg-6">
                           <label for="validationCustom01" class="form-label">Due Date</label>
                           <input type="text" class="form-control basic-datepicker"placeholder="Due Date" name="due_date" />
                       </div>  
                       <div class="mb-3 col-lg-6">
                           <label for="validationCustom02" class="form-label">Status</label>
                           <select class="form-select" name="status"> 
                               <option value="">--Select--</option>
                               @foreach($goalStatus as $goalKey => $goalVal)
                               <option value="{{$goalKey}}">{{$goalVal}}</option>
                               @endforeach
                           </select>
                      </div>  
                   </div>
                    <div class="mt-3 col-lg-12">
                        @if($performance->status == 1)
                        <button class="btn btn-primary" type="submit">Save<i
                                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end row -->
     @endif

 </form>

 <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
 <script>
     function formSubmit(e) {
          
         
             $('#formSubmit').find('.st_loader').show();
             event.preventDefault();
             var formData = new FormData($('#formSubmit')[0]);
             $.ajax({
                 type: 'POST',
                 url: "{{ route('performance.review.goal.update') }}",
                 data: formData,
                 contentType: false,
                 processData: false,
                 success: function(response) {
                     if (response.success == 1) {
                         toastr.success(response.message, 'Success');
                         window.setTimeout(function() {
                             $('#formSubmit').find('.st_loader').hide(); 
                         }, 500);
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
 