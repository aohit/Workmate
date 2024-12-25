






<div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
         <div class="card-body"> 
         
<div class="container">
  
  <div class="tab-content" id="myTabsContent">
      <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab2-tab">
         <h1> Content of Tab 1</h1>
      </div>
  </div>
</div>

</div>
</div> <!-- end row -->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('.nav-link').on('click', function(){
            var tabId = $(this).attr('href');
            $.ajax({
                url: '/getTabContent', 
                type: 'GET',
                data: { tab_id: tabId }, 
                success: function(response){
                    $(tabId).html(response); 
                }
            });
        });
    });
</script>
