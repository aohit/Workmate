@extends('admin.layouts.app')

@section('content')

    <div class="card">
      <div class="card-body">
          <form id="formSubmit" onsubmit="formSubmit(this);return false;">
              @csrf
              <div class="form-group row">
                  <label for="inputPassword" class="col-md-3 col-form-label">Questionnaire Name:</label>
                  <div class="col-md-9">
                      <input type="text" class="form-control form_heading" placeholder="Enter Questionnaire Label" name="section[]">
                  </div>
              </div>
              <section id="section">
                  <div class="d-flex justify-content-end mt-2">
                      <button type="button" onclick="addsection(this)" class="btn btn-primary mb-2 text-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</button>
                  </div>
                  <div class="border multipleSections p-3">
                      <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Category :</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control formSection" placeholder="Enter Questionnaire Section"  name="section[1][sec{{time()}}][]">
                          </div>
                      </div>
                      <div class="row mt-2 inputs">
                          <div class="col-sm-12 text-end">
                              <button type="button" onclick="addInput(this);return false;" class="btn btn-primary mb-2 text-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Inputs</button>
                          </div>
                      </div>

                  </div>
              </section>
              <div class="row mt-3">
                    <div  class="mb-3 col-sm-6 d-flex  justify-content-sm-start justify-content-end">
                        <a href="{{ route('admin.questionnaire') }}" class="btn btn-primary">Back</a>
                    </div>
                  <div class="mb-3 col-sm-6 d-flex justify-content-end">
                      <button class="btn btn-primary" type="">Save<i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                  </div>
              </div>
          </form>
      </div>
  </div>
@endsection
@section('page-js-script')
<script>

  function addsection(e) {
        var section = $(e).parents('div').find('.multipleSections').first().clone();
        var currentTime = Math.floor(Date.now() / 1000);
        section.find('input').attr('name', 'section[1][sec' + currentTime + '][]');
        section.find('.inputs').html();
        section.find('.dynamicInput').html('');
        section.find(".exampleDiv").remove();

        var newSection = '<div class="border multipleSections p-3 mt-1">' +
            '<div class="d-flex justify-content-end">' +
            '<button type="button" onclick="removesection(this)" class="btn btn-danger mb-2 text-right"><i class="fa fa-minus" aria-hidden="true"></i></button>' +
            '</div>' +
            section.html() +
            '</div>';
        $(e).parents('div').find('.multipleSections').last().after(newSection);
    }

    function removesection(e){
      var parentDiv = e.closest('.multipleSections');
    parentDiv.remove();
  }

function addInput(e) {
   var contentUrl = "{{route('admin.questionnaire-addInput')}}";

   var currentTimestamp = Math.floor(Date.now() / 1000);
   var formHeading = $('.form_heading').val();
   var formSection = $(e).closest('.multipleSections').find('.formSection').val();
   if ((formHeading.trim() !== '') && (formSection.trim() !== '')) {
      var inputName = $(e).closest('.multipleSections').find('input[name^="section"]').attr('name');
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $.ajax({
  
       type: "POST",
       url: contentUrl,
       data:{
        'time':inputName,
        'formHeading':formHeading,
        'formSection':formSection,
       },
       success: function(data) {
           $(".modal-body-data").html(data);
           $("#bs-example-modal-lg").modal("show");
       },
       error: function() {
           alert("Failed to load content.");
       }
   });
  }else{
    alert("Form Field can not be empty!")
  }
}

function formSubmit(e) {
  var formHeading = $('.form_heading').val();
  //  var formSection = $(e).closest('.multipleSections').find('.formSection').val();
   var formSection = $(e).find('.multipleSections').find('.formSection').val();
 
   if ((formHeading.trim() !== '') && (formSection.trim() !== '')) {
   $('#formSubmit').find('.st_loader').show(); 
   event.preventDefault();
   var formData = new FormData($('#formSubmit')[0]);
   $.ajax({
       type: 'POST',
       url: "{{ route('admin.questionnaire-stor') }}",
       data: formData,
       contentType: false,
       processData: false,
       success: function(response) {  
           if(response.success == 1){
              //  table.ajax.reload(); 
              //  toastr.success(response.message, 'Success');
               toastr.success("Inserted successfully.", 'Success'); 
               location.reload(true);
           }else{
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
  }else{
    alert("Form Field can not be empty!")
  }
}


</script>
@endsection
