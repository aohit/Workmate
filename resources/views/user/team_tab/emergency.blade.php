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
          <th>Emergency Contact</th>
          <th>Relation</th>

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
                <td class="py-1"><?php  echo $detail->number;?></td>
                <td class="py-1"><?php  echo $detail->relation;?></td>
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