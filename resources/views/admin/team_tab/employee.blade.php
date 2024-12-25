<div class="row my-4">
    <div class="col-md-3">
     <?php
     if(isset($uinfo->Image->file) && $uinfo->Image->file != ''){
         $image_url = url('/upload/employee/' . $uinfo->Image->file);
     }else{
         $image_url = url('upload/employee/demo.jpg');
     }
     ?>
     <img src="{{ $image_url }}" class="img-thumbnail" style="height: 160px; width: 185px;">
     

    </div>
    <div class="col-md-9 my-2"> 
     <h2 class="my-2" style="">{{ $uinfo->name }}</h2>
     <div class="my-1">
     <span class="card-text my-2"><i class="fa fa-phone" aria-hidden="true"></i>{{ $uinfo->phone_number }}</span>
     <span class=""><i class="fa fa-envelope" aria-hidden="true"></i>{{ $uinfo->email }}</span></div>

     
 </div>  
</div>    


<script>


function addForm(e) {
var contentUrl = "{{route('add_image')}}";
$.ajax({
 type: "GET",
 url: contentUrl,
 success: function(data) {
     $(".modal-body-data").html(data);
     $("#bs-example-modal-lg").modal("show");
 },
 error: function() {
     alert("Failed to load content.");
 }
});
}


function deleteRow(e){  

if(confirm('Are you sure you want to delete this?')){
$.ajax({     
url :"{{ route('imagedestroy') }}", 
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
method:"Get",  
data:{},
success: function(data,msg){ 
//  alert();
if (data.status == 1) {
toastr.success(data.msg, 'Success');
window.location.reload(true);
dataTable.draw(false);

} else if (data.status == 0) {

var $err = '';
toastr.error(data.msg, 'error');

}
 
},

}); 
}else{ 
return false; 
}
}


</script>