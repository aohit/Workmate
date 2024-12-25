
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
img {
    height: 100px;
    width: 100px;
    border-radius: 50%;
}
*{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
}
h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

/* Table Styles */

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    /* text-align: center; */
    padding: 8px;
}

.fl-table td {
    border: 1px solid #ccc;
    font-size: 12px;
}

.fl-table thead th {
    border: 1px solid #ccc;
}


.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}
td.footer {
    text-align: center;
}


    </style>
</head>
<body>
    <div class="table-container test-center">
       
        <div style="margin:0 auto;position: relative;">
            <div class="">
               
            </div>
            <div style="padding: 20px; ">
               <div style="width: 20%;float:left; ">
                @php
                if(isset($uinfo->Image->file) && $uinfo->Image->file != ''){
                    $image_url = url('/upload/employee/' . $uinfo->Image->file);
                }else{
                    $image_url = url('upload/employee/demo.jpg');
                }
                @endphp
                   <img src="{{ $image_url }}"  class="image_dy">
               </div>
               <div class="my-1"> 
                <h3 class="m-0 p-0" style="">{{ $uinfo->name }}</h3>
                <div class="">
                <span class="card-text m-0 p-0"><i class="fa fa-phone" aria-hidden="true"></i>{{ $uinfo->phone_number }}</span>
                <span class=""><i class="fa fa-envelope" aria-hidden="true"></i>{{ $uinfo->email }}</span></div>
                <span class="">{{ $uinfo->department->name }}</span>
               </div>
               
           </div>

            <table class="fl-table" style="padding-top: 20px; " cellspacing="0" cellpadding="5px">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Review Cycle</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   foreach($info as $detail){ 
                    ?>
              <tr>
                <td class="py-1"><?php echo $detail->title; ?></td>
                <td class="py-1"><?php echo 'Year-end' . $detail->review_cycle; ?></td>
                <td class="py-1"><?php echo $detail->status; ?></td>
                
            </tr>

                  <?php
           }
            ?>

                </tbody>
            </table>
        </div>
       
  
    </div>
</body>

</html>



