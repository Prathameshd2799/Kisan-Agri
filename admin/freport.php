.<?php   
 @include 'dbcon.php';
 ?>  
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Table</title>
     <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
     <h1>Kisan-Agri-Mall</h1>
     <div class="user_table">
     <h2>Feedback Reoprt</h2><br><br>
     <div class="back">
<a href="admin_dash.php"></a>
</div>
      <div class="container_table">  
      <table border="1">  
      <thead>
    <tr>
        <th>Feedback_ID</th>
        <th>Name</th>
        <th>Mobile_No</th>
        <th>Display Message</th>
        
        
        
       
    </tr>
  </thead> 
  <div class="container_rep">

<form action="" method="post">

<input type="text" placeholder="Search Items" name="search">
<button name="submit">Search</button><br><br>
</form>
<div class="cont">
    <?php
    if(isset($_POST['submit'])){
        $search=$_POST['search'];
        $conn = new mysqli('localhost', 'root', '', 'grocery');
        $sql = "select * from feedback where fid ='%$search%' or name like '%$search%' or mobile like '%$search%' or msg like '%$search%' "; 
        $result=mysqli_query($conn,$sql);
        if($result){
        if(mysqli_num_rows($result)>0){
           while( $row=mysqli_fetch_assoc($result)){
                echo ' 
                          <tr>
                          <td>'.$row['fid'].'</td>  
                          <td>'.$row['name'].'</td>  
                          <td>'.$row['mobile'].'</td>  
                          <td>'.$row['msg'].'</td>  
                          
    			          
                          
                         
                          
</tr>
                          ';  
           }
                     } 
                     else{
                        echo "No Data Found";
                     } 
                    }
                }  
           ?>  
      </table>  
 </div>  
 </div>
            </div>
            </div>

