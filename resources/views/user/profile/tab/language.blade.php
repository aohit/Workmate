<div class="card">
            
    <!-- /.card-header -->
    {{-- <div class="card-body">	 --}}
    <form id="user_table">	
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-hover">
        <thead>
        <tr>
         <th>S.No.</th>
          <th>Name</th>
          <th>Language</th>

        </tr>
        </thead>
        <tbody>
            <?php

            // echo "<pre>";print_r($employee->toArray());die;
            if(count($employee) > 0){  
                $no =1;
                    foreach($employee as $detail){ 
                    ?>
              <tr>
                <td class="py-1"><?php echo $no; ?></td>
                <td class="py-1"><?php echo $detail->name; ?></td>
                <td class="py-1"><?php
                 echo $detail->language_names;
                //  $lang = explode(',',$detail->language_id); 
                //  echo "<pre>";print_r($lang);die;
                // foreach($lans as $lanss){
                //   // echo "<pre>";print_r($lanss->id);
                //    if($lanss->id  == $lang){
                //     echo $lanss->name;
                //    } 
                  // echo  $lanss->name ;

                // }   die;

                  ?></td>
                  {{-- @foreach($lang as $employeelanguages) {{$employeelanguages ==  $lan->id}}  @endforeach > {{ $lan->name }} ; --}}

                  {{-- @foreach($lang as $employeelanguages)
                    @foreach($lan as $lans)
                      @if($lans->id == $employeelanguages)
                      {{ $lans->name }}
                      @else 
                  
                      @endif
                      @endforeach
                      @endforeach --}}

                    
                  
                
            </tr>
            
            <?php
                  $no++;}
            }else{  
                 ?>
              <tr class="text-center"> 
              <td colspan="5" style="text-align: center !important;">
               <b>No data found</b>
              </td>
               <tr> 
                  <?php
            }
            ?>
        </tbody>
      </table>
      </div>
    </form>
    </div>
  {{-- </div> --}}